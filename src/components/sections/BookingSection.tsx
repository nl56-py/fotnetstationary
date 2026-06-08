'use client'
import { useState } from 'react'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const serviceTypes = [
  'Thesis Typing', 'Photocopy', 'General Typing', 'Documentations',
  'Flex Print', 'Lamination', 'Visiting Card', 'PVC Card',
  'T-Shirt Print', 'Cup/Plate Print', 'Self Stamp', 'Other',
]

export default function BookingSection() {
  const [formData, setFormData] = useState({
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    service_type: '',
    message: '',
  })
  const [status, setStatus] = useState<'idle' | 'loading' | 'success' | 'error'>('idle')

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setStatus('loading')
    try {
      const res = await fetch('/api/booking', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData),
      })
      if (res.ok) {
        setStatus('success')
        setFormData({ customer_name: '', customer_email: '', customer_phone: '', service_type: '', message: '' })
      } else {
        setStatus('error')
      }
    } catch {
      setStatus('error')
    }
  }

  return (
    <div className="registration-area" id="registration">
      <div className="container">
        <div className="registrationsign-box">
          <div className="col-md-5 col-sm-12 col-xs-12">
            <AnimateOnScroll>
              <div className="section-title">
                <h2>BOOK A SERVICE</h2>
                <div className="titleborder"></div>
              </div>
            </AnimateOnScroll>
            <div className="clearfix"></div>
            <AnimateOnScroll>
              <div className="ht-registration-member-wrap">
                <div className="box-form">
                  {status === 'success' ? (
                    <div style={{ padding: 20, textAlign: 'center', color: '#155724', background: '#d4edda', borderRadius: 8 }}>
                      <i className="fa fa-check-circle" style={{ fontSize: 40, marginBottom: 10 }}></i>
                      <h4>Thank You!</h4>
                      <p>Your service booking has been submitted. We will contact you shortly.</p>
                      <button onClick={() => setStatus('idle')} className="snip1457" style={{ marginTop: 10 }}>
                        Book Another
                      </button>
                    </div>
                  ) : (
                    <form onSubmit={handleSubmit}>
                      <input
                        type="text"
                        placeholder="Your Name *"
                        required
                        value={formData.customer_name}
                        onChange={(e) => setFormData({ ...formData, customer_name: e.target.value })}
                      />
                      <input
                        type="email"
                        placeholder="Email Address"
                        value={formData.customer_email}
                        onChange={(e) => setFormData({ ...formData, customer_email: e.target.value })}
                      />
                      <input
                        type="tel"
                        placeholder="Phone Number *"
                        required
                        value={formData.customer_phone}
                        onChange={(e) => setFormData({ ...formData, customer_phone: e.target.value })}
                      />
                      <select
                        value={formData.service_type}
                        onChange={(e) => setFormData({ ...formData, service_type: e.target.value })}
                      >
                        <option value="">Select Service Type</option>
                        {serviceTypes.map((st) => (
                          <option key={st} value={st}>{st}</option>
                        ))}
                      </select>
                      <textarea
                        placeholder="Your Message"
                        value={formData.message}
                        onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                      ></textarea>
                      <button type="submit" disabled={status === 'loading'}>
                        {status === 'loading' ? 'Submitting...' : 'Submit Booking'}
                      </button>
                      {status === 'error' && (
                        <p style={{ color: '#dc3545', marginTop: 10 }}>Something went wrong. Please try again.</p>
                      )}
                    </form>
                  )}
                </div>
              </div>
            </AnimateOnScroll>
          </div>

          <div className="col-md-7 col-sm-12 col-xs-12">
            <AnimateOnScroll>
              <div className="faqsection">
                <h2>FAQ</h2>
                <div className="sub-title">Frequently Asked Questions</div>
                <div className="clearfix"></div>
                <div className="faqShortbox">
                  <div style={{ marginBottom: 20 }}>
                    <h4 style={{ color: '#222', marginBottom: 8 }}>What services does FCI offer?</h4>
                    <p style={{ color: '#666', fontSize: 14, lineHeight: 1.8 }}>
                      We offer thesis typing, printing, photocopy, lamination, flex print, visiting cards,
                      PVC cards, T-shirt printing, cup/plate printing, self stamps, ribbon batches, and more.
                    </p>
                  </div>
                  <div style={{ marginBottom: 20 }}>
                    <h4 style={{ color: '#222', marginBottom: 8 }}>What are your working hours?</h4>
                    <p style={{ color: '#666', fontSize: 14, lineHeight: 1.8 }}>
                      We are open from 7:00 AM to 7:00 PM, Monday to Saturday. We are closed on Sundays
                      and public holidays.
                    </p>
                  </div>
                  <div style={{ marginBottom: 20 }}>
                    <h4 style={{ color: '#222', marginBottom: 8 }}>Where is FCI located?</h4>
                    <p style={{ color: '#666', fontSize: 14, lineHeight: 1.8 }}>
                      We are located at Bharatpur Metropolitan City Ward No.10, Saptagandaki Chowk,
                      Chitwan, Nepal — right in front of Saptagandaki Campus.
                    </p>
                  </div>
                  <button className="snip1457">
                    <a href="/contact">Contact Us</a>
                  </button>
                </div>
              </div>
            </AnimateOnScroll>
          </div>
        </div>
        <div className="clearfix"></div>
      </div>
    </div>
  )
}
