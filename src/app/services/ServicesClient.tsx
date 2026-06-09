'use client'
import React, { useState, useEffect } from 'react'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'

interface ServiceItem {
  slug: string
  title: string
  icon: string
  image: string
  shortDesc: string
}

export default function ServicesClient({ services }: { services: ServiceItem[] }) {
  const [searchQuery, setSearchQuery] = useState('')

  useEffect(() => {
    if (typeof window !== 'undefined') {
      const params = new URLSearchParams(window.location.search)
      const q = params.get('search') || params.get('q') || ''
      if (q) {
        setSearchQuery(q)
      }
    }
  }, [])

  const filtered = services.filter(s => 
    s.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
    s.shortDesc.toLowerCase().includes(searchQuery.toLowerCase())
  )

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
            <p className="sl-subtitle" style={{ textAlign: 'center', maxWidth: 800, margin: '0 auto 30px auto' }}>
              From thesis typing and printing to notary support, custom T-shirts, and PVC cards, we are your one-stop solution for printing, document, and stationery needs.
            </p>
          </div>

          {/* Search Bar */}
          <div className="search-bar-container" style={{
            background: '#fff',
            padding: '15px 20px',
            borderRadius: 12,
            border: '1px solid #eee',
            boxShadow: '0 4px 15px rgba(0,0,0,0.02)',
            marginBottom: 40,
            maxWidth: 600,
            margin: '0 auto 40px auto',
            position: 'relative'
          }}>
            <input
              type="text"
              placeholder="Search services by name or description..."
              value={searchQuery}
              onChange={e => setSearchQuery(e.target.value)}
              style={{
                width: '100%',
                padding: '12px 40px 12px 15px',
                borderRadius: 8,
                border: '1px solid #ddd',
                fontSize: 14,
                boxSizing: 'border-box'
              }}
            />
            <i className="fa fa-search" style={{ position: 'absolute', right: 35, top: '50%', transform: 'translateY(-50%)', color: '#888', fontSize: 16 }}></i>
          </div>

          {filtered.length === 0 ? (
            <div style={{ textAlign: 'center', padding: '60px 20px', background: '#fff', borderRadius: 12, border: '1px solid #eee', margin: '30px auto' }}>
              <i className="fa fa-cogs" style={{ fontSize: 48, color: '#ccc', marginBottom: 15 }}></i>
              <h3 style={{ margin: 0, color: '#666', fontSize: 18 }}>No services match &quot;{searchQuery}&quot;</h3>
            </div>
          ) : (
            <div className="row">
              {filtered.map((service, idx) => (
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
          )}
        </div>
      </div>

      <Footer />
    </div>
  )
}
