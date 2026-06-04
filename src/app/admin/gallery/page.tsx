'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { GalleryImage } from '@/lib/types'
import { getImageSrc } from '@/lib/media-helper'

export default function AdminGallery() {
  const [images, setImages] = useState<GalleryImage[]>([])
  const [loading, setLoading] = useState(true)
  const [showForm, setShowForm] = useState(false)
  const [editingItem, setEditingItem] = useState<GalleryImage | null>(null)
  
  const [form, setForm] = useState({ title: '', image_url: '', category: 'General', sort_order: 0 })

  const supabase = createClient()
  const categories = ['General', 'Printing', 'Photocopy', 'Products', 'Stationary', 'Events']

  const fetchImages = async () => {
    const { data } = await supabase.from('gallery_images').select('*').order('sort_order')
    setImages(data || [])
    setLoading(false)
  }

  useEffect(() => { fetchImages() }, [])

  const handleAdd = async () => {
    if (!form.image_url) return alert('Image URL is required')
    const sort_order = form.sort_order || images.length + 1
    
    await supabase.from('gallery_images').insert({ 
      title: form.title, 
      image_url: form.image_url, 
      category: form.category, 
      sort_order 
    })
    
    setForm({ title: '', image_url: '', category: 'General', sort_order: 0 })
    setShowForm(false)
    fetchImages()
  }

  const handleUpdate = async () => {
    if (!editingItem) return
    if (!editingItem.image_url) return alert('Image URL is required')

    await supabase.from('gallery_images')
      .update({
        title: editingItem.title,
        image_url: editingItem.image_url,
        category: editingItem.category,
        sort_order: editingItem.sort_order
      })
      .eq('id', editingItem.id)

    setEditingItem(null)
    fetchImages()
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this image?')) {
      await supabase.from('gallery_images').delete().eq('id', id)
      fetchImages()
    }
  }

  const handleStartEdit = (img: GalleryImage) => {
    setEditingItem(img)
    setShowForm(false)
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 25 }}>
        <p style={{ color: '#666', margin: 0, fontSize: 14 }}>Manage your product and service photos shown on the public Gallery page.</p>
        {!showForm && !editingItem && (
          <button onClick={() => setShowForm(true)}
            style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600, display: 'flex', alignItems: 'center', gap: 8 }}>
            <i className="fa fa-plus"></i>Add Image
          </button>
        )}
      </div>

      {/* ADD FORM */}
      {showForm && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Add Gallery Image</h4>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 2fr 1fr 1fr', gap: 15, marginBottom: 15 }}>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title</label>
              <input placeholder="e.g. Printing Service" value={form.title} onChange={e => setForm({ ...form, title: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>
            
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Image URL (Can paste Google Drive link)</label>
              <input placeholder="https://..." value={form.image_url} onChange={e => setForm({ ...form, image_url: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Category</label>
              <select value={form.category} onChange={e => setForm({ ...form, category: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}>
                {categories.map(c => <option key={c} value={c}>{c}</option>)}
              </select>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
              <input type="number" placeholder="0" value={form.sort_order || ''} onChange={e => setForm({ ...form, sort_order: parseInt(e.target.value) || 0 })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>
          </div>

          {/* Add Image Live Preview */}
          {form.image_url && (
            <div style={{ marginBottom: 20 }}>
              <div style={{ fontSize: 12, color: '#666', fontWeight: 600, marginBottom: 8 }}>Live Preview:</div>
              <div style={{ border: '1px dashed #ccc', borderRadius: 8, padding: 10, display: 'inline-block', background: '#fafafa' }}>
                <img 
                  src={getImageSrc(form.image_url)} 
                  alt="Preview" 
                  style={{ maxHeight: 150, borderRadius: 6, objectFit: 'contain' }}
                  onError={(e) => {
                    (e.target as HTMLElement).style.display = 'none';
                  }}
                />
              </div>
            </div>
          )}

          <div style={{ display: 'flex', gap: 10 }}>
            <button onClick={handleAdd} style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>Save</button>
            <button onClick={() => setShowForm(false)} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      {/* EDIT FORM */}
      {editingItem && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)', borderLeft: '4px solid #3347B0' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Edit Gallery Image</h4>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 2fr 1fr 1fr', gap: 15, marginBottom: 15 }}>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title</label>
              <input placeholder="Title" value={editingItem.title || ''} onChange={e => setEditingItem({ ...editingItem, title: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>
            
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Image URL</label>
              <input placeholder="Image URL" value={editingItem.image_url} onChange={e => setEditingItem({ ...editingItem, image_url: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Category</label>
              <select value={editingItem.category} onChange={e => setEditingItem({ ...editingItem, category: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}>
                {categories.map(c => <option key={c} value={c}>{c}</option>)}
              </select>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
              <input type="number" placeholder="Sort Order" value={editingItem.sort_order} onChange={e => setEditingItem({ ...editingItem, sort_order: parseInt(e.target.value) || 0 })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>
          </div>

          {/* Edit Image Live Preview */}
          {editingItem.image_url && (
            <div style={{ marginBottom: 20 }}>
              <div style={{ fontSize: 12, color: '#666', fontWeight: 600, marginBottom: 8 }}>Image Preview:</div>
              <div style={{ border: '1px dashed #ccc', borderRadius: 8, padding: 10, display: 'inline-block', background: '#fafafa' }}>
                <img 
                  src={getImageSrc(editingItem.image_url)} 
                  alt="Preview" 
                  style={{ maxHeight: 150, borderRadius: 6, objectFit: 'contain' }}
                  onError={(e) => {
                    (e.target as HTMLElement).style.display = 'none';
                  }}
                />
              </div>
            </div>
          )}

          <div style={{ display: 'flex', gap: 10 }}>
            <button onClick={handleUpdate} style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>Update</button>
            <button onClick={() => setEditingItem(null)} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      {/* IMAGES GRID */}
      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(240px, 1fr))', gap: 20 }}>
        {images.map((img) => (
          <div key={img.id} style={{
            background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 12px rgba(0,0,0,0.04)', position: 'relative',
            display: 'flex', flexDirection: 'column', border: '1px solid #f0f0f0'
          }}>
            <img src={getImageSrc(img.image_url)} alt={img.title || ''} style={{ width: '100%', height: 180, objectFit: 'cover' }} />
            <div style={{ padding: '12px 15px', flexGrow: 1 }}>
              <div style={{ fontSize: 14, fontWeight: 700, color: '#333', marginBottom: 4 }}>{img.title || 'Untitled'}</div>
              <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginTop: 8 }}>
                <span style={{ fontSize: 11, color: '#3347B0', background: '#eef1ff', padding: '2px 8px', borderRadius: 12, fontWeight: 600 }}>{img.category}</span>
                <span style={{ fontSize: 12, color: '#888' }}>Order: {img.sort_order}</span>
              </div>
            </div>
            
            <div style={{ display: 'flex', borderTop: '1px solid #f0f0f0' }}>
              <button onClick={() => handleStartEdit(img)} style={{
                flex: 1, padding: '10px', background: 'none', border: 'none', borderRight: '1px solid #f0f0f0', cursor: 'pointer',
                fontSize: 13, color: '#3347B0', fontWeight: 600, display: 'flex', alignItems: 'center', justifyContent: 'center', gap: 6
              }}>
                <i className="fa fa-pencil"></i>Edit
              </button>
              <button onClick={() => handleDelete(img.id)} style={{
                flex: 1, padding: '10px', background: 'none', border: 'none', cursor: 'pointer',
                fontSize: 13, color: '#e74c3c', fontWeight: 600, display: 'flex', alignItems: 'center', justifyContent: 'center', gap: 6
              }}>
                <i className="fa fa-trash"></i>Delete
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}
