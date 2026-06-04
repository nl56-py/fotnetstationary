'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import { getVideoEmbedInfo } from '@/lib/media-helper'

interface VideoItem {
  id: string
  title: string
  video_url: string
  description: string | null
  sort_order: number
  is_active: boolean
  created_at: string
}

export default function AdminVideos() {
  const [videos, setVideos] = useState<VideoItem[]>([])
  const [loading, setLoading] = useState(true)
  const [showForm, setShowForm] = useState(false)
  const [editingId, setEditingId] = useState<string | null>(null)
  const [editingVideo, setEditingVideo] = useState<Partial<VideoItem> | null>(null)
  
  const [form, setForm] = useState({ title: '', video_url: '', description: '', is_active: true, sort_order: 0 })

  const supabase = createClient()

  const fetchVideos = async () => {
    const { data } = await supabase.from('videos').select('*').order('sort_order', { ascending: true })
    setVideos(data || [])
    setLoading(false)
  }

  useEffect(() => { fetchVideos() }, [])

  const handleAdd = async () => {
    if (!form.title || !form.video_url) return alert('Title and Video URL are required')
    const sort_order = form.sort_order || videos.length + 1
    
    const { error } = await supabase.from('videos').insert({ 
      title: form.title, 
      video_url: form.video_url, 
      description: form.description, 
      is_active: form.is_active,
      sort_order 
    })

    if (error) {
      alert('Error adding video: ' + error.message)
    } else {
      setForm({ title: '', video_url: '', description: '', is_active: true, sort_order: 0 })
      setShowForm(false)
      fetchVideos()
    }
  }

  const handleUpdate = async (id: string) => {
    if (!editingVideo) return
    if (!editingVideo.title || !editingVideo.video_url) return alert('Title and Video URL are required')

    const { error } = await supabase.from('videos')
      .update({
        title: editingVideo.title,
        video_url: editingVideo.video_url,
        description: editingVideo.description,
        is_active: editingVideo.is_active,
        sort_order: editingVideo.sort_order
      })
      .eq('id', id)

    if (error) {
      alert('Error updating video: ' + error.message)
    } else {
      setEditingId(null)
      setEditingVideo(null)
      fetchVideos()
    }
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this video?')) {
      const { error } = await supabase.from('videos').delete().eq('id', id)
      if (error) alert('Error: ' + error.message)
      else fetchVideos()
    }
  }

  const toggleActive = async (video: VideoItem) => {
    const { error } = await supabase.from('videos').update({ is_active: !video.is_active }).eq('id', video.id)
    if (error) {
      alert('Error: ' + error.message)
    } else {
      setVideos(videos.map(v => v.id === video.id ? { ...v, is_active: !video.is_active } : v))
    }
  }

  const startEditing = (video: VideoItem) => {
    setEditingId(video.id)
    setEditingVideo({ ...video })
    setShowForm(false)
  }

  const cancelEditing = () => {
    setEditingId(null)
    setEditingVideo(null)
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  // Generate live embed elements for preview
  const getPreviewElement = (url: string, title: string) => {
    if (!url) return null;
    const { embedUrl, isDirectVideo } = getVideoEmbedInfo(url);
    if (isDirectVideo) {
      return (
        <video 
          src={embedUrl} 
          controls 
          style={{ width: '100%', height: '100%', borderRadius: 6 }} 
        />
      );
    }
    return (
      <iframe 
        src={embedUrl} 
        title={title || 'Preview'} 
        style={{ width: '100%', height: '100%', border: 'none', borderRadius: 6 }}
        allowFullScreen
      />
    );
  };

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 25 }}>
        <p style={{ color: '#666', margin: 0, fontSize: 14 }}>Manage video links displayed in the public Video Gallery section.</p>
        {!showForm && !editingId && (
          <button onClick={() => setShowForm(true)}
            style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600, display: 'flex', alignItems: 'center', gap: 8 }}>
            <i className="fa fa-plus"></i>Add Video
          </button>
        )}
      </div>

      {/* ADD FORM */}
      {showForm && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Add Video</h4>
          
          <div style={{ display: 'grid', gridTemplateColumns: '1.5fr 2.5fr', gap: 20 }}>
            {/* Form Fields */}
            <div style={{ display: 'flex', flexDirection: 'column', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title</label>
                <input placeholder="e.g. Thesis Photocopy Guide" value={form.title} onChange={e => setForm({ ...form, title: e.target.value })}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
              
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Video URL (YouTube, Drive, Instagram, direct video...)</label>
                <input placeholder="https://..." value={form.video_url} onChange={e => setForm({ ...form, video_url: e.target.value })}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Description (Optional)</label>
                <textarea placeholder="Briefly describe the video content..." value={form.description} onChange={e => setForm({ ...form, description: e.target.value })} rows={3}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, resize: 'none', fontFamily: 'inherit' }} />
              </div>

              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
                <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                  <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
                  <input type="number" placeholder="0" value={form.sort_order || ''} onChange={e => setForm({ ...form, sort_order: parseInt(e.target.value) || 0 })}
                    style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
                </div>
                <div style={{ display: 'flex', flexDirection: 'column', gap: 6, justifyContent: 'center' }}>
                  <label style={{ display: 'flex', alignItems: 'center', gap: 8, fontSize: 13, color: '#666', fontWeight: 600, cursor: 'pointer', marginTop: 15 }}>
                    <input type="checkbox" checked={form.is_active} onChange={e => setForm({ ...form, is_active: e.target.checked })} />
                    Active (Show on site)
                  </label>
                </div>
              </div>
            </div>

            {/* Live Video Embed Preview */}
            <div style={{ display: 'flex', flexDirection: 'column', gap: 8, background: '#fafafa', border: '1px dashed #ccc', borderRadius: 12, padding: 15, justifyContent: 'center', alignItems: 'center', minHeight: 240 }}>
              {form.video_url ? (
                <>
                  <div style={{ fontSize: 12, color: '#666', fontWeight: 600, alignSelf: 'flex-start' }}>Video Live Preview:</div>
                  <div style={{ width: '100%', height: '100%', minHeight: 180, position: 'relative', background: '#000', borderRadius: 6, overflow: 'hidden' }}>
                    {getPreviewElement(form.video_url, form.title)}
                  </div>
                </>
              ) : (
                <div style={{ textAlign: 'center', color: '#aaa' }}>
                  <i className="fa fa-television" style={{ fontSize: 40, marginBottom: 10 }}></i>
                  <p style={{ margin: 0, fontSize: 13 }}>Enter a valid URL to load embed preview</p>
                </div>
              )}
            </div>
          </div>

          <div style={{ display: 'flex', gap: 10, marginTop: 20 }}>
            <button onClick={handleAdd} style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>Save Video</button>
            <button onClick={() => setShowForm(false)} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      {/* EDIT FORM */}
      {editingId && editingVideo && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)', borderLeft: '4px solid #3347B0' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Edit Video</h4>
          
          <div style={{ display: 'grid', gridTemplateColumns: '1.5fr 2.5fr', gap: 20 }}>
            {/* Form Fields */}
            <div style={{ display: 'flex', flexDirection: 'column', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title</label>
                <input placeholder="Title" value={editingVideo.title || ''} onChange={e => setEditingVideo({ ...editingVideo, title: e.target.value })}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
              
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Video URL</label>
                <input placeholder="Video URL" value={editingVideo.video_url || ''} onChange={e => setEditingVideo({ ...editingVideo, video_url: e.target.value })}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Description (Optional)</label>
                <textarea placeholder="Description" value={editingVideo.description || ''} onChange={e => setEditingVideo({ ...editingVideo, description: e.target.value })} rows={3}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, resize: 'none', fontFamily: 'inherit' }} />
              </div>

              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
                <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                  <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
                  <input type="number" placeholder="Sort Order" value={editingVideo.sort_order || 0} onChange={e => setEditingVideo({ ...editingVideo, sort_order: parseInt(e.target.value) || 0 })}
                    style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
                </div>
                <div style={{ display: 'flex', flexDirection: 'column', gap: 6, justifyContent: 'center' }}>
                  <label style={{ display: 'flex', alignItems: 'center', gap: 8, fontSize: 13, color: '#666', fontWeight: 600, cursor: 'pointer', marginTop: 15 }}>
                    <input type="checkbox" checked={editingVideo.is_active || false} onChange={e => setEditingVideo({ ...editingVideo, is_active: e.target.checked })} />
                    Active (Show on site)
                  </label>
                </div>
              </div>
            </div>

            {/* Live Video Embed Preview */}
            <div style={{ display: 'flex', flexDirection: 'column', gap: 8, background: '#fafafa', border: '1px dashed #ccc', borderRadius: 12, padding: 15, justifyContent: 'center', alignItems: 'center', minHeight: 240 }}>
              {editingVideo.video_url ? (
                <>
                  <div style={{ fontSize: 12, color: '#666', fontWeight: 600, alignSelf: 'flex-start' }}>Video Live Preview:</div>
                  <div style={{ width: '100%', height: '100%', minHeight: 180, position: 'relative', background: '#000', borderRadius: 6, overflow: 'hidden' }}>
                    {getPreviewElement(editingVideo.video_url, editingVideo.title || '')}
                  </div>
                </>
              ) : (
                <div style={{ textAlign: 'center', color: '#aaa' }}>
                  <i className="fa fa-television" style={{ fontSize: 40, marginBottom: 10 }}></i>
                  <p style={{ margin: 0, fontSize: 13 }}>Enter a valid URL to load embed preview</p>
                </div>
              )}
            </div>
          </div>

          <div style={{ display: 'flex', gap: 10, marginTop: 20 }}>
            <button onClick={() => handleUpdate(editingVideo.id!)} style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>Update Video</button>
            <button onClick={cancelEditing} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      {/* VIDEOS LIST TABLE */}
      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 12px rgba(0,0,0,0.04)', border: '1px solid #f0f0f0' }}>
        {videos.length === 0 ? (
          <p style={{ textAlign: 'center', padding: 40, color: '#888' }}>No videos added yet.</p>
        ) : (
          <table style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr style={{ background: '#fafafa', borderBottom: '2px solid #e0e0e0' }}>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 13, color: '#666', fontWeight: 600, width: 80 }}>Order</th>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 13, color: '#666', fontWeight: 600 }}>Title</th>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 13, color: '#666', fontWeight: 600 }}>URL</th>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 13, color: '#666', fontWeight: 600, width: 120 }}>Status</th>
                <th style={{ padding: '12px 20px', textAlign: 'right', fontSize: 13, color: '#666', fontWeight: 600, width: 120 }}>Actions</th>
              </tr>
            </thead>
            <tbody>
              {videos.map((video) => (
                <tr key={video.id} style={{ borderBottom: '1px solid #f0f0f0', background: editingId === video.id ? '#fcfdff' : 'transparent' }}>
                  <td style={{ padding: '12px 20px', fontSize: 14, color: '#555' }}>{video.sort_order}</td>
                  <td style={{ padding: '12px 20px', fontSize: 14, fontWeight: 600, color: '#333' }}>{video.title}</td>
                  <td style={{ padding: '12px 20px', fontSize: 13, color: '#666', maxWidth: 300, overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>
                    <a href={video.video_url} target="_blank" rel="noopener noreferrer" style={{ color: '#3347B0', textDecoration: 'none' }}>
                      {video.video_url}
                    </a>
                  </td>
                  <td style={{ padding: '12px 20px' }}>
                    <button onClick={() => toggleActive(video)} style={{
                      padding: '4px 12px', borderRadius: 20, border: 'none', fontSize: 11, cursor: 'pointer', fontWeight: 600,
                      background: video.is_active ? '#d4edda' : '#fff3cd',
                      color: video.is_active ? '#155724' : '#856404',
                    }}>{video.is_active ? 'Active' : 'Inactive'}</button>
                  </td>
                  <td style={{ padding: '12px 20px', textAlign: 'right' }}>
                    <button onClick={() => startEditing(video)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#3347B0', fontSize: 14, marginRight: 12 }} title="Edit">
                      <i className="fa fa-pencil"></i>
                    </button>
                    <button onClick={() => handleDelete(video.id)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#e74c3c', fontSize: 14 }} title="Delete">
                      <i className="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>
    </div>
  )
}
