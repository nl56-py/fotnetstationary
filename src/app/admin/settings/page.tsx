'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { SiteSetting } from '@/lib/types'

const settingGroups = [
  {
    title: 'Business Information',
    keys: ['site_name', 'site_tagline', 'phone', 'mobile', 'email', 'fax', 'address', 'working_hours'],
  },
  {
    title: 'Homepage Hero',
    keys: ['hero_background_image_url'],
  },
  {
    title: 'Social Media',
    keys: ['facebook', 'youtube', 'twitter', 'instagram'],
  },
  {
    title: 'Content',
    keys: ['about_text', 'history_text', 'mission_text', 'vision_text', 'copyright'],
  },
]

export default function AdminSettings() {
  const [settings, setSettings] = useState<SiteSetting[]>([])
  const [loading, setLoading] = useState(true)
  const [saving, setSaving] = useState(false)
  const [uploadingKey, setUploadingKey] = useState<string | null>(null)

  const supabase = createClient()

  useEffect(() => {
    const fetchSettings = async () => {
      const sb = createClient()
      const { data } = await sb.from('site_settings').select('*').order('key')
      let dbSettings = data || []
      
      const allKeys = settingGroups.flatMap(g => g.keys)
      const missingKeys = allKeys.filter(k => !dbSettings.some(s => s.key === k))
      
      if (missingKeys.length > 0) {
        const placeholders = missingKeys.map(k => ({
          id: Math.random().toString(),
          key: k,
          value: '',
          updated_at: new Date().toISOString()
        }))
        dbSettings = [...dbSettings, ...placeholders]
      }
      
      setSettings(dbSettings)
      setLoading(false)
    }
    fetchSettings()
  }, [])

  const updateSetting = (key: string, value: string) => {
    setSettings(settings.map(s => s.key === key ? { ...s, value } : s))
  }

  const handleImageUpload = async (key: string, file: File) => {
    setUploadingKey(key)
    try {
      const fileExt = file.name.split('.').pop()
      const fileName = `site/${key}-${Date.now()}.${fileExt}`

      const { error } = await supabase.storage
        .from('documents')
        .upload(fileName, file, { upsert: true })

      if (error) throw error

      const { data } = supabase.storage.from('documents').getPublicUrl(fileName)
      updateSetting(key, data.publicUrl)
    } catch (err: any) {
      alert('File upload failed: ' + (err.message || 'Unknown error'))
    } finally {
      setUploadingKey(null)
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
      if (s.id && /^[0-9a-f]{8}-[0-9a-f]{4}-[45][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(s.id)) {
        record.id = s.id
      }
      return record
    })

    const { error } = await supabase.from('site_settings').upsert(records, { onConflict: 'key' })
    
    if (error) {
      alert('Error saving settings: ' + error.message)
    } else {
      alert('Settings saved successfully!')
      const { data } = await supabase.from('site_settings').select('*').order('key')
      if (data) setSettings(data)
    }
    setSaving(false)
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  const formatLabel = (key: string) => key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'flex-end', marginBottom: 20 }}>
        <button onClick={handleSave} disabled={saving}
          style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>
          <i className="fa fa-save" style={{ marginRight: 8 }}></i>
          {saving ? 'Saving...' : 'Save All Changes'}
        </button>
      </div>

      {settingGroups.map(group => (
        <div key={group.title} style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 20, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
          <h3 style={{ fontSize: 16, color: '#222', fontFamily: "'Oswald', sans-serif", marginBottom: 20, paddingBottom: 10, borderBottom: '1px solid #f0f0f0' }}>
            {group.title}
          </h3>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
            {group.keys.map(key => {
              const setting = settings.find(s => s.key === key)
              if (!setting) return null
              const isLong = ['about_text', 'history_text', 'mission_text', 'vision_text', 'banner_notice_text'].includes(key)
              const isHeroImage = key === 'hero_background_image_url'
              const isNoticeMedia = key === 'banner_notice_image_url'
              const isMediaUpload = isHeroImage || isNoticeMedia

              return (
                <div key={key} style={{ gridColumn: isLong || isMediaUpload ? 'span 2' : 'span 1' }}>
                  <label style={{ display: 'block', fontSize: 13, color: '#666', marginBottom: 6, fontWeight: 500 }}>
                    {formatLabel(key)}
                  </label>
                  {isMediaUpload ? (
                    <div style={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
                      <input value={setting.value || ''} onChange={e => updateSetting(key, e.target.value)}
                        placeholder={isHeroImage ? "/images/slider1.jpg or uploaded image URL" : "Uploaded image or PDF URL"}
                        style={{ width: '100%', padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, boxSizing: 'border-box' }} />
                      <div style={{ display: 'grid', gridTemplateColumns: '1fr 180px', gap: 15, alignItems: 'start' }}>
                        <div>
                          <input
                            type="file"
                            accept={isHeroImage ? "image/png,image/jpeg,image/webp,image/gif" : "image/png,image/jpeg,image/webp,image/gif,application/pdf"}
                            onChange={e => {
                              const file = e.target.files?.[0]
                              if (file) handleImageUpload(key, file)
                            }}
                            style={{ width: '100%', padding: 9, border: '1px dashed #d0d0d0', borderRadius: 8, background: '#fafafa', fontSize: 13, boxSizing: 'border-box' }}
                          />
                          <p style={{ margin: '8px 0 0 0', color: '#777', fontSize: 12, lineHeight: 1.5 }}>
                            {isHeroImage 
                              ? "Recommended size: 1920 x 760 px. The site displays the full image without cropping, so wide landscape images look best."
                              : "Upload a notice banner image (PNG, JPG, WEBP) or a PDF document."
                            }
                          </p>
                          {uploadingKey === key && <p style={{ margin: '8px 0 0 0', color: '#3347B0', fontSize: 12 }}>Uploading file...</p>}
                        </div>
                        {setting.value && (
                          <div style={{ border: '1px solid #eee', borderRadius: 8, padding: 8, background: '#fafafa', display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: 90 }}>
                            {setting.value.toLowerCase().split('?')[0].endsWith('.pdf') ? (
                              <a href={setting.value} target="_blank" rel="noopener noreferrer" style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', textDecoration: 'none', color: '#c61a1a', gap: 4 }}>
                                <i className="fa fa-file-pdf-o" style={{ fontSize: 36 }}></i>
                                <span style={{ fontSize: 11, fontWeight: 600, textAlign: 'center', wordBreak: 'break-all' }}>View PDF</span>
                              </a>
                            ) : (
                              <img src={setting.value} alt="Preview" style={{ width: '100%', height: 90, objectFit: 'contain', background: isHeroImage ? '#0d1e52' : '#f5f5f5', borderRadius: 6 }} />
                            )}
                          </div>
                        )}
                      </div>
                    </div>
                  ) : isLong ? (
                    <textarea value={setting.value || ''} onChange={e => updateSetting(key, e.target.value)}
                      style={{ width: '100%', padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, height: 100, resize: 'vertical', boxSizing: 'border-box' }} />
                  ) : (
                    <input value={setting.value || ''} onChange={e => updateSetting(key, e.target.value)}
                      style={{ width: '100%', padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, boxSizing: 'border-box' }} />
                  )}
                </div>
              )
            })}
          </div>
        </div>
      ))}
    </div>
  )
}
