'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import AdminPagination from '@/components/ui/AdminPagination'

interface NoticeDownloadItem {
  id: string
  title: string
  content: string | null
  type: 'Notice' | 'News' | 'Download'
  file_url: string | null
  is_active: boolean
  sort_order: number
  created_at: string
}

export default function AdminNotices() {
  const [items, setItems] = useState<NoticeDownloadItem[]>([])
  const [loading, setLoading] = useState(true)
  const [showForm, setShowForm] = useState(false)
  const [editingItem, setEditingItem] = useState<NoticeDownloadItem | null>(null)
  
  // Form States
  const [title, setTitle] = useState('')
  const [content, setContent] = useState('')
  const [type, setType] = useState<'Notice' | 'News' | 'Download'>('Notice')
  const [fileUrl, setFileUrl] = useState('')
  const [sortOrder, setSortOrder] = useState(0)
  const [isActive, setIsActive] = useState(true)
  const [uploadFile, setUploadFile] = useState<File | null>(null)
  const [uploading, setUploading] = useState(false)
  const [currentPage, setCurrentPage] = useState(1)
  const ITEMS_PER_PAGE = 20

  const supabase = createClient()

  const fetchItems = async () => {
    const { data } = await supabase
      .from('notices_downloads')
      .select('*')
      .order('type')
      .order('sort_order')
    
    setItems(data || [])
    setLoading(false)
  }

  useEffect(() => {
    fetchItems()
  }, [])

  const handleFileUpload = async (file: File): Promise<string> => {
    setUploading(true)
    const fileExt = file.name.split('.').pop()
    const fileName = `notices/${Math.random().toString(36).substring(2)}-${Date.now()}.${fileExt}`
    
    const { error: uploadError } = await supabase.storage
      .from('documents')
      .upload(fileName, file)

    if (uploadError) {
      setUploading(false)
      throw new Error(`File upload failed: ${uploadError.message}`)
    }

    const { data } = supabase.storage.from('documents').getPublicUrl(fileName)
    setUploading(false)
    return data.publicUrl
  }

  const handleSave = async (e: React.FormEvent) => {
    e.preventDefault()
    if (!title) return alert('Title is required')

    try {
      let finalFileUrl = editingItem ? editingItem.file_url : fileUrl

      if (uploadFile) {
        finalFileUrl = await handleFileUpload(uploadFile)
      }

      if (editingItem) {
        // Edit Mode
        const { error } = await supabase
          .from('notices_downloads')
          .update({
            title,
            content: content || null,
            type,
            file_url: finalFileUrl || null,
            sort_order: sortOrder,
            is_active: isActive,
            updated_at: new Date().toISOString()
          })
          .eq('id', editingItem.id)

        if (error) throw error
        setEditingItem(null)
      } else {
        // Add Mode
        const { error } = await supabase
          .from('notices_downloads')
          .insert({
            title,
            content: content || null,
            type,
            file_url: finalFileUrl || null,
            sort_order: sortOrder,
            is_active: isActive
          })

        if (error) throw error
        setShowForm(false)
      }

      // Reset
      setTitle('')
      setContent('')
      setType('Notice')
      setFileUrl('')
      setSortOrder(0)
      setIsActive(true)
      setUploadFile(null)
      const fileInput = document.getElementById('admin-file-upload') as HTMLInputElement
      if (fileInput) fileInput.value = ''

      fetchItems()
    } catch (err: any) {
      alert(err.message || 'Operation failed')
    }
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this notice/download item permanently?')) {
      const { error } = await supabase.from('notices_downloads').delete().eq('id', id)
      if (error) alert(error.message)
      else fetchItems()
    }
  }

  const startEdit = (item: NoticeDownloadItem) => {
    setEditingItem(item)
    setTitle(item.title)
    setContent(item.content || '')
    setType(item.type)
    setFileUrl(item.file_url || '')
    setSortOrder(item.sort_order)
    setIsActive(item.is_active)
    setShowForm(true)
  }

  const startAdd = () => {
    setEditingItem(null)
    setTitle('')
    setContent('')
    setType('Notice')
    setFileUrl('')
    setSortOrder(0)
    setIsActive(true)
    setShowForm(true)
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 25 }}>
        <p style={{ color: '#666', margin: 0, fontSize: 14 }}>Add notices/news announcements or administrative download files for the public Notice & Downloads page.</p>
        {!showForm && (
          <button onClick={startAdd}
            style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600, display: 'flex', alignItems: 'center', gap: 8 }}>
            <i className="fa fa-plus"></i>Add Item
          </button>
        )}
      </div>

      {showForm && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>
            {editingItem ? 'Edit Item' : 'Add Notice / Download Item'}
          </h4>
          
          <form onSubmit={handleSave} style={{ display: 'flex', flexDirection: 'column', gap: 15 }}>
            <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr 1fr', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title *</label>
                <input placeholder="e.g. Eid-ul-Fitr holiday closure" value={title} onChange={e => setTitle(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} required />
              </div>
              
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Type</label>
                <select value={type} onChange={e => setType(e.target.value as any)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}>
                  <option value="Notice">Notice</option>
                  <option value="News">News</option>
                  <option value="Download">Download</option>
                </select>
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
                <input type="number" value={sortOrder} onChange={e => setSortOrder(parseInt(e.target.value) || 0)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Content / Description</label>
              <textarea placeholder="Write notice details or description of download file..." value={content} onChange={e => setContent(e.target.value)}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, height: 100, resize: 'vertical' }} />
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Upload File (PDF / Images / Docs)</label>
                <input
                  type="file"
                  id="admin-file-upload"
                  accept=".pdf,.png,.jpg,.jpeg,.doc,.docx"
                  onChange={e => setUploadFile(e.target.files?.[0] || null)}
                  style={{ padding: 8, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 13, background: '#fafafa' }}
                />
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Or Direct File URL (External Link)</label>
                <input placeholder="https://..." value={fileUrl} onChange={e => setFileUrl(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
            </div>

            <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
              <input type="checkbox" id="isActiveCheck" checked={isActive} onChange={e => setIsActive(e.target.checked)} style={{ cursor: 'pointer' }} />
              <label htmlFor="isActiveCheck" style={{ fontSize: 13, fontWeight: 600, color: '#444', cursor: 'pointer' }}>Visible on public page</label>
            </div>

            <div style={{ display: 'flex', gap: 10 }}>
              <button type="submit" disabled={uploading}
                style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: uploading ? 'not-allowed' : 'pointer', fontWeight: 600 }}>
                {uploading ? 'Uploading File...' : 'Save Item'}
              </button>
              <button type="button" onClick={() => setShowForm(false)}
                style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
            </div>
          </form>
        </div>
      )}

      {/* ITEMS LISTING TABLE */}
      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
          <thead>
            <tr style={{ background: '#f8f9fa', borderBottom: '2px solid #e0e0e0' }}>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Type</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Title</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>File / Attachment</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Order</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Visible</th>
              <th style={{ padding: '12px 15px', textAlign: 'center', fontSize: 13, color: '#666', width: 180 }}>Actions</th>
            </tr>
          </thead>
          <tbody>
            {items.slice((currentPage - 1) * ITEMS_PER_PAGE, currentPage * ITEMS_PER_PAGE).map((item) => (
              <tr key={item.id} style={{ borderBottom: '1px solid #f0f0f0' }}>
                <td style={{ padding: '12px 15px' }}>
                  <span style={{
                    fontSize: 11,
                    fontWeight: 700,
                    background: item.type === 'Notice' ? '#fde8e7' : item.type === 'News' ? '#e3f9eb' : '#eef1ff',
                    color: item.type === 'Notice' ? '#e74c3c' : item.type === 'News' ? '#27ae60' : '#3347B0',
                    padding: '3px 8px',
                    borderRadius: 4
                  }}>{item.type}</span>
                </td>
                <td style={{ padding: '12px 15px', fontSize: 14, fontWeight: 600 }}>{item.title}</td>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  {item.file_url ? (
                    <a href={item.file_url} target="_blank" rel="noopener noreferrer" style={{ color: '#3347B0', textDecoration: 'none' }}>
                      <i className="fa fa-paperclip" style={{ marginRight: 5 }}></i>Open File
                    </a>
                  ) : <span style={{ color: '#999' }}>None</span>}
                </td>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>{item.sort_order}</td>
                <td style={{ padding: '12px 15px' }}>
                  <i className={`fa ${item.is_active ? 'fa-check-circle text-success' : 'fa-times-circle text-danger'}`}
                    style={{ fontSize: 16, color: item.is_active ? '#27ae60' : '#e74c3c' }}></i>
                </td>
                <td style={{ padding: '12px 15px', textAlign: 'center' }}>
                  <div style={{ display: 'flex', gap: 10, justifyContent: 'center' }}>
                    <button onClick={() => startEdit(item)}
                      style={{ padding: '6px 12px', background: '#eef1ff', border: 'none', borderRadius: 6, color: '#3347B0', fontSize: 12, cursor: 'pointer', fontWeight: 600 }}>
                      <i className="fa fa-pencil" style={{ marginRight: 4 }}></i>Edit
                    </button>
                    <button onClick={() => handleDelete(item.id)}
                      style={{ padding: '6px 12px', background: '#fde8e7', border: 'none', borderRadius: 6, color: '#e74c3c', fontSize: 12, cursor: 'pointer', fontWeight: 600 }}>
                      <i className="fa fa-trash" style={{ marginRight: 4 }}></i>Delete
                    </button>
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      <AdminPagination
        currentPage={currentPage}
        totalItems={items.length}
        itemsPerPage={ITEMS_PER_PAGE}
        onPageChange={setCurrentPage}
      />
    </div>
  )
}
