'use client'
import { useState, useEffect } from 'react'
import Link from 'next/link'

export default function Footer() {
  const [showBackToTop, setShowBackToTop] = useState(false)

  useEffect(() => {
    const handleScroll = () => setShowBackToTop(window.scrollY > 300)
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }

  return (
    <>
      <footer className="footer-area" id="footer">
        <div className="footer-overlay"></div>
        <div className="top-area">
          <div className="container">
            <div className="footer-block">
              <div className="row row-eq-height">
                {/* Column 1: About FCI */}
                <div className="col-lg-3 col-md-3 col-sm-6 col-xs-12 s-footer">
                  <div className="single-footer">
                    <div className="footer-logo-inline" style={{ marginBottom: '15px' }}>
                      <img src="/images/fonet logo.PNG" alt="Fonet Stationary Center" style={{ maxHeight: '55px', width: 'auto', display: 'block' }} />
                    </div>
                    <h3>About FCI</h3>
                    <p>
                      Fonet Stationary Center (FCI) is located at Bharatpur, in front of Saptagandaki Campus.
                      We provide typing, printing, photocopy and other related services.
                    </p>
                  </div>
                </div>

                {/* Column 2: Quick Links */}
                <div className="col-lg-3 col-md-3 col-sm-6 col-xs-12 s-footer">
                  <div className="single-footer">
                    <h3>Quick Links</h3>
                    <ul>
                      <li><Link href="/">Home</Link></li>
                      <li><Link href="/about">About Us</Link></li>
                      <li><Link href="/services">Services</Link></li>
                      <li><Link href="/notary">Notary Services</Link></li>
                      <li><Link href="/pricing">Pricing</Link></li>
                      <li><Link href="/notices">Notice & Downloads</Link></li>
                      <li><Link href="/notes">Notes</Link></li>
                      <li><Link href="/gallery">Gallery</Link></li>
                      <li><Link href="/blog">Blog</Link></li>
                      <li><Link href="/contact">Contact Us</Link></li>
                    </ul>
                  </div>
                </div>

                {/* Column 3: Our Services */}
                <div className="col-lg-3 col-md-3 col-sm-6 col-xs-12 s-footer">
                  <div className="single-footer">
                    <h3>Our Services</h3>
                    <ul>
                      <li><Link href="/services/thesis-typing">Thesis Typing</Link></li>
                      <li><Link href="/services/photocopy-center">Photocopy Center</Link></li>
                      <li><Link href="/notary">Notary Services</Link></li>
                      <li><Link href="/services/flex-print">Flex Print</Link></li>
                      <li><Link href="/services/lamination">Lamination</Link></li>
                      <li><Link href="/services/visiting-card">Visiting Card</Link></li>
                      <li><Link href="/services/pvc-card">PVC Card</Link></li>
                      <li><Link href="/services/tshirt-print">T-Shirt Print</Link></li>
                    </ul>
                  </div>
                </div>

                {/* Column 4: Contact Info + Map */}
                <div className="col-lg-3 col-md-3 col-sm-6 col-xs-12 s-footer">
                  <div className="single-footer">
                    <h3>Contact Info</h3>
                    <ul>
                      <li><i className="fa fa-map-marker" style={{ marginRight: 8, color: '#3347B0' }}></i> Bharatpur, Saptagandaki Chowk, Chitwan</li>
                      <li><i className="fa fa-phone" style={{ marginRight: 8, color: '#3347B0' }}></i> 056-526307</li>
                      <li><i className="fa fa-mobile" style={{ marginRight: 8, color: '#3347B0' }}></i> 9845220077</li>
                      <li><i className="fa fa-envelope-o" style={{ marginRight: 8, color: '#3347B0' }}></i> fcichitwan@gmail.com</li>
                      <li><i className="fa fa-fax" style={{ marginRight: 8, color: '#3347B0' }}></i> +977-056-526307</li>
                    </ul>
                    <div className="footer-map">
                      <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56540.123125697915!2d84.38265432505565!3d27.6629674589797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3994fb2dee56a405%3A0xb667aee3e27ececa!2sFonet%20Stationery%20Center%20(FCI)!5e0!3m2!1sen!2snp!4v1780596954644!5m2!1sen!2snp"
                        width="100%"
                        height="180"
                        style={{ border: 0, borderRadius: '8px' }}
                        allowFullScreen={true}
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                        title="FCI Location Map"
                      ></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="fcopyright">
              <p>© {new Date().getFullYear()} Fonet Stationary Center. All Rights Reserved.</p>
            </div>
          </div>
        </div>
      </footer>

      <a
        id="back2Top"
        title="Back to top"
        className={showBackToTop ? 'visible' : ''}
        onClick={scrollToTop}
        style={{ cursor: 'pointer' }}
      >
        &#10148;
      </a>

      {/* WhatsApp Floating Widget */}
      <a
        href="https://wa.me/9779845220077"
        target="_blank"
        rel="noopener noreferrer"
        className="whatsapp-floating-widget"
        title="Chat with us on WhatsApp!"
      >
        <i className="fa fa-whatsapp"></i>
        <span className="whatsapp-tooltip">Chat with us on WhatsApp!</span>
      </a>
    </>
  )
}
