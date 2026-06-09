import { services as staticServices, getServiceBySlug as getStaticService, getAllServiceSlugs } from '@/lib/services-data'
import { createServerSupabaseClient } from '@/lib/supabase/server'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import ServiceBookingForm from '@/components/ui/ServiceBookingForm'
import type { Metadata } from 'next'
import { notFound } from 'next/navigation'

export const dynamicParams = true
export const revalidate = 0

interface PageProps {
  params: Promise<{ slug: string }>
}

export async function generateStaticParams() {
  return getAllServiceSlugs().map((slug) => ({ slug }))
}

export async function generateMetadata({ params }: PageProps): Promise<Metadata> {
  const { slug } = await params
  const supabase = await createServerSupabaseClient()
  const { data: dbService } = await supabase
    .from('services')
    .select('title, description, image_url')
    .eq('slug', slug)
    .eq('is_active', true)
    .single()

  let title = 'Service Not Found'
  let description = ''
  let imageUrl = '/images/servicesimg.jpg'

  if (dbService) {
    title = `${dbService.title} - Fonet Stationary Center`
    description = dbService.description || ''
    imageUrl = dbService.image_url || '/images/servicesimg.jpg'
  } else {
    const staticService = getStaticService(slug)
    if (staticService) {
      title = `${staticService.title} - Fonet Stationary Center`
      description = staticService.shortDesc
      imageUrl = staticService.image
    }
  }

  return {
    title,
    description,
    openGraph: {
      title,
      description,
      type: 'website',
      url: `https://fonet.com.np/services/${slug}`,
      images: [
        {
          url: imageUrl,
          alt: title,
        },
      ],
    },
    twitter: {
      card: 'summary_large_image',
      title,
      description,
      images: [imageUrl],
    },
  }
}

