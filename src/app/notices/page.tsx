'use client'
import React, { useState, useEffect } from 'react'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createClient } from '@/lib/supabase/client'

interface NoticeDownloadItem {
  id: string
  title: string
  content: string | null
  type: 'Notice' | 'News' | 'Download'
  file_url: string | null
  created_at: string
}

const defaultNotices: NoticeDownloadItem[] = [
  {
    id: 'n1',
    title: 'Important: Eid-ul-Fitr Holiday Announcement',
    content: 'Please be informed that Fonet Stationary Center will remain closed on Eid-ul-Fitr holiday. Normal business hours (7:00 AM - 7:00 PM) will resume from the following day.',
    type: 'Notice',
    file_url: null,
    created_at: new Date(Date.now() - 3 * 24 * 60 * 60 * 1000).toISOString()
  },
  {
    id: 'n2',
    title: 'Launch of Online Document Translation Portal',
    content: 'We are thrilled to announce the launch of our new online Notary & Translation Request portal. Customers can now upload citizenship certificates, birth certificates, and valuation documents directly from their homes and receive prompt service updates.',
    type: 'News',
    file_url: null,
    created_at: new Date(Date.now() - 10 * 24 * 60 * 60 * 1000).toISOString()
  },
  {
    id: 'n3',
    title: 'Bulk PVC Card & Visiting Card Print Discounts',
    content: 'Get up to 20% off on all bulk PVC card printing (ID cards, membership cards) and visiting card designs this month. Contact us via mobile or email for customized quotations.',
    type: 'News',
    file_url: null,
    created_at: new Date(Date.now() - 15 * 24 * 60 * 60 * 1000).toISOString()
  }
]

const defaultDownloads: NoticeDownloadItem[] = [
  {
    id: 'd1',
    title: 'Relationship Certificate English Translation Template (Format)',
    content: 'Standard format template for translating Relationship Certificates from Nepali to English. Helpful for visa processing.',
    type: 'Download',
    file_url: '/templates/Relationship_Certificate_Translation_Format.pdf',
    created_at: new Date().toISOString()
  },
  {
    id: 'd2',
    title: 'Birth Certificate English Translation Template (Format)',
    content: 'Standard official template for translating Birth Registration certificates into English.',
    type: 'Download',
    file_url: '/templates/Birth_Certificate_Translation_Format.pdf',
    created_at: new Date().toISOString()
  },
  {
    id: 'd3',
    title: 'Marriage Certificate English Translation Template (Format)',
    content: 'Official translation standard template for Marriage Registration certificates.',
    type: 'Download',
    file_url: '/templates/Marriage_Certificate_Translation_Format.pdf',
    created_at: new Date().toISOString()
  },
  {
    id: 'd4',
    title: 'PAN Registration Application Form (Blank)',
    content: 'Official Inland Revenue Department application form for getting a new Personal/Business PAN Card.',
    type: 'Download',
    file_url: '/templates/PAN_Application_Form.pdf',
    created_at: new Date().toISOString()
  }
]

