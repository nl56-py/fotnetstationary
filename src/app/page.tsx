import type { Metadata } from 'next'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import HeroSlider from '@/components/sections/HeroSlider'
import ServicesSection from '@/components/sections/ServicesSection'
import AboutSection from '@/components/sections/AboutSection'
import FeaturesSection from '@/components/sections/FeaturesSection'
import ContactInfoSection from '@/components/sections/ContactInfoSection'

export const metadata: Metadata = {
  title: "Fonet Stationary Center - Printing, Photocopy & Notary in Chitwan",
  description: "Fonet Stationary Center (FCI) offers thesis typing, photocopy center, certified notary translation, document attestation, PVC cards, and stationery in Bharatpur, Chitwan. Visit us in front of Saptagandaki Campus.",
  openGraph: {
    title: "Fonet Stationary Center - Printing, Photocopy & Notary in Chitwan",
    description: "Fonet Stationary Center (FCI) offers thesis typing, photocopy center, certified notary translation, document attestation, PVC cards, and stationery in Bharatpur, Chitwan.",
    url: "https://fonet.com.np/",
    images: [
      {
        url: "/images/fonet logo.PNG",
        width: 1200,
        height: 630,
        alt: "Fonet Stationary Center Logo",
      }
    ],
  }
}

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
  const localBusinessSchema = {
    "@context": "https://schema.org",
    "@type": ["LocalBusiness", "ProfessionalService"],
    "name": "Fonet Stationary Center",
    "alternateName": ["FCI Chitwan", "Fonet Stationary"],
    "description": "Fonet Stationary Center (FCI) in Bharatpur, Chitwan provides professional printing, high-speed photocopying, certified notary translations, document attestation, PVC ID card printing, and thesis typing.",
    "url": "https://fonet.com.np",
    "logo": "https://fonet.com.np/images/fonet logo.PNG",
    "image": "https://fonet.com.np/images/About3.jpg",
    "telephone": "+977-056-526307",
    "priceRange": "$$",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Saptagandaki Chowk, Bharatpur Ward No. 10",
      "addressLocality": "Bharatpur",
      "addressRegion": "Chitwan, Bagmati Province",
      "postalCode": "44200",
      "addressCountry": "Nepal"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 27.6629,
      "longitude": 84.3826
    },
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      "opens": "07:00",
      "closes": "19:00"
    },
    "sameAs": [
      "https://www.facebook.com/p/Fonet-Stationery-Center-100083723779495/"
    ]
  }

  const websiteSchema = {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Fonet Stationary Center",
    "url": "https://fonet.com.np",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://fonet.com.np/search?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }

  return (
    <div className="main-container">
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(localBusinessSchema) }}
      />
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(websiteSchema) }}
      />
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
