import { NextResponse } from 'next/server'
import { createAdminClient } from '@/lib/supabase/admin'
import { validateString, validateEmail, validatePhone, validateUrl } from '@/lib/validation'

export async function POST(request: Request) {
  try {
    const body = await request.json()

    // Validate inputs with bounded lengths
    const customerName = validateString(body.customer_name, 'Name', { required: true, maxLength: 200 })
    if (customerName.error) {
      return NextResponse.json({ error: customerName.error.message }, { status: 400 })
    }

    const customerPhone = validatePhone(body.customer_phone, { required: true })
    if (customerPhone.error) {
      return NextResponse.json({ error: customerPhone.error.message }, { status: 400 })
    }

    const serviceType = validateString(body.service_type, 'Service type', { required: true, maxLength: 200 })
    if (serviceType.error) {
      return NextResponse.json({ error: serviceType.error.message }, { status: 400 })
    }

    const customerEmail = validateEmail(body.customer_email)
    if (customerEmail.error) {
      return NextResponse.json({ error: customerEmail.error.message }, { status: 400 })
    }

    const subServiceType = validateString(body.sub_service_type, 'Sub-service type', { maxLength: 200 })
    if (subServiceType.error) {
      return NextResponse.json({ error: subServiceType.error.message }, { status: 400 })
    }

    const message = validateString(body.message, 'Message', { maxLength: 5000 })
    if (message.error) {
      return NextResponse.json({ error: message.error.message }, { status: 400 })
    }

    const fileUrl = validateUrl(body.file_url)
    if (fileUrl.error) {
      return NextResponse.json({ error: fileUrl.error.message }, { status: 400 })
    }

    const driveLink = validateUrl(body.drive_link)
    if (driveLink.error) {
      return NextResponse.json({ error: driveLink.error.message }, { status: 400 })
    }

    // Use admin client for server-side insert
    const supabase = createAdminClient()
    const { error } = await supabase.from('notary_requests').insert({
      customer_name: customerName.value,
      customer_email: customerEmail.value,
      customer_phone: customerPhone.value,
      service_type: serviceType.value,
      sub_service_type: subServiceType.value,
      message: message.value,
      file_url: fileUrl.value,
      drive_link: driveLink.value,
      status: 'pending',
    })

    if (error) {
      console.error('Supabase error saving notary request:', error)
      return NextResponse.json({ error: 'Failed to save notary request' }, { status: 500 })
    }

    return NextResponse.json({ success: true, message: 'Notary request submitted successfully' })
  } catch (error) {
    console.error('Notary API error:', error)
    return NextResponse.json({ error: 'Internal server error' }, { status: 500 })
  }
}
