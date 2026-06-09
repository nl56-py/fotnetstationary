import type { Metadata } from 'next'
import ContactClient from './ContactClient'

export const metadata: Metadata = {
  title: "Contact Us - Fonet Stationary Center",
  description: "Get in touch with Fonet Stationary Center (FCI) at Saptagandaki Chowk, Bharatpur, Chitwan. Find our maps location, phone numbers, email, and submit a message.",
}

export default function ContactPage() {
  return <ContactClient />
}
