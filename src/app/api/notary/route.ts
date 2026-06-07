import { NextResponse } from 'next/server'

export async function POST(request: Request) {
  try {
    const body = await request.json()
    const { customer_name, customer_email, customer_phone, service_type, sub_service_type, message, file_url, drive_link } = body

    if (!customer_name || !customer_phone || !service_type) {
      return NextResponse.json({ error: 'Name, phone, and service type are required' }, { status: 400 })
    }

    // Set up Supabase
    const supabaseUrl = process.env.NEXT_PUBLIC_SUPABASE_URL
    let supabaseKey = process.env.SUPABASE_SERVICE_ROLE_KEY
    if (!supabaseKey || supabaseKey === 'your_supabase_service_role_key') {
      supabaseKey = process.env.NEXT_PUBLIC_SUPABASE_ANON_KEY
    }

    if (supabaseUrl && supabaseKey && supabaseUrl !== 'your_supabase_project_url') {
      const { createClient } = await import('@supabase/supabase-js')
      const supabase = createClient(supabaseUrl, supabaseKey)
      
      const { error } = await supabase.from('notary_requests').insert({
        customer_name,
        customer_email: customer_email || null,
        customer_phone,
        service_type,
        sub_service_type: sub_service_type || null,
        message: message || null,
        file_url: file_url || null,
        drive_link: drive_link || null,
        status: 'pending'
      })

      if (error) {
        console.error('Supabase error saving notary request:', error)
        return NextResponse.json({ error: 'Failed to save notary request' }, { status: 500 })
      }
    } else {
      console.warn('Supabase not fully configured in environment, request not saved to DB')
    }

    return NextResponse.json({ success: true, message: 'Notary request submitted successfully' })
  } catch (error) {
    console.error('Notary API error:', error)
    return NextResponse.json({ error: 'Internal server error' }, { status: 500 })
  }
}
