'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { SiteSetting } from '@/lib/types'

export default function PopupNoticeManager() {
  const [settings, setSettings] = useState<SiteSetting[]>([])
  const [loading, setLoading] = useState(true)
  const [saving, setSaving] = useState(false)
  const [uploading, setUploading] = useState(false)

  const supabase = createClient()
  const keys = ['banner_notice_active', 'banner_notice_text', 'banner_notice_image_url']

  useEffect(() => {
    const fetchSettings = async () => {
      const { data } = await supabase
        .from('site_settings')
        .select('*')
        .in('key', keys)

      let dbSettings = data || []
      
      // Make sure all 3 keys exist in state
      const missingKeys = keys.filter(k => !dbSettings.some(s => s.key === k))
      if (missingKeys.length > 0) {
        const placeholders = missingKeys.map(k => ({
          id: Math.random().toString(),
          key: k,
          value: k === 'banner_notice_active' ? 'false' : '',
          updated_at: new Date().toISOString()
        }))
        dbSettings = [...dbSettings, ...placeholders]
      }
      
      setSettings(dbSettings)
      setLoading(false)
    }
    fetchSettings()
  }, [])

  const getSetting = (key: string) => settings.find(s => s.key === key)

  const updateSetting = (key: string, value: string) => {
    setSettings(prev => prev.map(s => s.key === key ? { ...s, value } : s))
  }

  const handleFileUpload = async (file: File) => {
    setUploading(true)
    try {
      const fileExt = file.name.split('.').pop()
      const fileName = `site/banner_notice_image_url-${Date.now()}.${fileExt}`

      const { error } = await supabase.storage
        .from('documents')
        .upload(fileName, file, { upsert: true })

      if (error) throw error

      const { data } = supabase.storage.from('documents').getPublicUrl(fileName)
      updateSetting('banner_notice_image_url', data.publicUrl)
    } catch (err: any) {
      alert('File upload failed: ' + (err.message || 'Unknown error'))
    } finally {
      setUploading(false)
    }
  }

  const handleSave = async () => {
    setSaving(true)
    const records = settings.map(s => {
      const record: any = {
        key: s.key,
        value: s.value,
        updated_at: new Date().toISOString()
      }
      // Only attach ID if it is a valid UUID to prevent database conflict errors
      if (s.id && /^[0-9a-f]{8}-[0-9a-f]{4}-[45][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(s.id)) {
        record.id = s.id
      }
      return record
    })

    const { error } = await supabase
      .from('site_settings')
      .upsert(records, { onConflict: 'key' })
    
    if (error) {
      alert('Error saving notice: ' + error.message)
    } else {
      alert('Notice popup saved successfully!')
      const { data } = await supabase
        .from('site_settings')
        .select('*')
        .in('key', keys)
      if (data) setSettings(data)
    }
    setSaving(false)
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  const activeSetting = getSetting('banner_notice_active')
  const textSetting = getSetting('banner_notice_text')
  const mediaSetting = getSetting('banner_notice_image_url')

  const isPublished = activeSetting?.value === 'true'

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
        <p style={{ color: '#666', margin: 0, fontSize: 14 }}>
          Manage the announcement popup notice that appears on the website homepage when visitors enter.
        </p>
        <button onClick={handleSave} disabled={saving}
          style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>
          <i className="fa fa-save" style={{ marginRight: 8 }}></i>
          {saving ? 'Saving...' : 'Save Notice Changes'}
        </button>
      </div>

      <div style={{ background: '#fff', borderRadius: 12, padding: 25, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        <h3 style={{ fontSize: 16, color: '#222', fontFamily: "'Oswald', sans-serif", marginBottom: 25, paddingBottom: 10, borderBottom: '1px solid #f0f0f0' }}>
          Notice Popup Configuration
        </h3>

        <div style={{ display: 'flex', flexDirection: 'column', gap: 20 }}>
          {/* Publish / Unpublish Status & Toggle */}
          <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', padding: '15px 20px', background: '#fafafa', borderRadius: 8, border: '1px solid #eee' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
              <div style={{
                width: 12, height: 12, borderRadius: '50%',
                background: isPublished ? '#27ae60' : '#e74c3c',
                boxShadow: isPublished ? '0 0 8px rgba(39,174,96,0.5)' : '0 0 8px rgba(231,76,60,0.5)'
              }}></div>
              <div>
                <span style={{ fontSize: 14, fontWeight: 600, color: '#333' }}>
                  Status: {isPublished ? 'Published (Active)' : 'Unpublished (Inactive)'}
                </span>
                <p style={{ margin: '3px 0 0 0', fontSize: 12, color: '#777' }}>
                  {isPublished ? 'The announcement banner is currently live on the homepage.' : 'The banner is hidden from site visitors.'}
                </p>
              </div>
            </div>
            
            <button
              type="button"
              onClick={() => updateSetting('banner_notice_active', isPublished ? 'false' : 'true')}
              style={{
                padding: '8px 18px',
                background: isPublished ? '#e74c3c' : '#27ae60',
                color: '#fff',
                border: 'none',
                borderRadius: 6,
                cursor: 'pointer',
                fontWeight: 600,
                fontSize: 13,
                transition: 'all 0.2s',
                boxShadow: isPublished ? '0 3px 8px rgba(231,76,60,0.15)' : '0 3px 8px rgba(39,174,96,0.15)'
              }}
            >
              {isPublished ? 'Unpublish Banner' : 'Publish Banner'}
            </button>
          </div>

          {/* Notice Text Content */}
          <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
            <label style={{ fontSize: 13, color: '#444', fontWeight: 600 }}>Notice Text Content *</label>
            <textarea
              value={textSetting?.value || ''}
              onChange={e => updateSetting('banner_notice_text', e.target.value)}
              placeholder="Type your notice announcement here..."
              style={{
                width: '100%', padding: 12, border: '1px solid #e0e0e0',
                borderRadius: 8, fontSize: 14, height: 120, resize: 'vertical',
                boxSizing: 'border-box', fontFamily: 'inherit'
              }}
            />
          </div>

          {/* Notice Image / PDF Upload */}
          <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
            <label style={{ fontSize: 13, color: '#444', fontWeight: 600 }}>Notice Attachment (Image or PDF)</label>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
              <input
                value={mediaSetting?.value || ''}
                onChange={e => updateSetting('banner_notice_image_url', e.target.value)}
                placeholder="Uploaded file URL (image or PDF)"
                style={{ width: '100%', padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, boxSizing: 'border-box' }}
              />
              
              <div style={{ display: 'grid', gridTemplateColumns: '1fr 180px', gap: 15, alignItems: 'start' }}>
                <div>
                  <input
                    type="file"
                    accept="image/png,image/jpeg,image/webp,image/gif,application/pdf"
                    onChange={e => {
                      const file = e.target.files?.[0]
                      if (file) handleFileUpload(file)
                    }}
                    style={{ width: '100%', padding: 9, border: '1px dashed #d0d0d0', borderRadius: 8, background: '#fafafa', fontSize: 13, boxSizing: 'border-box' }}
                  />
                  <p style={{ margin: '8px 0 0 0', color: '#777', fontSize: 12, lineHeight: 1.5 }}>
                    Upload a notice graphic (PNG, JPG, WEBP) or a PDF document. If PDF, it will render as a download link button in the notice popup.
                  </p>
                  {uploading && <p style={{ margin: '8px 0 0 0', color: '#3347B0', fontSize: 12 }}>Uploading file...</p>}
                </div>
                
                {mediaSetting?.value && (
                  <div style={{ border: '1px solid #eee', borderRadius: 8, padding: 8, background: '#fafafa', display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: 90 }}>
                    {mediaSetting.value.toLowerCase().split('?')[0].endsWith('.pdf') ? (
                      <a href={mediaSetting.value} target="_blank" rel="noopener noreferrer" style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', textDecoration: 'none', color: '#c61a1a', gap: 4 }}>
                        <i className="fa fa-file-pdf-o" style={{ fontSize: 36 }}></i>
                        <span style={{ fontSize: 11, fontWeight: 600, textAlign: 'center', wordBreak: 'break-all' }}>View PDF</span>
                      </a>
                    ) : (
                      <img src={mediaSetting.value} alt="Notice preview" style={{ width: '100%', height: 90, objectFit: 'contain', background: '#f5f5f5', borderRadius: 6 }} />
                    )}
                  </div>
                )}
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  )
}
