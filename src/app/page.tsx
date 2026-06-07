import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import HeroSlider from '@/components/sections/HeroSlider'
import ServicesSection from '@/components/sections/ServicesSection'
import AboutSection from '@/components/sections/AboutSection'
import FeaturesSection from '@/components/sections/FeaturesSection'
import ContactInfoSection from '@/components/sections/ContactInfoSection'

import GallerySection from '@/components/sections/GallerySection'
import CounterSection from '@/components/sections/CounterSection'
import BookingSection from '@/components/sections/BookingSection'
import BlogSection from '@/components/sections/BlogSection'
import GoogleReviews from '@/components/sections/GoogleReviews'
import NoticePopup from '@/components/sections/NoticePopup'

export default function HomePage() {
  return (
    <div className="main-container">
      <Header />
      
      {/* Important Announcement Notice Popup on Homepage load */}
      <NoticePopup />

      {/* Homepage Sections - Same order as WP theme */}
      <HeroSlider />
      <ServicesSection />
      <AboutSection />
      <FeaturesSection />
      <ContactInfoSection />

      <GallerySection />
      <CounterSection />
      <BookingSection />
      <BlogSection />

      {/* Google Reviews auto scrolling section replacing newsletter */}
      <GoogleReviews />

      <Footer />
    </div>
  )
}