export default function NoticesPage() {
  const [activeTab, setActiveTab] = useState<'notice' | 'download'>('notice')
  const [items, setItems] = useState<NoticeDownloadItem[]>([])
  const [loading, setLoading] = useState(true)
  const [searchQuery, setSearchQuery] = useState('')

  useEffect(() => {
    async function fetchItems() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('notices_downloads')
          .select('*')
          .eq('is_active', true)
          .order('sort_order', { ascending: true })
          .order('created_at', { ascending: false })

        if (error) throw error

        if (data && data.length > 0) {
          setItems(data)
        } else {
          setItems([...defaultNotices, ...defaultDownloads])
        }
      } catch (err) {
        console.error('Error fetching notices/downloads', err)
        setItems([...defaultNotices, ...defaultDownloads])
      } finally {
        setLoading(false)
      }
    }
    fetchItems()
  }, [])

  const filteredItems = items.filter(item => {
    const isCorrectType = activeTab === 'notice' 
      ? (item.type === 'Notice' || item.type === 'News') 
      : item.type === 'Download'
    
    const matchesSearch = item.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          (item.content && item.content.toLowerCase().includes(searchQuery.toLowerCase()))

    return isCorrectType && matchesSearch
  })

  return (
    <div>
      <Header />

      {/* Page Header */}
      <div className="inner-banner">
        <div className="container">
          <h1>Notice & Downloads</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Notice & Downloads</li>
          </ul>
        </div>
      </div>

      <div className="notices-section" style={{ padding: '70px 0', background: '#f8f9fa' }}>
        <div className="container">
          <div className="head_white head_center" style={{ marginBottom: 40 }}>
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">INFORMATION HUB</div>
              <h2>NEWS, ANNOUNCEMENTS & TEMPLATES</h2>
            </div>
          </div>

          {/* Search and Tabs Container */}
          <div className="tabs-search-container" style={{
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            flexWrap: 'wrap',
            gap: 20,
            marginBottom: 40,
            background: '#fff',
            padding: 20,
            borderRadius: 12,
            border: '1px solid #eee',
            boxShadow: '0 4px 15px rgba(0,0,0,0.02)'
          }}>
            {/* Tab Controls */}
            <div className="notice-tab-controls" style={{ display: 'flex', gap: 10 }}>
              <button
                onClick={() => setActiveTab('notice')}
                className={activeTab === 'notice' ? 'active' : ''}
                style={{
                  padding: '10px 22px',
                  borderRadius: 8,
                  border: '1px solid #3347B0',
                  background: activeTab === 'notice' ? '#3347B0' : 'transparent',
                  color: activeTab === 'notice' ? '#fff' : '#3347B0',
                  cursor: 'pointer',
                  fontWeight: 600,
                  fontSize: 14,
                  transition: 'all 0.3s'
                }}
              >
                <i className="fa fa-bullhorn" style={{ marginRight: 8 }}></i> Notices & News
              </button>
              <button
                onClick={() => setActiveTab('download')}
                className={activeTab === 'download' ? 'active' : ''}
                style={{
                  padding: '10px 22px',
                  borderRadius: 8,
                  border: '1px solid #3347B0',
                  background: activeTab === 'download' ? '#3347B0' : 'transparent',
                  color: activeTab === 'download' ? '#fff' : '#3347B0',
                  cursor: 'pointer',
                  fontWeight: 600,
                  fontSize: 14,
                  transition: 'all 0.3s'
                }}
              >
                <i className="fa fa-download" style={{ marginRight: 8 }}></i> Document Downloads
              </button>
            </div>

            {/* Search Input */}
            <div className="search-bar" style={{ position: 'relative', width: '100%', maxWidth: 350 }}>
              <input
                type="text"
                placeholder={`Search ${activeTab === 'notice' ? 'notices' : 'downloads'}...`}
                value={searchQuery}
                onChange={e => setSearchQuery(e.target.value)}
                style={{
                  width: '100%',
                  padding: '10px 40px 10px 15px',
                  borderRadius: 8,
                  border: '1px solid #ddd',
                  fontSize: 14,
                  boxSizing: 'border-box'
                }}
              />
              <i className="fa fa-search" style={{ position: 'absolute', right: 15, top: '50%', transform: 'translateY(-50%)', color: '#888' }}></i>
            </div>
          </div>

          {loading ? (
            <div style={{ display: 'flex', justifyContent: 'center', padding: '100px 0' }}>
              <div className="spinner"></div>
            </div>
          ) : (
            <div>
              {filteredItems.length === 0 ? (
                <div style={{ textAlign: 'center', padding: '60px 20px', background: '#fff', borderRadius: 12, border: '1px solid #eee' }}>
                  <i className="fa fa-folder-open-o" style={{ fontSize: 48, color: '#ccc', marginBottom: 15 }}></i>
                  <h3 style={{ margin: 0, color: '#666', fontSize: 18 }}>No items found matching &quot;{searchQuery}&quot;</h3>
                </div>
              ) : (
                <div className="row" style={{ display: 'flex', flexWrap: 'wrap', gap: 20 }}>
                  {activeTab === 'notice' ? (
                    // Notices and News Render
                    filteredItems.map(item => (
                      <div key={item.id} className="col-xs-12" style={{ width: '100%' }}>
                        <div className="notice-card" style={{
                          background: '#fff',
                          padding: 30,
                          borderRadius: 12,
                          border: '1px solid #eee',
                          boxShadow: '0 4px 15px rgba(0,0,0,0.03)',
                          borderLeft: `5px solid ${item.type === 'Notice' ? '#e74c3c' : '#27ae60'}`
                        }}>
                          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', flexWrap: 'wrap', gap: 10, marginBottom: 15 }}>
                            <h3 style={{ margin: 0, fontSize: 18, fontWeight: 700, color: '#333' }}>{item.title}</h3>
                            <span style={{
                              fontSize: 11,
                              fontWeight: 700,
                              background: item.type === 'Notice' ? '#fde8e7' : '#e3f9eb',
                              color: item.type === 'Notice' ? '#e74c3c' : '#27ae60',
                              padding: '4px 10px',
                              borderRadius: 6,
                              textTransform: 'uppercase'
                            }}>{item.type}</span>
                          </div>
                          
                          <p style={{ fontSize: 14, color: '#555', lineHeight: 1.7, marginBottom: 15, whiteSpace: 'pre-wrap' }}>
                            {item.content}
                          </p>

                          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', fontSize: 12, color: '#888', borderTop: '1px solid #f9f9f9', paddingTop: 15 }}>
                            <span>
                              <i className="fa fa-calendar" style={{ marginRight: 6 }}></i>
                              {new Date(item.created_at).toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' })}
                            </span>
                            {item.file_url && (
                              <a href={item.file_url} target="_blank" rel="noopener noreferrer" style={{ color: '#3347B0', fontWeight: 600, display: 'flex', alignItems: 'center', gap: 5 }}>
                                <i className="fa fa-paperclip"></i> View Attachment
                              </a>
                            )}
                          </div>
                        </div>
                      </div>
                    ))
                  ) : (
                    // Downloads Render (Grid of cards)
                    filteredItems.map(item => (
                      <div key={item.id} className="col-lg-4 col-md-6 col-sm-12 col-xs-12" style={{ marginBottom: 10 }}>
                        <div className="download-card" style={{
                          background: '#fff',
                          padding: 25,
                          borderRadius: 12,
                          border: '1px solid #eee',
                          boxShadow: '0 4px 15px rgba(0,0,0,0.03)',
                          display: 'flex',
                          flexDirection: 'column',
                          height: '100%',
                          minHeight: 220
                        }}>
                          <div style={{ display: 'flex', alignItems: 'center', gap: 12, marginBottom: 15 }}>
                            <div style={{
                              width: 45,
                              height: 45,
                              borderRadius: 8,
                              background: '#eef1ff',
                              display: 'flex',
                              alignItems: 'center',
                              justifyContent: 'center',
                              flexShrink: 0
                            }}>
                              <i className="fa fa-file-pdf-o" style={{ color: '#3347B0', fontSize: 20 }}></i>
                            </div>
                            <h3 style={{ margin: 0, fontSize: 15, fontWeight: 700, color: '#333', lineHeight: 1.4, display: '-webkit-box', WebkitLineClamp: 2, WebkitBoxOrient: 'vertical', overflow: 'hidden' }}>
                              {item.title}
                            </h3>
                          </div>

                          <p style={{ fontSize: 13, color: '#666', lineHeight: 1.6, marginBottom: 20, flexGrow: 1 }}>
                            {item.content || 'Download template format for document verification or administrative uses.'}
                          </p>

                          <a
                            href={item.file_url || '#'}
                            download
                            target="_blank"
                            rel="noopener noreferrer"
                            style={{
                              padding: '10px',
                              background: '#3347B0',
                              color: '#fff',
                              border: 'none',
                              borderRadius: 8,
                              textAlign: 'center',
                              fontWeight: 600,
                              fontSize: 13,
                              display: 'flex',
                              alignItems: 'center',
                              justifyContent: 'center',
                              gap: 8,
                              textDecoration: 'none',
                              boxShadow: '0 4px 10px rgba(51, 71, 176, 0.15)',
                              transition: 'all 0.3s'
                            }}
                          >
                            <i className="fa fa-download"></i> Download File
                          </a>
                        </div>
                      </div>
                    ))
                  )}
                </div>
              )}
            </div>
          )}
        </div>
      </div>

      <Footer />
    </div>
  )
}
