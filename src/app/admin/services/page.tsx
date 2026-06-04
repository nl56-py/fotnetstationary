'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { Service } from '@/lib/types'

export default function AdminServices() {
  const [services, setServices] = useState<Service[]>([])
  const [loading, setLoading] = useState(true)
  const [editing, setEditing] = useState<Service | null>(null)
  const [showForm, setShowForm] = useState(false)
  const [form, setForm] = useState({ title: '', slug: '', description: '', icon: 'fa fa-print', sort_order: 0 })

  const supabase = createClient()

  const fetchServices = async () => {
    const { data } = await supabase.from('services').select('*').order('sort_order')
    setServices(data || [])
    setLoading(false)
  }

  useEffect(() => { fetchServices() }, [])

  const handleSave = async () => {
    const slug = form.slug || form.title.toLowerCase().replace(/[^a-z0-9]+/g, '-')
    if (editing) {
      await supabase.from('services').update({ ...form, slug }).eq('id', editing.id)
    } else {
      await supabase.from('services').insert({ ...form, slug })
    }
    setShowForm(false)
    setEditing(null)
    setForm({ title: '', slug: '', description: '', icon: 'fa fa-print', sort_order: 0 })
    fetchServices()
  }

  const handleEdit = (s: Service) => {
    setEditing(s)
    setForm({ title: s.title, slug: s.slug, description: s.description || '', icon: s.icon, sort_order: s.sort_order })
    setShowForm(true)
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this service?')) {
      await supabase.from('services').delete().eq('id', id)
      fetchServices()
    }
  }

  const handleToggle = async (id: string, is_active: boolean) => {
    await supabase.from('services').update({ is_active: !is_active }).eq('id', id)
    fetchServices()
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
        <p style={{ color: '#888', margin: 0 }}>{services.length} services total</p>
        <button onClick={() => { setEditing(null); setForm({ title: '', slug: '', description: '', icon: 'fa fa-print', sort_order: services.length + 1 }); setShowForm(true) }}
          style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>
          <i className="fa fa-plus" style={{ marginRight: 8 }}></i>Add Service
        </button>
      </div>

      {showForm && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 20, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
          <h4 style={{ marginBottom: 15 }}>{editing ? 'Edit Service' : 'Add New Service'}</h4>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
            <input placeholder="Title" value={form.title} onChange={e => setForm({ ...form, title: e.target.value })}
              style={{ padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            <input placeholder="Icon Class (e.g., fa fa-print)" value={form.icon} onChange={e => setForm({ ...form, icon: e.target.value })}
              style={{ padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            <textarea placeholder="Description" value={form.description} onChange={e => setForm({ ...form, description: e.target.value })}
              style={{ padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, gridColumn: 'span 2', height: 80 }} />
            <input type="number" placeholder="Sort Order" value={form.sort_order} onChange={e => setForm({ ...form, sort_order: parseInt(e.target.value) || 0 })}
              style={{ padding: 12, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
          </div>
          <div style={{ display: 'flex', gap: 10, marginTop: 15 }}>
            <button onClick={handleSave} style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Save</button>
            <button onClick={() => { setShowForm(false); setEditing(null) }} style={{ padding: '10px 25px', background: '#e0e0e0', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
          <thead>
            <tr style={{ background: '#f8f9fa', borderBottom: '2px solid #e0e0e0' }}>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>#</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Icon</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Title</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Description</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Status</th>
              <th style={{ padding: '12px 15px', textAlign: 'right', fontSize: 13, color: '#666' }}>Actions</th>
            </tr>
          </thead>
          <tbody>
            {services.map((s, idx) => (
              <tr key={s.id} style={{ borderBottom: '1px solid #f0f0f0' }}>
                <td style={{ padding: '12px 15px', fontSize: 14, color: '#888' }}>{idx + 1}</td>
                <td style={{ padding: '12px 15px' }}><i className={s.icon} style={{ fontSize: 20, color: '#3347B0' }}></i></td>
                <td style={{ padding: '12px 15px', fontSize: 14, fontWeight: 600 }}>{s.title}</td>
                <td style={{ padding: '12px 15px', fontSize: 13, color: '#666', maxWidth: 300, overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{s.description}</td>
                <td style={{ padding: '12px 15px' }}>
                  <button onClick={() => handleToggle(s.id, s.is_active)} style={{
                    padding: '4px 12px', borderRadius: 20, border: 'none', fontSize: 12, cursor: 'pointer',
                    background: s.is_active ? '#d4edda' : '#f8d7da', color: s.is_active ? '#155724' : '#721c24',
                  }}>{s.is_active ? 'Active' : 'Hidden'}</button>
                </td>
                <td style={{ padding: '12px 15px', textAlign: 'right' }}>
                  <button onClick={() => handleEdit(s)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#3347B0', marginRight: 10 }}>
                    <i className="fa fa-pencil"></i>
                  </button>
                  <button onClick={() => handleDelete(s.id)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#e74c3c' }}>
                    <i className="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  )
}
