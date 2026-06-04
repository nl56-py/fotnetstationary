import { NextResponse } from 'next/server'

export async function POST(request: Request) {
  try {
    const body = await request.json()
    const { customer_name, customer_email, customer_phone, service_type, message } = body

    if (!customer_name || !customer_phone) {
      return NextResponse.json({ error: 'Name and phone are required' }, { status: 400 })
    }

    // If Supabase is configured, insert into database
    const supabaseUrl = process.env.NEXT_PUBLIC_SUPABASE_URL
    let supabaseKey = process.env.SUPABASE_SERVICE_ROLE_KEY
    if (!supabaseKey || supabaseKey === 'your_supabase_service_role_key') {
      supabaseKey = process.env.NEXT_PUBLIC_SUPABASE_ANON_KEY
    }

    if (supabaseUrl && supabaseKey && supabaseUrl !== 'your_supabase_project_url') {
      const { createClient } = await import('@supabase/supabase-js')
      const supabase = createClient(supabaseUrl, supabaseKey)
      const { error } = await supabase.from('bookings').insert({
        customer_name,
        customer_email: customer_email || null,
        customer_phone,
        service_type: service_type || null,
        message: message || null,
        status: 'pending',
      })
      if (error) {
        console.error('Supabase error:', error)
        return NextResponse.json({ error: 'Failed to save booking' }, { status: 500 })
      }
    }

    return NextResponse.json({ success: true, message: 'Booking submitted successfully' })
  } catch (error) {
    console.error('Booking API error:', error)
    return NextResponse.json({ error: 'Internal server error' }, { status: 500 })
  }
}
