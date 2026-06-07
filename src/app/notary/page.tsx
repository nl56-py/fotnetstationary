'use client'
import React, { useState, useEffect } from 'react'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createClient } from '@/lib/supabase/client'

// Notary Services structural definitions (excluding rates/prices)
const serviceCategories = [
  {
    id: 'translation',
    title: 'Translation (Nepali/English)',
    icon: 'fa-language',
    description: 'Accurate and officially certified translations for format and non-format documents.',
    items: [
      {
        code: 'F',
        name: 'Format Translation',
        details: 'Citizenship, Birth, Death, Marriage, Land ownership (Lalpurja), PAN, Cottage Industry, and Company Certificates, etc.'
      },
      {
        code: 'NF',
        name: 'Non-Format Translation (Small Size)',
        details: 'Pension Certificates, Share Certificates, Business Certificates, and Recommendation Letters (Salary Income, Income Source, Recommendation for Birth/Marriage, Name Different, Address Change, etc.)'
      },
      {
        code: 'LNF',
        name: 'Long Non-Format Translation',
        details: 'Dhitobandhak (Mortgage), Pass Tamasuk (Rajinama/Deed of Transfer), Dristibandhaki, Contracts, Land Leases, House Rent Agreements, Respect Certificates, House/Property Tax, and Insurance Certificates, etc.'
      }
    ]
  },
  {
    id: 'notary-stamp',
    title: 'Notary / Attested (Stamp Only)',
    icon: 'fa-certificate',
    description: 'Official attestation and stamp services for academic, business, and legal certificates.',
    items: [
      {
        code: 'Att',
        name: 'Attested Document Stamp',
        details: 'Attestation of academic transcripts, character certificates, citizenship copies, and normal certificates.'
      },
      {
        code: 'Aff',
        name: 'Affidavit & Sponsorship Letters',
        details: 'Official stamping of affidavits, sponsor letters, house rent contracts, and land lease agreements.'
      }
    ]
  },
  {
    id: 'ca-pv-ad',
    title: 'Towards (CA / PV / AD)',
    icon: 'fa-line-chart',
    description: 'Valuations, audit reports, and chartered accountant certifications with exact document checklists.',
    items: [
      {
        code: 'PV-Normal',
        name: 'Property Valuation (Normal)',
        details: 'Official valuation reports for general purposes.',
        requiredDocs: 'Relationship Certificate, Land Ownership Certificate (Lalpurja).'
      },
      {
        code: 'PV-Bank',
        name: 'Property Valuation (For Bank)',
        details: 'Valuations required for bank loans and official procedures.',
        requiredDocs: 'Land ownership certificate (Lalpurja), official Land Map (Napi naksa), Char Killa (Boundary Certificate), Citizenship certificate of both owner and applicant, etc.'
      },
      {
        code: 'AD-Normal',
        name: 'Audit Report (Normal)',
        details: 'Standard financial audit reports for small businesses.',
        requiredDocs: 'PAN Certificate, Business Registration Certificate.'
      },
      {
        code: 'AD-CashFlow',
        name: 'Audit Report (Cash Flow)',
        details: 'Audits highlighting comprehensive statement of cash flows.',
        requiredDocs: 'PAN Certificate, Business Registration Certificate.'
      },
      {
        code: 'AD-Udin',
        name: 'Audit Report (UDIN No.)',
        details: 'Official audit reports verified with Unique Document Identification Number (UDIN).',
        requiredDocs: 'PAN Certificate, Business Registration Certificate, Tax Clearance Certificate, Company Login Credentials (Username & Password/Company Passport).'
      },
      {
        code: 'CA-Cert',
        name: 'Chartered Accountant Certification',
        details: 'Full CA certifications for visa applications, financial standing, or business compliance.',
        requiredDocs: 'Relationship Certificate, Property Valuation Report, Bank Balance Certificate, Source of Income Documents.'
      }
    ]
  },
  {
    id: 'paper-prep',
    title: 'Document & Paper Preparation',
    icon: 'fa-file-text-o',
    description: 'Expert drafting and layout for lease agreements, partnerships, and legal declarations.',
    items: [
      {
        code: 'Prep',
        name: 'Paper Drafting & Layout',
        details: 'Preparing drafts for House Rent Agreements, Land Lease Agreements, Partnership Agreements, and Affidavits.'
      }
    ]
  }
]

