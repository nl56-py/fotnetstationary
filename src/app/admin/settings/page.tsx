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
    title: 'Social Media',
    keys: ['facebook', 'youtube', 'twitter', 'instagram'],
  },
  {
    title: 'Content',
    keys: ['about_text', 'history_text', 'mission_text', 'vision_text', 'copyright'],
  },
  {
    title: 'Announcement Popup Banner',
    keys: ['banner_notice_active', 'banner_notice_text', 'banner_notice_image_url'],
  },
]

export default function AdminSettings() {
  const [settings, setSettings] = useState<SiteSetting[]>([])
  const [loading, setLoading] = useState(true)
  const [saving, setSaving] = useState(false)

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

  const updateSetting = (key: string, value: string) => {
    setSettings(settings.map(s => s.key === key ? { ...s, value } : s))
  }

  const handleSave = async () => {
    setSaving(true)
    const records = settings.map(s => {
      const record: any = {
        key: s.key,
        value: s.value,
        updated_at: new Date().toISOString()
      }
      if (s.id && s.id.length > 15) {
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
              return (
                <div key={key} style={{ gridColumn: isLong ? 'span 2' : 'span 1' }}>
                  <label style={{ display: 'block', fontSize: 13, color: '#666', marginBottom: 6, fontWeight: 500 }}>
                    {formatLabel(key)}
                  </label>
                  {isLong ? (
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
