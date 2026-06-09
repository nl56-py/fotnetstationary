import type { Metadata } from 'next'
import NoticesClient from './NoticesClient'

export const metadata: Metadata = {
  title: "Notices & Downloads - Fonet Stationary Center",
  description: "Check the latest news, updates, and announcements from Fonet Stationary Center. Download standard translation templates for birth registration, relationship, and marriage certificates.",
}

export default function NoticesPage() {
  return <NoticesClient />
}
