import type { Metadata } from 'next'
import GalleryClient from './GalleryClient'

export const metadata: Metadata = {
  title: "Photo Gallery - Fonet Stationary Center",
  description: "View our portfolio of printed works, personalized custom cups, custom T-shirts, flex banners, corporate PVC cards, and stationery products completed at Fonet Chitwan.",
}

export default function GalleryPage() {
  return <GalleryClient />
}
