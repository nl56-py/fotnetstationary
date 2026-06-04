'use client'
import { useState } from 'react'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'

export default function ContactPage() {
  const [form, setForm] = useState({ first_name: '', last_name: '', phone: '', email: '', message: '' })
  const [status, setStatus] = useState<'idle' | 'loading' | 'success' | 'error'>('idle')

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setStatus('loading')
    try {
      const res = await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(form),
      })
      if (res.ok) {
        setStatus('success')
        setForm({ first_name: '', last_name: '', phone: '', email: '', message: '' })
      } else setStatus('error')
    } catch { setStatus('error') }
  }

  return (
    <div>
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>Contact Us</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contact Us</li>
          </ul>
        </div>
      </div>

      <div className="contact-area">
        <div className="container">
          <div className="row">
            <div className="col-md-7 col-sm-12">
              <div className="section-title" style={{ marginBottom: 25 }}>
                <div className="sub-title">GET IN TOUCH</div>
                <h2>SEND US A MESSAGE</h2>
              </div>

              {status === 'success' ? (
                <div style={{ background: '#d4edda', color: '#155724', padding: 30, borderRadius: 10, textAlign: 'center' }}>
                  <i className="fa fa-check-circle" style={{ fontSize: 40, marginBottom: 10 }}></i>
                  <h4>Thank You!</h4>
                  <p>Your message has been sent. We will get back to you soon.</p>
                  <button onClick={() => setStatus('idle')} className="snip1457" style={{ marginTop: 10 }}>
                    Send Another Message
                  </button>
                </div>
              ) : (
                <div className="contact-form">
                  <form onSubmit={handleSubmit}>
                    <div className="row">
                      <div className="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" placeholder="First Name *" required value={form.first_name}
                          onChange={e => setForm({ ...form, first_name: e.target.value })} />
                      </div>
                      <div className="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Last Name" value={form.last_name}
                          onChange={e => setForm({ ...form, last_name: e.target.value })} />
                      </div>
                    </div>
                    <div className="row">
                      <div className="col-md-6 col-sm-6 col-xs-12">
                        <input type="tel" placeholder="Phone Number" value={form.phone}
                          onChange={e => setForm({ ...form, phone: e.target.value })} />
                      </div>
                      <div className="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" placeholder="Email Address" value={form.email}
                          onChange={e => setForm({ ...form, email: e.target.value })} />
                      </div>
                    </div>
                    <textarea placeholder="Your Message *" required value={form.message}
                      onChange={e => setForm({ ...form, message: e.target.value })} />
                    <button type="submit" className="submit-btn" disabled={status === 'loading'}>
                      {status === 'loading' ? 'Sending...' : 'Send Message'}
                    </button>
                    {status === 'error' && <p style={{ color: '#dc3545', marginTop: 10 }}>Failed to send. Try again.</p>}
                  </form>
                </div>
              )}
            </div>

            <div className="col-md-5 col-sm-12">
              <div style={{ marginBottom: 30 }}>
                <div className="section-title" style={{ marginBottom: 25 }}>
                  <div className="sub-title">OUR</div>
                  <h2>CONTACT DETAILS</h2>
                </div>

                {[
                  { icon: 'fa fa-map-marker', label: 'Address', value: 'Bharatpur Metropolitan City Ward No.10,\nSaptagandaki Chowk, Chitwan, Nepal' },
                  { icon: 'fa fa-phone', label: 'Phone', value: '056-526307 | 9845220077' },
                  { icon: 'fa fa-envelope-o', label: 'Email', value: 'fcichitwan@gmail.com' },
                  { icon: 'fa fa-fax', label: 'Fax', value: '+977-056-526307' },
                  { icon: 'fa fa-clock-o', label: 'Working Hours', value: '10:00 AM - 6:00 PM (Mon - Sat)' },
                ].map((item, idx) => (
                  <div key={idx} style={{
                    display: 'flex', gap: 15, padding: 15, marginBottom: 10,
                    background: '#f8f9fa', borderRadius: 8, alignItems: 'flex-start',
                  }}>
                    <div style={{
                      width: 40, height: 40, background: 'linear-gradient(135deg, #3347B0, #5b6fd6)',
                      borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center', flexShrink: 0,
                    }}>
                      <i className={item.icon} style={{ color: '#fff', fontSize: 16 }}></i>
                    </div>
                    <div>
                      <div style={{ fontSize: 12, color: '#3347B0', fontWeight: 700, textTransform: 'uppercase', marginBottom: 4 }}>{item.label}</div>
                      <div style={{ fontSize: 14, color: '#555', whiteSpace: 'pre-line' }}>{item.value}</div>
                    </div>
                  </div>
                ))}
              </div>

              {/* Google Maps embed placeholder */}
              <div style={{ borderRadius: 10, overflow: 'hidden', boxShadow: '0 3px 15px rgba(0,0,0,0.1)' }}>
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.123456789!2d84.4313!3d27.6833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDQxJzAwLjAiTiA4NMKwMjUnNTMuMCJF!5e0!3m2!1sen!2snp!4v1234567890"
                  width="100%" height="250" style={{ border: 0 }} allowFullScreen loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade" title="FCI Location"
                ></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
