import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { services } from '@/lib/services-data'
import type { Metadata } from 'next'

export const metadata: Metadata = {
  title: 'Our Services - Fonet Stationary Center',
  description: 'Explore the full range of services offered by Fonet Stationary Center including thesis typing, photocopy, printing, lamination, notary service, visiting cards, PVC cards, and more.',
}

export default function ServicesPage() {
  return (
    <div>
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>Our Services</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Services</li>
          </ul>
        </div>
      </div>

      <div className="services-listing-area">
        <div className="container">
          <div className="sl-header">
            <div className="section-title" style={{ textAlign: 'center', marginBottom: 15 }}>
              <div className="sub-title">WHAT WE OFFER</div>
              <h2>ALL SERVICES</h2>
            </div>
            <p className="sl-subtitle">
              From thesis typing and printing to notary support, custom T-shirts, and PVC cards, we are your one-stop solution for printing, document, and stationery needs.
            </p>
          </div>

          <div className="row">
            {services.map((service, idx) => (
              <div key={idx} className="col-md-4 col-sm-6 col-xs-12" style={{ marginBottom: 30 }}>
                <a href={`/services/${service.slug}`} className="sl-card">
                  <div className="sl-card-image">
                    <img src={service.image} alt={service.title} />
                    <div className="sl-card-overlay">
                      <div className="sl-card-overlay-icon">
                        <i className={service.icon}></i>
                      </div>
                    </div>
                  </div>
                  <div className="sl-card-body">
                    <div className="sl-card-icon-badge">
                      <i className={service.icon}></i>
                    </div>
                    <h4>{service.title}</h4>
                    <p>{service.shortDesc}</p>
                    <span className="sl-card-link">
                      Learn More <i className="fa fa-arrow-right"></i>
                    </span>
                  </div>
                </a>
              </div>
            ))}
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
