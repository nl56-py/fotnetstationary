import { NextResponse } from 'next/server'

export async function POST(request: Request) {
  try {
    const body = await request.json()
    const { first_name, last_name, phone, email, message } = body

    if (!first_name) {
      return NextResponse.json({ error: 'First name is required' }, { status: 400 })
    }

    const supabaseUrl = process.env.NEXT_PUBLIC_SUPABASE_URL
    let supabaseKey = process.env.SUPABASE_SERVICE_ROLE_KEY
    if (!supabaseKey || supabaseKey === 'your_supabase_service_role_key') {
      supabaseKey = process.env.NEXT_PUBLIC_SUPABASE_ANON_KEY
    }

    if (supabaseUrl && supabaseKey && supabaseUrl !== 'your_supabase_project_url') {
      const { createClient } = await import('@supabase/supabase-js')
      const supabase = createClient(supabaseUrl, supabaseKey)
      const { error } = await supabase.from('contact_submissions').insert({
        first_name,
        last_name: last_name || null,
        phone: phone || null,
        email: email || null,
        message: message || null,
        is_read: false,
      })
      if (error) {
        console.error('Supabase error:', error)
        return NextResponse.json({ error: 'Failed to save message' }, { status: 500 })
      }
    }

    return NextResponse.json({ success: true, message: 'Message sent successfully' })
  } catch (error) {
    console.error('Contact API error:', error)
    return NextResponse.json({ error: 'Internal server error' }, { status: 500 })
  }
}
