'use client'
import { useState } from 'react'

interface ServiceBookingFormProps {
  serviceTitle: string
}

export default function ServiceBookingForm({ serviceTitle }: ServiceBookingFormProps) {
  const [formData, setFormData] = useState({
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    service_type: serviceTitle,
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
        setFormData({ customer_name: '', customer_email: '', customer_phone: '', service_type: serviceTitle, message: '' })
      } else {
        setStatus('error')
      }
    } catch {
      setStatus('error')
    }
  }

  return (
    <div className="service-booking-form" id="booking">
      <div className="sbf-header">
        <div className="sbf-icon-wrap">
          <i className="fa fa-calendar-check-o" aria-hidden="true"></i>
        </div>
        <h3>Book This Service</h3>
        <p>Fill out the form below and we&apos;ll get back to you shortly</p>
      </div>

      {status === 'success' ? (
        <div className="sbf-success">
          <div className="sbf-success-icon">
            <i className="fa fa-check-circle"></i>
          </div>
          <h4>Thank You!</h4>
          <p>Your booking for <strong>{serviceTitle}</strong> has been submitted successfully. We will contact you shortly.</p>
          <button onClick={() => setStatus('idle')} className="sbf-btn sbf-btn-outline">
            Book Another Service
          </button>
        </div>
      ) : (
        <form onSubmit={handleSubmit} className="sbf-form">
          <div className="sbf-form-grid">
            <div className="sbf-field">
              <label htmlFor="sbf-name">
                <i className="fa fa-user"></i> Full Name <span className="sbf-req">*</span>
              </label>
              <input
                id="sbf-name"
                type="text"
                placeholder="Enter your full name"
                required
                value={formData.customer_name}
                onChange={(e) => setFormData({ ...formData, customer_name: e.target.value })}
              />
            </div>
            <div className="sbf-field">
              <label htmlFor="sbf-phone">
                <i className="fa fa-phone"></i> Phone Number <span className="sbf-req">*</span>
              </label>
              <input
                id="sbf-phone"
                type="tel"
                placeholder="Enter your phone number"
                required
                value={formData.customer_phone}
                onChange={(e) => setFormData({ ...formData, customer_phone: e.target.value })}
              />
            </div>
          </div>
          <div className="sbf-field">
            <label htmlFor="sbf-email">
              <i className="fa fa-envelope"></i> Email Address
            </label>
            <input
              id="sbf-email"
              type="email"
              placeholder="Enter your email address"
              value={formData.customer_email}
              onChange={(e) => setFormData({ ...formData, customer_email: e.target.value })}
            />
          </div>
          <div className="sbf-field">
            <label htmlFor="sbf-service">
              <i className="fa fa-cog"></i> Service
            </label>
            <input
              id="sbf-service"
              type="text"
              value={serviceTitle}
              disabled
              className="sbf-disabled"
            />
          </div>
          <div className="sbf-field">
            <label htmlFor="sbf-message">
              <i className="fa fa-comment"></i> Additional Details
            </label>
            <textarea
              id="sbf-message"
              placeholder="Tell us more about your requirements..."
              rows={4}
              value={formData.message}
              onChange={(e) => setFormData({ ...formData, message: e.target.value })}
            ></textarea>
          </div>
          <button type="submit" className="sbf-btn sbf-btn-primary" disabled={status === 'loading'}>
            {status === 'loading' ? (
              <>
                <i className="fa fa-spinner fa-spin"></i> Submitting...
              </>
            ) : (
              <>
                <i className="fa fa-paper-plane"></i> Submit Booking
              </>
            )}
          </button>
          {status === 'error' && (
            <div className="sbf-error">
              <i className="fa fa-exclamation-triangle"></i> Something went wrong. Please try again.
            </div>
          )}
        </form>
      )}
    </div>
  )
}
