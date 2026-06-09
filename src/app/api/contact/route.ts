import { NextResponse } from 'next/server'
import { createAdminClient } from '@/lib/supabase/admin'
import { validateString, validateEmail, validatePhone } from '@/lib/validation'

export async function POST(request: Request) {
  try {
    const body = await request.json()

    // Validate inputs with bounded lengths
    const firstName = validateString(body.first_name, 'First name', { required: true, maxLength: 200 })
    if (firstName.error) {
      return NextResponse.json({ error: firstName.error.message }, { status: 400 })
    }

    const lastName = validateString(body.last_name, 'Last name', { maxLength: 200 })
    if (lastName.error) {
      return NextResponse.json({ error: lastName.error.message }, { status: 400 })
    }

    const phone = validatePhone(body.phone)
    if (phone.error) {
      return NextResponse.json({ error: phone.error.message }, { status: 400 })
    }

    const email = validateEmail(body.email)
    if (email.error) {
      return NextResponse.json({ error: email.error.message }, { status: 400 })
    }

    const message = validateString(body.message, 'Message', { maxLength: 5000 })
    if (message.error) {
      return NextResponse.json({ error: message.error.message }, { status: 400 })
    }

    // Use admin client for server-side insert
    const supabase = createAdminClient()
    const { error } = await supabase.from('contact_submissions').insert({
      first_name: firstName.value,
      last_name: lastName.value,
      phone: phone.value,
      email: email.value,
      message: message.value,
      is_read: false,
    })

    if (error) {
      console.error('Supabase error:', error)
      return NextResponse.json({ error: 'Failed to save message' }, { status: 500 })
    }

    return NextResponse.json({ success: true, message: 'Message sent successfully' })
  } catch (error) {
    console.error('Contact API error:', error)
    return NextResponse.json({ error: 'Internal server error' }, { status: 500 })
  }
}
