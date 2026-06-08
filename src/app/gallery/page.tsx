'use client'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import GallerySection from '@/components/sections/GallerySection'

export default function GalleryPage() {
  return (
    <div>
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>Gallery</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Gallery</li>
          </ul>
        </div>
      </div>

      <GallerySection />

      <Footer />
    </div>
  )
}
