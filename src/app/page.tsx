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

export default function HomePage() {
  return (
    <div className="main-container">
      <Header />

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

      {/* Newsletter Section */}
      <div className="newsletter-area">
        <div className="container">
          <h2>SUBSCRIBE TO OUR NEWSLETTER</h2>
          <p>Stay updated with the latest news and offers from Fonet Stationary Center</p>
          <div className="newsletter-form">
            <input type="email" placeholder="Enter your email address" />
            <button type="button">Subscribe</button>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
