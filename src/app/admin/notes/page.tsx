'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'

interface NoteItem {
  id: string
  title: string
  subject: string | null
  class_level: string | null
  file_url: string
  description: string | null
  is_active: boolean
  sort_order: number
  created_at: string
}

const subjects = ['Computer Science', 'English', 'Mathematics', 'Nepali', 'Science', 'Business Studies', 'Accountancy', 'Social Studies', 'Other']
const classLevels = ['Class 10 (SEE)', 'Class 11', 'Class 12', 'Bachelor', 'Master']

export default function AdminNotes() {
  const [items, setItems] = useState<NoteItem[]>([])
  const [loading, setLoading] = useState(true)
  const [showForm, setShowForm] = useState(false)
  const [editingItem, setEditingItem] = useState<NoteItem | null>(null)

  // Form States
  const [title, setTitle] = useState('')
  const [subject, setSubject] = useState('Computer Science')
  const [classLevel, setClassLevel] = useState('Class 10 (SEE)')
  const [description, setDescription] = useState('')
  const [fileUrl, setFileUrl] = useState('')
  const [sortOrder, setSortOrder] = useState(0)
  const [isActive, setIsActive] = useState(true)
  const [uploadFile, setUploadFile] = useState<File | null>(null)
  const [uploading, setUploading] = useState(false)

  const supabase = createClient()

  const fetchNotes = async () => {
    const { data } = await supabase
      .from('notes')
      .select('*')
      .order('class_level')
      .order('sort_order')

    setItems(data || [])
    setLoading(false)
  }

  useEffect(() => {
    fetchNotes()
  }, [])

  const handleFileUpload = async (file: File): Promise<string> => {
    setUploading(true)
    const fileExt = file.name.split('.').pop()
    const fileName = `notes/${Math.random().toString(36).substring(2)}-${Date.now()}.${fileExt}`

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

      if (!finalFileUrl) {
        return alert('Please upload a file or specify a File URL')
      }

      if (editingItem) {
        // Edit Mode
        const { error } = await supabase
          .from('notes')
          .update({
            title,
            subject,
            class_level: classLevel,
            description: description || null,
            file_url: finalFileUrl,
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
          .from('notes')
          .insert({
            title,
            subject,
            class_level: classLevel,
            description: description || null,
            file_url: finalFileUrl,
            sort_order: sortOrder,
            is_active: isActive
          })

        if (error) throw error
        setShowForm(false)
      }

      // Reset Form
      setTitle('')
      setSubject('Computer Science')
      setClassLevel('Class 10 (SEE)')
      setDescription('')
      setFileUrl('')
      setSortOrder(0)
      setIsActive(true)
      setUploadFile(null)
      const fileInput = document.getElementById('admin-notes-file-upload') as HTMLInputElement
      if (fileInput) fileInput.value = ''

      fetchNotes()
    } catch (err: any) {
      alert(err.message || 'Operation failed')
    }
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this academic note permanently?')) {
      const { error } = await supabase.from('notes').delete().eq('id', id)
      if (error) alert(error.message)
      else fetchNotes()
    }
  }

  const startEdit = (item: NoteItem) => {
    setEditingItem(item)
    setTitle(item.title)
    setSubject(item.subject || 'Computer Science')
    setClassLevel(item.class_level || 'Class 10 (SEE)')
    setDescription(item.description || '')
    setFileUrl(item.file_url)
    setSortOrder(item.sort_order)
    setIsActive(item.is_active)
    setShowForm(true)
  }

  const startAdd = () => {
    setEditingItem(null)
    setTitle('')
    setSubject('Computer Science')
    setClassLevel('Class 10 (SEE)')
    setDescription('')
    setFileUrl('')
    setSortOrder(0)
    setIsActive(true)
    setShowForm(true)
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 25 }}>
        <p style={{ color: '#666', margin: 0, fontSize: 14 }}>Create and manage student academic lecture notes, exam guides, and reference files.</p>
        {!showForm && (
          <button onClick={startAdd}
            style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600, display: 'flex', alignItems: 'center', gap: 8 }}>
            <i className="fa fa-plus"></i>Add Note
          </button>
        )}
      </div>

      {showForm && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>
            {editingItem ? 'Edit Academic Note' : 'Add Academic Note'}
          </h4>

          <form onSubmit={handleSave} style={{ display: 'flex', flexDirection: 'column', gap: 15 }}>
            <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr 1fr 1fr', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Note Title *</label>
                <input placeholder="e.g. SEE Computer Science Notes" value={title} onChange={e => setTitle(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} required />
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Subject</label>
                <select value={subject} onChange={e => setSubject(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}>
                  {subjects.map(s => <option key={s} value={s}>{s}</option>)}
                </select>
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Level / Class</label>
                <select value={classLevel} onChange={e => setClassLevel(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}>
                  {classLevels.map(l => <option key={l} value={l}>{l}</option>)}
                </select>
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
                <input type="number" value={sortOrder} onChange={e => setSortOrder(parseInt(e.target.value) || 0)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Description</label>
              <textarea placeholder="Write brief notes description, chapters covered..." value={description} onChange={e => setDescription(e.target.value)}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, height: 100, resize: 'vertical' }} />
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Upload Note File (PDF / Images / Docs)</label>
                <input
                  type="file"
                  id="admin-notes-file-upload"
                  accept=".pdf,.png,.jpg,.jpeg,.doc,.docx"
                  onChange={e => setUploadFile(e.target.files?.[0] || null)}
                  style={{ padding: 8, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 13, background: '#fafafa' }}
                />
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Or Direct Note File URL (External Link)</label>
                <input placeholder="https://..." value={fileUrl} onChange={e => setFileUrl(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
            </div>

            <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
              <input type="checkbox" id="isActiveCheck" checked={isActive} onChange={e => setIsActive(e.target.checked)} style={{ cursor: 'pointer' }} />
              <label htmlFor="isActiveCheck" style={{ fontSize: 13, fontWeight: 600, color: '#444', cursor: 'pointer' }}>Active and visible to students</label>
            </div>

            <div style={{ display: 'flex', gap: 10 }}>
              <button type="submit" disabled={uploading}
                style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: uploading ? 'not-allowed' : 'pointer', fontWeight: 600 }}>
                {uploading ? 'Uploading Note...' : 'Save Note'}
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
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Level</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Subject</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Note Title</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>File / Link</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Order</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Active</th>
              <th style={{ padding: '12px 15px', textAlign: 'center', fontSize: 13, color: '#666', width: 180 }}>Actions</th>
            </tr>
          </thead>
          <tbody>
            {items.map((item) => (
              <tr key={item.id} style={{ borderBottom: '1px solid #f0f0f0' }}>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  <span style={{ background: '#eef1ff', color: '#3347B0', padding: '3px 8px', borderRadius: 4, fontSize: 11, fontWeight: 600 }}>{item.class_level || 'General'}</span>
                </td>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  <span style={{ background: '#e1f5fe', color: '#0288d1', padding: '3px 8px', borderRadius: 4, fontSize: 11, fontWeight: 600 }}>{item.subject || 'Other'}</span>
                </td>
                <td style={{ padding: '12px 15px', fontSize: 14, fontWeight: 600 }}>{item.title}</td>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  <a href={item.file_url} target="_blank" rel="noopener noreferrer" style={{ color: '#3347B0', textDecoration: 'none' }}>
                    <i className="fa fa-file-pdf-o" style={{ marginRight: 5 }}></i>Open PDF
                  </a>
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
    </div>
  )
}
