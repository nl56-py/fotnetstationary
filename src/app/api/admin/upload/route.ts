import { NextRequest, NextResponse } from 'next/server'
import { createAdminClient } from '@/lib/supabase/admin'

/** Allowed MIME types for admin uploads. */
const ALLOWED_MIME_TYPES = new Set([
  'application/pdf',
  'image/png',
  'image/jpeg',
  'image/jpg',
  'image/webp',
  'image/gif',
  'application/msword',
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
])

/** Max file size: 10 MB */
const MAX_FILE_SIZE = 10 * 1024 * 1024

/** Allowed folder targets */
const ALLOWED_FOLDERS = new Set(['services', 'blogs', 'notices', 'gallery', 'general'])

export async function POST(request: NextRequest) {
  try {
    const formData = await request.formData()
    const file = formData.get('file') as File | null
    const folder = (formData.get('folder') as string) || 'general'

    if (!file || !(file instanceof File)) {
      return NextResponse.json({ error: 'No file provided' }, { status: 400 })
    }

    if (file.size > MAX_FILE_SIZE) {
      return NextResponse.json({ error: 'File size must be 10MB or less' }, { status: 400 })
    }

    if (file.size === 0) {
      return NextResponse.json({ error: 'File is empty' }, { status: 400 })
    }

    if (!ALLOWED_MIME_TYPES.has(file.type)) {
      return NextResponse.json(
        { error: 'File type not allowed. Accepted: PDF, PNG, JPG, WEBP, GIF, DOC, DOCX' },
        { status: 400 }
      )
    }

    const sanitizedFolder = ALLOWED_FOLDERS.has(folder) ? folder : 'general'

    const originalName = file.name || ''
    const ext = originalName.split('.').pop()?.toLowerCase() || 'bin'
    const safeFileName = `${Math.random().toString(36).substring(2)}-${Date.now()}.${ext}`
    const filePath = `${sanitizedFolder}/${safeFileName}`

    const supabase = createAdminClient()
    const fileBuffer = Buffer.from(await file.arrayBuffer())

    const { error: uploadError } = await supabase.storage
      .from('documents')
      .upload(filePath, fileBuffer, {
        contentType: file.type,
        upsert: false,
      })

    if (uploadError) {
      console.error('Storage upload error:', uploadError)
      return NextResponse.json({ error: 'File upload failed' }, { status: 500 })
    }

    const { data: urlData } = supabase.storage
      .from('documents')
      .getPublicUrl(filePath)

    return NextResponse.json({
      success: true,
      publicUrl: urlData.publicUrl,
    })
  } catch (error) {
    console.error('Admin upload API error:', error)
    return NextResponse.json({ error: 'Internal server error' }, { status: 500 })
  }
}
