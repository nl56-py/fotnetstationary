'use client'
import { useEffect, useState, useCallback } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { PopupBanner } from '@/lib/types'

export default function PopupBannersManager() {
  const [banners, setBanners] = useState<PopupBanner[]>([])
  const [loading, setLoading] = useState(true)
  const [saving, setSaving] = useState(false)
  const [uploading, setUploading] = useState<string | null>(null)
  const [editingBanner, setEditingBanner] = useState<PopupBanner | null>(null)
  const [showAddForm, setShowAddForm] = useState(false)
  const [newBanner, setNewBanner] = useState({ title: '', content: '', image_url: '' })
  const [deleteConfirm, setDeleteConfirm] = useState<string | null>(null)

  const supabase = createClient()

  const fetchBanners = useCallback(async () => {
    const { data, error } = await supabase
      .from('popup_banners')
      .select('*')
      .order('sort_order', { ascending: true })
      .order('created_at', { ascending: true })

    if (error) {
      console.error('Error fetching banners:', error)
    } else {
      setBanners(data || [])
    }
    setLoading(false)
  }, [])

  useEffect(() => {
    fetchBanners()
  }, [fetchBanners])

  // --- Add Banner ---
  const handleAddBanner = async () => {
    if (!newBanner.title.trim()) {
      alert('Please enter a banner title.')
      return
    }
    setSaving(true)
    const maxOrder = banners.length > 0 ? Math.max(...banners.map(b => b.sort_order)) : -1

    const { error } = await supabase.from('popup_banners').insert({
      title: newBanner.title.trim(),
      content: newBanner.content.trim() || null,
      image_url: newBanner.image_url.trim() || null,
      sort_order: maxOrder + 1,
      is_active: true
    })

    if (error) {
      alert('Error adding banner: ' + error.message)
    } else {
      setNewBanner({ title: '', content: '', image_url: '' })
      setShowAddForm(false)
      await fetchBanners()
    }
    setSaving(false)
  }

  // --- Update Banner ---
  const handleUpdateBanner = async () => {
    if (!editingBanner) return
    setSaving(true)

    const { error } = await supabase
      .from('popup_banners')
      .update({
        title: editingBanner.title.trim(),
        content: editingBanner.content?.trim() || null,
        image_url: editingBanner.image_url?.trim() || null,
        is_active: editingBanner.is_active,
        updated_at: new Date().toISOString()
      })
      .eq('id', editingBanner.id)

    if (error) {
      alert('Error updating banner: ' + error.message)
    } else {
      setEditingBanner(null)
      await fetchBanners()
    }
    setSaving(false)
  }

  // --- Delete Banner ---
  const handleDeleteBanner = async (id: string) => {
    const { error } = await supabase.from('popup_banners').delete().eq('id', id)
    if (error) {
      alert('Error deleting banner: ' + error.message)
    } else {
      setDeleteConfirm(null)
      await fetchBanners()
    }
  }

  // --- Toggle Active ---
  const handleToggleActive = async (banner: PopupBanner) => {
    const { error } = await supabase
      .from('popup_banners')
      .update({ is_active: !banner.is_active, updated_at: new Date().toISOString() })
      .eq('id', banner.id)

    if (error) {
      alert('Error toggling banner: ' + error.message)
    } else {
      await fetchBanners()
    }
  }

  // --- Reorder ---
  const handleReorder = async (index: number, direction: 'up' | 'down') => {
    if (direction === 'up' && index === 0) return
    if (direction === 'down' && index === banners.length - 1) return

    const swapIndex = direction === 'up' ? index - 1 : index + 1
    const currentBanner = banners[index]
    const swapBanner = banners[swapIndex]

    // Swap sort_order values
    const updates = [
      supabase.from('popup_banners').update({ sort_order: swapBanner.sort_order, updated_at: new Date().toISOString() }).eq('id', currentBanner.id),
      supabase.from('popup_banners').update({ sort_order: currentBanner.sort_order, updated_at: new Date().toISOString() }).eq('id', swapBanner.id)
    ]

    await Promise.all(updates)
    await fetchBanners()
  }

  // --- File Upload ---
  const handleFileUpload = async (file: File, target: 'new' | 'edit') => {
    const uploadId = target
    setUploading(uploadId)
    try {
      const fileExt = file.name.split('.').pop()
      const fileName = `site/popup_banner-${Date.now()}.${fileExt}`

      const { error } = await supabase.storage
        .from('documents')
        .upload(fileName, file, { upsert: true })

      if (error) throw error

      const { data } = supabase.storage.from('documents').getPublicUrl(fileName)

      if (target === 'new') {
        setNewBanner(prev => ({ ...prev, image_url: data.publicUrl }))
      } else if (target === 'edit' && editingBanner) {
        setEditingBanner(prev => prev ? { ...prev, image_url: data.publicUrl } : null)
      }
    } catch (err: any) {
      alert('File upload failed: ' + (err.message || 'Unknown error'))
    } finally {
      setUploading(null)
    }
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  const activeBanners = banners.filter(b => b.is_active)

  return (
    <div>
      {/* Header */}
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20, flexWrap: 'wrap', gap: 12 }}>
        <div>
          <p style={{ color: '#666', margin: 0, fontSize: 14, lineHeight: 1.6 }}>
            Manage announcement popup banners. Banners appear one after another — when a visitor closes one, the next appears automatically.
          </p>
          <p style={{ color: '#3347B0', margin: '6px 0 0 0', fontSize: 13, fontWeight: 600 }}>
            <i className="fa fa-info-circle" style={{ marginRight: 6 }}></i>
            {activeBanners.length} active banner{activeBanners.length !== 1 ? 's' : ''} · {banners.length} total
          </p>
        </div>
        <button
          onClick={() => { setShowAddForm(true); setEditingBanner(null) }}
          style={{
            padding: '10px 22px', background: '#27ae60', color: '#fff', border: 'none',
            borderRadius: 8, cursor: 'pointer', fontWeight: 600, fontSize: 14,
            display: 'flex', alignItems: 'center', gap: 8,
            boxShadow: '0 3px 10px rgba(39,174,96,0.2)', transition: 'all 0.2s'
          }}
        >
          <i className="fa fa-plus"></i> Add New Banner
        </button>
      </div>

      {/* Add Banner Form */}
      {showAddForm && (
        <div style={{
          background: '#fff', borderRadius: 12, padding: 25, marginBottom: 20,
          boxShadow: '0 2px 10px rgba(0,0,0,0.06)', border: '2px solid #27ae60'
        }}>
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
            <h3 style={{ fontSize: 16, color: '#222', fontFamily: "'Oswald', sans-serif", margin: 0 }}>
              <i className="fa fa-plus-circle" style={{ marginRight: 8, color: '#27ae60' }}></i>
              Add New Banner
            </h3>
            <button onClick={() => setShowAddForm(false)} style={{ background: 'none', border: 'none', fontSize: 20, color: '#888', cursor: 'pointer' }}>&times;</button>
          </div>

          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            <div>
              <label style={labelStyle}>Banner Title *</label>
              <input
                value={newBanner.title}
                onChange={e => setNewBanner(p => ({ ...p, title: e.target.value }))}
                placeholder="e.g., Holiday Announcement, New Service Launch..."
                style={inputStyle}
              />
            </div>
            <div>
              <label style={labelStyle}>Banner Content</label>
              <textarea
                value={newBanner.content}
                onChange={e => setNewBanner(p => ({ ...p, content: e.target.value }))}
                placeholder="Type the banner announcement text here..."
                style={{ ...inputStyle, height: 100, resize: 'vertical' }}
              />
            </div>
            <div>
              <label style={labelStyle}>Attachment (Image or PDF)</label>
              <input
                value={newBanner.image_url}
                onChange={e => setNewBanner(p => ({ ...p, image_url: e.target.value }))}
                placeholder="File URL (or upload below)"
                style={inputStyle}
              />
              <div style={{ display: 'flex', alignItems: 'center', gap: 12, marginTop: 8 }}>
                <input
                  type="file"
                  accept="image/png,image/jpeg,image/webp,image/gif,application/pdf"
                  onChange={e => {
                    const file = e.target.files?.[0]
                    if (file) handleFileUpload(file, 'new')
                  }}
                  style={{ flex: 1, padding: 8, border: '1px dashed #d0d0d0', borderRadius: 8, background: '#fafafa', fontSize: 13, boxSizing: 'border-box' }}
                />
                {uploading === 'new' && <span style={{ color: '#3347B0', fontSize: 12 }}>Uploading...</span>}
              </div>
              {newBanner.image_url && (
                <div style={{ marginTop: 10 }}>
                  <MediaPreview url={newBanner.image_url} />
                </div>
              )}
            </div>
            <div style={{ display: 'flex', gap: 10, justifyContent: 'flex-end' }}>
              <button onClick={() => setShowAddForm(false)} style={{ ...btnStyle, background: '#f0f0f0', color: '#555' }}>Cancel</button>
              <button onClick={handleAddBanner} disabled={saving} style={{ ...btnStyle, background: '#27ae60', color: '#fff' }}>
                <i className="fa fa-check" style={{ marginRight: 6 }}></i>
                {saving ? 'Adding...' : 'Add Banner'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Edit Banner Form */}
      {editingBanner && (
        <div style={{
          background: '#fff', borderRadius: 12, padding: 25, marginBottom: 20,
          boxShadow: '0 2px 10px rgba(0,0,0,0.06)', border: '2px solid #3347B0'
        }}>
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
            <h3 style={{ fontSize: 16, color: '#222', fontFamily: "'Oswald', sans-serif", margin: 0 }}>
              <i className="fa fa-pencil" style={{ marginRight: 8, color: '#3347B0' }}></i>
              Edit Banner
            </h3>
            <button onClick={() => setEditingBanner(null)} style={{ background: 'none', border: 'none', fontSize: 20, color: '#888', cursor: 'pointer' }}>&times;</button>
          </div>

          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            <div>
              <label style={labelStyle}>Banner Title *</label>
              <input
                value={editingBanner.title}
                onChange={e => setEditingBanner(prev => prev ? { ...prev, title: e.target.value } : null)}
                style={inputStyle}
              />
            </div>
            <div>
              <label style={labelStyle}>Banner Content</label>
              <textarea
                value={editingBanner.content || ''}
                onChange={e => setEditingBanner(prev => prev ? { ...prev, content: e.target.value } : null)}
                style={{ ...inputStyle, height: 100, resize: 'vertical' }}
              />
            </div>
            <div>
              <label style={labelStyle}>Attachment (Image or PDF)</label>
              <input
                value={editingBanner.image_url || ''}
                onChange={e => setEditingBanner(prev => prev ? { ...prev, image_url: e.target.value } : null)}
                placeholder="File URL (or upload below)"
                style={inputStyle}
              />
              <div style={{ display: 'flex', alignItems: 'center', gap: 12, marginTop: 8 }}>
                <input
                  type="file"
                  accept="image/png,image/jpeg,image/webp,image/gif,application/pdf"
                  onChange={e => {
                    const file = e.target.files?.[0]
                    if (file) handleFileUpload(file, 'edit')
                  }}
                  style={{ flex: 1, padding: 8, border: '1px dashed #d0d0d0', borderRadius: 8, background: '#fafafa', fontSize: 13, boxSizing: 'border-box' }}
                />
                {uploading === 'edit' && <span style={{ color: '#3347B0', fontSize: 12 }}>Uploading...</span>}
              </div>
              {editingBanner.image_url && (
                <div style={{ marginTop: 10 }}>
                  <MediaPreview url={editingBanner.image_url} />
                </div>
              )}
            </div>
            <div style={{ display: 'flex', gap: 10, justifyContent: 'flex-end' }}>
              <button onClick={() => setEditingBanner(null)} style={{ ...btnStyle, background: '#f0f0f0', color: '#555' }}>Cancel</button>
              <button onClick={handleUpdateBanner} disabled={saving} style={{ ...btnStyle, background: '#3347B0', color: '#fff' }}>
                <i className="fa fa-save" style={{ marginRight: 6 }}></i>
                {saving ? 'Saving...' : 'Save Changes'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Banners List */}
      <div style={{ background: '#fff', borderRadius: 12, padding: 25, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        <h3 style={{ fontSize: 16, color: '#222', fontFamily: "'Oswald', sans-serif", marginBottom: 20, paddingBottom: 10, borderBottom: '1px solid #f0f0f0' }}>
          <i className="fa fa-list" style={{ marginRight: 8, color: '#3347B0' }}></i>
          Banner Display Order
          <span style={{ fontSize: 12, fontWeight: 400, color: '#888', fontFamily: "'Roboto', sans-serif", marginLeft: 10 }}>
            (top = appears first)
          </span>
        </h3>

        {banners.length === 0 ? (
          <div style={{ textAlign: 'center', padding: '40px 20px', color: '#888' }}>
            <i className="fa fa-bell-slash-o" style={{ fontSize: 36, marginBottom: 12, display: 'block', opacity: 0.4 }}></i>
            <p style={{ margin: 0, fontSize: 14 }}>No popup banners created yet.</p>
            <p style={{ margin: '8px 0 0 0', fontSize: 13, color: '#aaa' }}>Click &quot;Add New Banner&quot; to create your first announcement popup.</p>
          </div>
        ) : (
          <div style={{ display: 'flex', flexDirection: 'column', gap: 8 }}>
            {banners.map((banner, index) => (
              <div
                key={banner.id}
                style={{
                  display: 'flex', alignItems: 'center', gap: 12,
                  padding: '14px 16px', background: '#fafafa', borderRadius: 10,
                  border: `1px solid ${banner.is_active ? '#e0e0e0' : '#f5d5d5'}`,
                  opacity: banner.is_active ? 1 : 0.65,
                  transition: 'all 0.2s'
                }}
              >
                {/* Order Number */}
                <div style={{
                  width: 32, height: 32, borderRadius: '50%',
                  background: banner.is_active ? '#3347B0' : '#ccc',
                  color: '#fff', display: 'flex', alignItems: 'center', justifyContent: 'center',
                  fontWeight: 700, fontSize: 14, flexShrink: 0
                }}>
                  {index + 1}
                </div>

                {/* Banner Info */}
                <div style={{ flex: 1, minWidth: 0 }}>
                  <div style={{ display: 'flex', alignItems: 'center', gap: 8, marginBottom: 3 }}>
                    <span style={{ fontSize: 14, fontWeight: 600, color: '#222', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>
                      {banner.title}
                    </span>
                    <span style={{
                      fontSize: 10, fontWeight: 700, padding: '2px 8px', borderRadius: 4,
                      background: banner.is_active ? '#e8f5e9' : '#fde8e8',
                      color: banner.is_active ? '#2e7d32' : '#c62828',
                      textTransform: 'uppercase', letterSpacing: 0.5, flexShrink: 0
                    }}>
                      {banner.is_active ? 'Active' : 'Inactive'}
                    </span>
                  </div>
                  <p style={{ margin: 0, fontSize: 12, color: '#888', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>
                    {banner.content || '(No text content)'}
                    {banner.image_url && <> · <i className="fa fa-paperclip" style={{ fontSize: 11 }}></i> Attachment</>}
                  </p>
                </div>

                {/* Reorder Buttons */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: 2, flexShrink: 0 }}>
                  <button
                    onClick={() => handleReorder(index, 'up')}
                    disabled={index === 0}
                    style={{
                      ...reorderBtnStyle,
                      opacity: index === 0 ? 0.3 : 1,
                      cursor: index === 0 ? 'not-allowed' : 'pointer'
                    }}
                    title="Move up"
                  >
                    <i className="fa fa-chevron-up" style={{ fontSize: 10 }}></i>
                  </button>
                  <button
                    onClick={() => handleReorder(index, 'down')}
                    disabled={index === banners.length - 1}
                    style={{
                      ...reorderBtnStyle,
                      opacity: index === banners.length - 1 ? 0.3 : 1,
                      cursor: index === banners.length - 1 ? 'not-allowed' : 'pointer'
                    }}
                    title="Move down"
                  >
                    <i className="fa fa-chevron-down" style={{ fontSize: 10 }}></i>
                  </button>
                </div>

                {/* Action Buttons */}
                <div style={{ display: 'flex', gap: 6, flexShrink: 0 }}>
                  <button
                    onClick={() => handleToggleActive(banner)}
                    style={{
                      ...actionBtnStyle,
                      background: banner.is_active ? 'rgba(231,76,60,0.1)' : 'rgba(39,174,96,0.1)',
                      color: banner.is_active ? '#e74c3c' : '#27ae60'
                    }}
                    title={banner.is_active ? 'Deactivate' : 'Activate'}
                  >
                    <i className={`fa ${banner.is_active ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                  </button>
                  <button
                    onClick={() => { setEditingBanner({ ...banner }); setShowAddForm(false) }}
                    style={{ ...actionBtnStyle, background: 'rgba(51,71,176,0.1)', color: '#3347B0' }}
                    title="Edit"
                  >
                    <i className="fa fa-pencil"></i>
                  </button>
                  {deleteConfirm === banner.id ? (
                    <div style={{ display: 'flex', gap: 4, alignItems: 'center' }}>
                      <button
                        onClick={() => handleDeleteBanner(banner.id)}
                        style={{ ...actionBtnStyle, background: '#e74c3c', color: '#fff', fontSize: 11, padding: '6px 10px', borderRadius: 6 }}
                      >
                        Confirm
                      </button>
                      <button
                        onClick={() => setDeleteConfirm(null)}
                        style={{ ...actionBtnStyle, background: '#f0f0f0', color: '#555', fontSize: 11, padding: '6px 10px', borderRadius: 6 }}
                      >
                        Cancel
                      </button>
                    </div>
                  ) : (
                    <button
                      onClick={() => setDeleteConfirm(banner.id)}
                      style={{ ...actionBtnStyle, background: 'rgba(231,76,60,0.1)', color: '#e74c3c' }}
                      title="Delete"
                    >
                      <i className="fa fa-trash"></i>
                    </button>
                  )}
                </div>
              </div>
            ))}
          </div>
        )}
      </div>

      {/* Preview Section */}
      {activeBanners.length > 0 && (
        <div style={{
          marginTop: 20, background: '#fff', borderRadius: 12, padding: 25,
          boxShadow: '0 2px 10px rgba(0,0,0,0.06)'
        }}>
          <h3 style={{ fontSize: 16, color: '#222', fontFamily: "'Oswald', sans-serif", marginBottom: 15, paddingBottom: 10, borderBottom: '1px solid #f0f0f0' }}>
            <i className="fa fa-eye" style={{ marginRight: 8, color: '#3347B0' }}></i>
            Display Order Preview
          </h3>
          <div style={{ display: 'flex', flexWrap: 'wrap', gap: 10 }}>
            {activeBanners.map((banner, i) => (
              <div key={banner.id} style={{
                display: 'flex', alignItems: 'center', gap: 8,
                padding: '8px 14px', background: '#f0f2ff', borderRadius: 20,
                fontSize: 13, color: '#3347B0', fontWeight: 500
              }}>
                <span style={{
                  width: 22, height: 22, borderRadius: '50%', background: '#3347B0',
                  color: '#fff', display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                  fontSize: 11, fontWeight: 700
                }}>
                  {i + 1}
                </span>
                {banner.title}
                {i < activeBanners.length - 1 && (
                  <i className="fa fa-long-arrow-right" style={{ color: '#aab6ec', marginLeft: 4 }}></i>
                )}
              </div>
            ))}
          </div>
          <p style={{ margin: '12px 0 0 0', fontSize: 12, color: '#888' }}>
            Visitors will see these banners in this order. When they close one, the next appears.
          </p>
        </div>
      )}
    </div>
  )
}

// --- Media Preview Helper ---
function MediaPreview({ url }: { url: string }) {
  const isPdf = url.toLowerCase().split('?')[0].endsWith('.pdf')
  if (isPdf) {
    return (
      <a href={url} target="_blank" rel="noopener noreferrer" style={{
        display: 'inline-flex', alignItems: 'center', gap: 6, color: '#c61a1a',
        fontSize: 12, fontWeight: 600, textDecoration: 'none'
      }}>
        <i className="fa fa-file-pdf-o" style={{ fontSize: 18 }}></i> View PDF
      </a>
    )
  }
  return (
    <img src={url} alt="Preview" style={{
      maxWidth: 160, maxHeight: 80, objectFit: 'contain',
      borderRadius: 6, border: '1px solid #eee'
    }} />
  )
}

// --- Shared Styles ---
const labelStyle: React.CSSProperties = { fontSize: 13, color: '#444', fontWeight: 600, display: 'block', marginBottom: 4 }
const inputStyle: React.CSSProperties = {
  width: '100%', padding: 12, border: '1px solid #e0e0e0',
  borderRadius: 8, fontSize: 14, boxSizing: 'border-box', fontFamily: 'inherit'
}
const btnStyle: React.CSSProperties = {
  padding: '10px 20px', border: 'none', borderRadius: 8,
  cursor: 'pointer', fontWeight: 600, fontSize: 13, transition: 'all 0.2s'
}
const reorderBtnStyle: React.CSSProperties = {
  width: 26, height: 20, border: '1px solid #e0e0e0', background: '#fff',
  borderRadius: 4, display: 'flex', alignItems: 'center', justifyContent: 'center',
  color: '#555', transition: 'all 0.2s'
}
const actionBtnStyle: React.CSSProperties = {
  width: 32, height: 32, border: 'none', borderRadius: 8,
  display: 'flex', alignItems: 'center', justifyContent: 'center',
  cursor: 'pointer', fontSize: 13, transition: 'all 0.2s'
}