export default async function ServiceDetailPage({ params }: PageProps) {
  const { slug } = await params

  // Try DB first
  const supabase = await createServerSupabaseClient()
  const { data: dbService } = await supabase
    .from('services')
    .select('*')
    .eq('slug', slug)
    .eq('is_active', true)
    .single()

  // Normalize to a common shape
  let service: {
    slug: string; title: string; icon: string; image: string;
    shortDesc: string; longDesc: string; features: string[];
  }

  if (dbService) {
    service = {
      slug: dbService.slug,
      title: dbService.title,
      icon: dbService.icon || 'fa fa-print',
      image: dbService.image_url || '/images/servicesimg.jpg',
      shortDesc: dbService.description || '',
      longDesc: dbService.long_description || dbService.description || '',
      features: dbService.features || [],
    }
  } else {
    const staticService = getStaticService(slug)
    if (!staticService) notFound()
    service = {
      slug: staticService.slug,
      title: staticService.title,
      icon: staticService.icon,
      image: staticService.image,
      shortDesc: staticService.shortDesc,
      longDesc: staticService.longDesc,
      features: staticService.features,
    }
  }

  const isNotaryService = service.slug === 'notary-service'

  // Get all services for sidebar
  const { data: dbAllServices } = await supabase
    .from('services')
    .select('slug, title, icon, is_active')
    .eq('is_active', true)
    .order('sort_order')

  const allServices = dbAllServices && dbAllServices.length > 0
    ? dbAllServices.map((s: any) => ({ slug: s.slug, title: s.title, icon: s.icon || 'fa fa-print' }))
    : staticServices.map(s => ({ slug: s.slug, title: s.title, icon: s.icon }))

  // Related services (exclude current)
  const related = allServices.filter(s => s.slug !== slug).slice(0, 4)
  // Get images for related services
  const relatedWithImages = await Promise.all(
    related.map(async (rs) => {
      const { data: rdb } = await supabase
        .from('services')
        .select('image_url')
        .eq('slug', rs.slug)
        .single()
      const staticS = getStaticService(rs.slug)
      return {
        ...rs,
        image: rdb?.image_url || staticS?.image || '/images/servicesimg.jpg',
      }
    })
  )

  const serviceSchema = {
    "@context": "https://schema.org",
    "@type": "Service",
    "name": service.title,
    "description": service.shortDesc || service.longDesc,
    "provider": {
      "@type": "LocalBusiness",
      "name": "Fonet Stationary Center",
      "image": "https://fonet.com.np/images/fonet logo.PNG",
      "telephone": "+977-056-526307",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Saptagandaki Chowk, Bharatpur Ward No. 10",
        "addressLocality": "Bharatpur",
        "addressRegion": "Chitwan",
        "postalCode": "44200",
        "addressCountry": "Nepal"
      }
    },
    "areaServed": [
      {
        "@type": "City",
        "name": "Bharatpur"
      },
      {
        "@type": "City",
        "name": "Chitwan"
      }
    ],
    "image": service.image.startsWith('/') ? `https://fonet.com.np${service.image}` : service.image,
  }

  return (
    <div>
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(serviceSchema) }}
      />
      <Header />

      {/* Hero Banner with Service Image */}
      <div className="service-detail-banner">
        <div className="sdb-bg-image" style={{ backgroundImage: `url(${service.image})` }}></div>
        <div className="sdb-overlay"></div>
        <div className="sdb-content">
          <div className="container">
            <div className="sdb-icon-circle">
              <i className={service.icon} aria-hidden="true"></i>
            </div>
            <h1>{service.title}</h1>
            <p className="sdb-tagline">{service.shortDesc}</p>
            <ul className="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="/services">Services</a></li>
              <li>{service.title}</li>
            </ul>
          </div>
        </div>
        <div className="sdb-wave">
          <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 120L60 110C120 100 240 80 360 68C480 56 600 52 720 56C840 60 960 72 1080 78C1200 84 1320 84 1380 84L1440 84V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f8f9fc"/>
          </svg>
        </div>
      </div>

      {/* Service Detail Content */}
      <div className="service-detail-content">
        <div className="container">
          <div className="row">
            {/* Main Content */}
            <div className="col-md-8 col-sm-12">
              <div className="sdc-main">
                <div className="sdc-section">
                  <div className="sdc-section-label">
                    <i className="fa fa-info-circle"></i> About This Service
                  </div>
                  <h2 className="sdc-title">{service.title}</h2>
                  <div className="sdc-divider"></div>
                  <p className="sdc-desc">{service.longDesc}</p>
                </div>

                {/* Features Grid */}
                {service.features.length > 0 && (
                  <div className="sdc-section">
                    <div className="sdc-section-label">
                      <i className="fa fa-check-circle"></i> What We Offer
                    </div>
                    <div className="sdc-features-grid">
                      {service.features.map((feature, idx) => (
                        <div key={idx} className="sdc-feature-card">
                          <div className="sdc-feature-num">{String(idx + 1).padStart(2, '0')}</div>
                          <div className="sdc-feature-text">{feature}</div>
                        </div>
                      ))}
                    </div>
                  </div>
                )}

                {/* Why Choose Us */}
                <div className="sdc-section">
                  <div className="sdc-section-label">
                    <i className="fa fa-star"></i> Why Choose FCI?
                  </div>
                  <div className="sdc-why-grid">
                    <div className="sdc-why-card">
                      <div className="sdc-why-icon"><i className="fa fa-bolt"></i></div>
                      <h5>Fast Delivery</h5>
                      <p>Quick turnaround without compromising quality</p>
                    </div>
                    <div className="sdc-why-card">
                      <div className="sdc-why-icon"><i className="fa fa-money"></i></div>
                      <h5>Affordable Prices</h5>
                      <p>Competitive pricing with volume discounts</p>
                    </div>
                    <div className="sdc-why-card">
                      <div className="sdc-why-icon"><i className="fa fa-diamond"></i></div>
                      <h5>Premium Quality</h5>
                      <p>State-of-the-art equipment and materials</p>
                    </div>
                  </div>
                </div>

                {/* CTA Banner */}
                <div className="sdc-cta-banner">
                  <div className="sdc-cta-text">
                    <h4>{isNotaryService ? 'Need notary or translation support?' : 'Ready to get started?'}</h4>
                    <p>
                      {isNotaryService
                        ? 'Open the notary request portal to upload documents or share a drive link.'
                        : "Fill out the booking form and we'll contact you within 24 hours"}
                    </p>
                  </div>
                  <a href={isNotaryService ? '/notary' : '#booking'} className="sdc-cta-btn">
                    <i className="fa fa-arrow-right"></i> {isNotaryService ? 'Submit Request' : 'Book Now'}
                  </a>
                </div>
              </div>
            </div>

            {/* Sidebar */}
            <div className="col-md-4 col-sm-12">
              <div className="sdc-sidebar">
                {/* All Services List */}
                <div className="sdc-sidebar-widget">
                  <h4 className="sdc-widget-title">
                    <i className="fa fa-th-list"></i> All Services
                  </h4>
                  <ul className="sdc-services-list">
                    {allServices.map((s) => (
                      <li key={s.slug} className={s.slug === slug ? 'active' : ''}>
                        <a href={`/services/${s.slug}`}>
                          <i className={s.icon}></i>
                          <span>{s.title}</span>
                          <i className="fa fa-chevron-right sdc-arrow"></i>
                        </a>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Contact Info Widget */}
                <div className="sdc-sidebar-widget sdc-contact-widget">
                  <h4 className="sdc-widget-title">
                    <i className="fa fa-headphones"></i> Need Help?
                  </h4>
                  <div className="sdc-contact-item">
                    <i className="fa fa-phone"></i>
                    <div>
                      <small>Call Us</small>
                      <strong>056-526307</strong>
                    </div>
                  </div>
                  <div className="sdc-contact-item">
                    <i className="fa fa-mobile"></i>
                    <div>
                      <small>Mobile</small>
                      <strong>9845220077</strong>
                    </div>
                  </div>
                  <div className="sdc-contact-item">
                    <i className="fa fa-mobile"></i>
                    <div>
                      <small>Mobile</small>
                      <strong>9765028501</strong>
                    </div>
                  </div>
                  <div className="sdc-contact-item">
                    <i className="fa fa-mobile"></i>
                    <div>
                      <small>Mobile</small>
                      <strong>9765028500</strong>
                    </div>
                  </div>
                  <div className="sdc-contact-item">
                    <i className="fa fa-envelope"></i>
                    <div>
                      <small>Email</small>
                      <strong>fcichitwan@gmail.com</strong>
                    </div>
                  </div>
                  <div className="sdc-contact-item">
                    <i className="fa fa-map-marker"></i>
                    <div>
                      <small>Visit Us</small>
                      <strong>Saptagandaki Chowk, Bharatpur</strong>
                    </div>
                  </div>
                </div>

                {/* Opening Hours */}
                <div className="sdc-sidebar-widget sdc-hours-widget">
                  <h4 className="sdc-widget-title">
                    <i className="fa fa-clock-o"></i> Opening Hours
                  </h4>
                  <ul className="sdc-hours-list">
                    <li><span>Sunday - Friday</span><span>7:00 AM - 7:00 PM</span></li>
                    <li className="closed"><span>Saturday</span><span>Closed</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          {/* Booking Form Section - Full Width */}
          <div className="sdc-booking-section">
            <ServiceBookingForm serviceTitle={service.title} />
          </div>

          {/* Related Services */}
          <div className="sdc-related">
            <div className="sdc-section-label" style={{ textAlign: 'center', display: 'inline-block', margin: '0 auto 30px' }}>
              <i className="fa fa-th-large"></i> Related Services
            </div>
            <div className="row">
              {relatedWithImages.map((rs) => (
                <div key={rs.slug} className="col-md-3 col-sm-6 col-xs-12" style={{ marginBottom: 20 }}>
                  <a href={`/services/${rs.slug}`} className="sdc-related-card">
                    <div className="sdc-rc-img">
                      <img src={rs.image} alt={rs.title} />
                      <div className="sdc-rc-overlay">
                        <i className={rs.icon}></i>
                      </div>
                    </div>
                    <div className="sdc-rc-body">
                      <h5>{rs.title}</h5>
                      <span className="sdc-rc-link">Learn More <i className="fa fa-arrow-right"></i></span>
                    </div>
                  </a>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
