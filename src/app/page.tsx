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
import { getServiceBySlug } from '@/lib/services-data'

function SpecializedServicesSection() {
  const notaryService = getServiceBySlug('notary-service')

  if (!notaryService) return null

  return (
    <div className="specialized-section-custom" id="specialized-services">
      <div className="sec-overlay"></div>
      <div className="container" style={{ position: 'relative', zIndex: 2 }}>
        <div className="features-title-container">
          <div className="features-subtitle-our">OUR</div>
          <div className="features-title-bracket-wrapper">
            <span className="features-title-text">
              SPECIALIZED SERVICES
              <span className="title-red-dot"></span>
            </span>
          </div>
        </div>
        <div className="specialized-row-custom">
          {/* Left Column - Text Content */}
          <div className="specialized-left-col">
            <div>
              <p className="specialized-description">
                For customers who need document verification, translation, attestation, or formal paperwork support,
                our notary service brings these requests into the same trusted Fonet Stationary Center workflow.
              </p>
              <div className="specialized-features-grid">
                <div className="specialized-feature-tag">
                  <i className="fa fa-check-circle"></i> Attestation & Stamping
                </div>
                <div className="specialized-feature-tag">
                  <i className="fa fa-check-circle"></i> Document Translation
                </div>
                <div className="specialized-feature-tag">
                  <i className="fa fa-check-circle"></i> Legal Affidavits
                </div>
                <div className="specialized-feature-tag">
                  <i className="fa fa-check-circle"></i> Property Valuation Guide
                </div>
              </div>
            </div>
          </div>

          {/* Right Column - Notary Card */}
          <div className="specialized-right-col">
            <a href={`/services/${notaryService.slug}`} className="sl-card">
              <div className="sl-card-image">
                <img src={notaryService.image} alt={notaryService.title} />
                <div className="sl-card-overlay">
                  <div className="sl-card-overlay-icon">
                    <i className={notaryService.icon}></i>
                  </div>
                </div>
              </div>
              <div className="sl-card-body">
                <div className="sl-card-icon-badge">
                  <i className={notaryService.icon}></i>
                </div>
                <h4>{notaryService.title}</h4>
                <p>{notaryService.shortDesc}</p>
                <span className="sl-card-link">
                  View Notary Service <i className="fa fa-arrow-right"></i>
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  )
}

export default function HomePage() {
  return (
    <div className="main-container">
      <Header />
      
      {/* Important Announcement Notice Popup on Homepage load */}
      <NoticePopup />

      {/* Homepage Sections - Same order as WP theme */}
      <HeroSlider />
      <ServicesSection />
      <SpecializedServicesSection />
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