export default function NotaryPage() {
  const [activeTab, setActiveTab] = useState('translation')
  const [subServices, setSubServices] = useState<{ code: string; name: string }[]>([])
  
  // Form States
  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [phone, setPhone] = useState('')
  const [category, setCategory] = useState('translation')
  const [subService, setSubService] = useState('')
  const [driveLink, setDriveLink] = useState('')
  const [message, setMessage] = useState('')
  const [file, setFile] = useState<File | null>(null)
  
  const [uploading, setUploading] = useState(false)
  const [submitStatus, setSubmitStatus] = useState<{ type: 'success' | 'error' | null; msg: string }>({ type: null, msg: '' })

  // Update sub-service list when category changes
  useEffect(() => {
    const selected = serviceCategories.find(c => c.id === category)
    if (selected) {
      setSubServices(selected.items.map(i => ({ code: i.code, name: i.name })))
      setSubService(selected.items[0]?.code || '')
    }
  }, [category])

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
      setFile(e.target.files[0])
    }
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    if (!name || !phone) {
      setSubmitStatus({ type: 'error', msg: 'Name and phone number are required.' })
      return
    }

    setUploading(true)
    setSubmitStatus({ type: null, msg: '' })

    try {
      const supabase = createClient()
      let uploadedFileUrl = ''

      // 1. Upload File if selected
      if (file) {
        const fileExt = file.name.split('.').pop()
        const fileName = `${Math.random().toString(36).substring(2)}-${Date.now()}.${fileExt}`
        const filePath = `notary/${fileName}`

        const { error: uploadError } = await supabase.storage
          .from('documents')
          .upload(filePath, file)

        if (uploadError) {
          throw new Error(`File upload failed: ${uploadError.message}`)
        }

        const { data: urlData } = supabase.storage
          .from('documents')
          .getPublicUrl(filePath)

        uploadedFileUrl = urlData.publicUrl
      }

      // 2. Save Notary Request
      const selectedCategory = serviceCategories.find(c => c.id === category)?.title || category
      const selectedSubService = subServices.find(s => s.code === subService)?.name || subService

      const response = await fetch('/api/notary', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          customer_name: name,
          customer_email: email,
          customer_phone: phone,
          service_type: selectedCategory,
          sub_service_type: selectedSubService,
          message: message,
          file_url: uploadedFileUrl || null,
          drive_link: driveLink || null
        })
      })

      const result = await response.json()

      if (!response.ok) {
        throw new Error(result.error || 'Failed to submit request')
      }

      setSubmitStatus({
        type: 'success',
        msg: 'Your Notary Service Request has been submitted successfully! Our team will contact you shortly.'
      })

      // Reset Form
      setName('')
      setEmail('')
      setPhone('')
      setDriveLink('')
      setMessage('')
      setFile(null)
      const fileInput = document.getElementById('file-upload') as HTMLInputElement
      if (fileInput) fileInput.value = ''
      
    } catch (err: any) {
      console.error(err)
      setSubmitStatus({ type: 'error', msg: err.message || 'An unexpected error occurred. Please try again.' })
    } finally {
      setUploading(false)
    }
  }

  return (
    <div>
      <Header />

      {/* Page Header */}
      <div className="inner-banner">
        <div className="container">
          <h1>Notary & Translation Services</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Notary Documents</li>
          </ul>
        </div>
      </div>

      <div className="notary-section-area" style={{ padding: '70px 0', background: '#f8f9fa' }}>
        <div className="container">
          <div className="head_white head_center" style={{ marginBottom: 40 }}>
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">FONET DOCUMENT SOLUTION</div>
              <h2>NOTARY & DOCUMENT SERVICES</h2>
            </div>
          </div>

          <p className="notary-intro-text" style={{ textAlign: 'center', maxWidth: 800, margin: '0 auto 50px auto', fontSize: 16, lineHeight: 1.7, color: '#555' }}>
            We provide verified translations, attestation certifications, financial reports, property valuations, and paper preparation services. Select a category below to explore details and checklists, and securely upload your files or drive links to place a request.
          </p>

          <div className="row">
            {/* Left Column: Service Tabs & Listings */}
            <div className="col-lg-7 col-md-7 col-sm-12 col-xs-12">
              <div className="notary-tabs-container" style={{ display: 'flex', gap: 10, flexWrap: 'wrap', marginBottom: 25 }}>
                {serviceCategories.map((cat) => (
                  <button
                    key={cat.id}
                    onClick={() => setActiveTab(cat.id)}
                    className={activeTab === cat.id ? 'active' : ''}
                    style={{
                      padding: '12px 20px',
                      borderRadius: 8,
                      border: '1px solid #3347B0',
                      background: activeTab === cat.id ? '#3347B0' : '#fff',
                      color: activeTab === cat.id ? '#fff' : '#3347B0',
                      cursor: 'pointer',
                      fontWeight: 600,
                      fontSize: 14,
                      display: 'flex',
                      alignItems: 'center',
                      gap: 8,
                      transition: 'all 0.3s'
                    }}
                  >
                    <i className={`fa ${cat.icon}`}></i>
                    {cat.title.split(' ')[0]} {cat.title.split(' ')[1] || ''}
                  </button>
                ))}
              </div>

              {/* Tab Content */}
              <div className="notary-tab-content-panel" style={{ background: '#fff', padding: 30, borderRadius: 12, border: '1px solid #eee', boxShadow: '0 4px 15px rgba(0,0,0,0.03)' }}>
                {serviceCategories.filter(cat => cat.id === activeTab).map((cat) => (
                  <div key={cat.id}>
                    <h3 style={{ fontFamily: "'Oswald', sans-serif", fontSize: 22, color: '#222', marginBottom: 10 }}>{cat.title}</h3>
                    <p style={{ color: '#666', fontSize: 14, lineHeight: 1.6, marginBottom: 25 }}>{cat.description}</p>
                    
                    <div className="notary-items-list" style={{ display: 'flex', flexDirection: 'column', gap: 20 }}>
                      {cat.items.map((item, idx) => (
                        <div key={idx} style={{ padding: 18, borderLeft: '4px solid #3347B0', background: '#fafafa', borderRadius: '0 8px 8px 0' }}>
                          <h4 style={{ margin: '0 0 8px 0', fontSize: 16, fontWeight: 700, color: '#3347B0' }}>
                            <span style={{ background: '#3347B0', color: '#fff', fontSize: 11, padding: '2px 8px', borderRadius: 4, marginRight: 8 }}>{item.code}</span>
                            {item.name}
                          </h4>
                          <p style={{ margin: '0 0 10px 0', fontSize: 14, color: '#444', lineHeight: 1.5 }}>
                            <strong>Scope:</strong> {item.details}
                          </p>
                          {'requiredDocs' in item && item.requiredDocs && (
                            <div style={{ marginTop: 8, padding: '8px 12px', background: '#fff', border: '1px dashed #3347B0', borderRadius: 6, fontSize: 13, color: '#555' }}>
                              <i className="fa fa-folder-open-o" style={{ color: '#3347B0', marginRight: 8 }}></i>
                              <strong>Required Documents:</strong> {item.requiredDocs}
                            </div>
                          )}
                        </div>
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* Right Column: Request Submission Form */}
            <div className="col-lg-5 col-md-5 col-sm-12 col-xs-12">
              <div className="notary-form-panel" style={{ background: '#fff', padding: 30, borderRadius: 12, border: '1px solid #eee', boxShadow: '0 10px 30px rgba(0,0,0,0.06)' }}>
                <h3 style={{ fontFamily: "'Oswald', sans-serif", fontSize: 22, color: '#3347B0', marginBottom: 20, textAlign: 'center' }}>
                  <i className="fa fa-paper-plane" style={{ marginRight: 10 }}></i>
                  Request Document Service
                </h3>

                <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: 15 }}>
                  <div className="form-group" style={{ display: 'flex', flexDirection: 'column', gap: 5 }}>
                    <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Full Name <span style={{ color: 'red' }}>*</span></label>
                    <input
                      type="text"
                      placeholder="Enter your name"
                      value={name}
                      onChange={e => setName(e.target.value)}
                      style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 14 }}
                      required
                    />
                  </div>

                  <div className="form-group" style={{ display: 'flex', flexDirection: 'column', gap: 5 }}>
                    <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Phone Number <span style={{ color: 'red' }}>*</span></label>
                    <input
                      type="tel"
                      placeholder="Enter phone number"
                      value={phone}
                      onChange={e => setPhone(e.target.value)}
                      style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 14 }}
                      required
                    />
                  </div>

                  <div className="form-group" style={{ display: 'flex', flexDirection: 'column', gap: 5 }}>
                    <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Email Address</label>
                    <input
                      type="email"
                      placeholder="Enter email address"
                      value={email}
                      onChange={e => setEmail(e.target.value)}
                      style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 14 }}
                    />
                  </div>

                  <div className="row" style={{ display: 'flex', gap: 10 }}>
                    <div className="col-xs-6" style={{ flex: 1, display: 'flex', flexDirection: 'column', gap: 5 }}>
                      <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Service Category</label>
                      <select
                        value={category}
                        onChange={e => setCategory(e.target.value)}
                        style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 13 }}
                      >
                        <option value="translation">Translation</option>
                        <option value="notary-stamp">Notary/Attested</option>
                        <option value="ca-pv-ad">CA / PV / AD</option>
                        <option value="paper-prep">Paper Prep</option>
                      </select>
                    </div>

                    <div className="col-xs-6" style={{ flex: 1, display: 'flex', flexDirection: 'column', gap: 5 }}>
                      <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Sub Service</label>
                      <select
                        value={subService}
                        onChange={e => setSubService(e.target.value)}
                        style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 13 }}
                      >
                        {subServices.map(s => <option key={s.code} value={s.code}>{s.name}</option>)}
                      </select>
                    </div>
                  </div>

                  <div className="form-group" style={{ display: 'flex', flexDirection: 'column', gap: 5 }}>
                    <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Upload Document (PDF / Images / Docs)</label>
                    <input
                      type="file"
                      id="file-upload"
                      accept=".pdf,.png,.jpg,.jpeg,.doc,.docx"
                      onChange={handleFileChange}
                      style={{ padding: 8, border: '1px dashed #ccc', borderRadius: 8, fontSize: 13, background: '#fafafa' }}
                    />
                    <small style={{ fontSize: 11, color: '#888' }}>Upload direct documents if available (max 10MB)</small>
                  </div>

                  <div className="form-group" style={{ display: 'flex', flexDirection: 'column', gap: 5 }}>
                    <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Or Paste Google Drive / Cloud Link</label>
                    <input
                      type="url"
                      placeholder="https://drive.google.com/..."
                      value={driveLink}
                      onChange={e => setDriveLink(e.target.value)}
                      style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 14 }}
                    />
                  </div>

                  <div className="form-group" style={{ display: 'flex', flexDirection: 'column', gap: 5 }}>
                    <label style={{ fontSize: 13, fontWeight: 600, color: '#444' }}>Special Instructions / Details</label>
                    <textarea
                      placeholder="Write any additional details, translation requirements, or company usernames here..."
                      rows={3}
                      value={message}
                      onChange={e => setMessage(e.target.value)}
                      style={{ padding: 11, border: '1px solid #ccc', borderRadius: 8, fontSize: 14, resize: 'vertical' }}
                    />
                  </div>

                  {submitStatus.type && (
                    <div style={{
                      padding: 12,
                      borderRadius: 8,
                      fontSize: 14,
                      color: submitStatus.type === 'success' ? '#155724' : '#721c24',
                      background: submitStatus.type === 'success' ? '#d4edda' : '#f8d7da',
                      border: `1px solid ${submitStatus.type === 'success' ? '#c3e6cb' : '#f5c6cb'}`
                    }}>
                      {submitStatus.msg}
                    </div>
                  )}

                  <button
                    type="submit"
                    disabled={uploading}
                    style={{
                      padding: '14px',
                      background: '#3347B0',
                      color: '#fff',
                      border: 'none',
                      borderRadius: 8,
                      cursor: uploading ? 'not-allowed' : 'pointer',
                      fontWeight: 700,
                      fontSize: 15,
                      textTransform: 'uppercase',
                      letterSpacing: 1,
                      boxShadow: '0 4px 15px rgba(51, 71, 176, 0.3)',
                      transition: 'all 0.3s'
                    }}
                  >
                    {uploading ? (
                      <span><i className="fa fa-spinner fa-spin" style={{ marginRight: 8 }}></i>Submitting...</span>
                    ) : (
                      'Submit Request'
                    )}
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
