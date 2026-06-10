'use client'
import { useEffect, useMemo, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import RichTextEditor from '@/components/ui/RichTextEditor'
import type { StudyNote } from '@/lib/types'
import AdminPagination from '@/components/ui/AdminPagination'

const defaultSubjects = ['Computer Science', 'English', 'Mathematics', 'Nepali', 'Science', 'Business Studies', 'Accountancy', 'Social Studies']
const defaultClassLevels = ['Class 10 (SEE)', 'Class 11', 'Class 12', 'Bachelor', 'Master']

const buildOptions = (defaults: string[], values: Array<string | null | undefined>) => {
  const seen = new Set<string>()
  const options: string[] = []

  defaults.concat(values.map(value => value || '')).forEach((value) => {
    const trimmed = value.trim()
    if (trimmed && !seen.has(trimmed.toLowerCase())) {
      seen.add(trimmed.toLowerCase())
      options.push(trimmed)
    }
  })

  return options
}

const hasRichTextContent = (html: string | null | undefined) => {
  if (!html) return false

  const withImagesCounted = html.replace(/<img\b[^>]*>/gi, ' image ')
  const text = withImagesCounted
    .replace(/<[^>]*>/g, '')
    .replace(/&nbsp;/g, ' ')
    .trim()

  return text.length > 0
}

export default function AdminNotes() {
  const [items, setItems] = useState<StudyNote[]>([])
  const [loading, setLoading] = useState(true)
  const [showForm, setShowForm] = useState(false)
  const [editingItem, setEditingItem] = useState<StudyNote | null>(null)

  const [title, setTitle] = useState('')
  const [subject, setSubject] = useState('Computer Science')
  const [classLevel, setClassLevel] = useState('Class 10 (SEE)')
  const [description, setDescription] = useState('')
  const [content, setContent] = useState('')
  const [fileUrl, setFileUrl] = useState('')
  const [sortOrder, setSortOrder] = useState(0)
  const [isActive, setIsActive] = useState(true)
  const [uploadFile, setUploadFile] = useState<File | null>(null)
  const [uploading, setUploading] = useState(false)
  const [currentPage, setCurrentPage] = useState(1)
  const ITEMS_PER_PAGE = 20

  const supabase = createClient()

  const subjectOptions = useMemo(
    () => buildOptions(defaultSubjects, items.map(item => item.subject)),
    [items]
  )
  const classLevelOptions = useMemo(
    () => buildOptions(defaultClassLevels, items.map(item => item.class_level)),
    [items]
  )

  const resetForm = () => {
    setEditingItem(null)
    setTitle('')
    setSubject('Computer Science')
    setClassLevel('Class 10 (SEE)')
    setDescription('')
    setContent('')
    setFileUrl('')
    setSortOrder(0)
    setIsActive(true)
    setUploadFile(null)
    const fileInput = document.getElementById('admin-notes-file-upload') as HTMLInputElement | null
    if (fileInput) fileInput.value = ''
  }

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
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [])

  const handleFileUpload = async (file: File): Promise<string> => {
    const fileExt = file.name.split('.').pop() || 'file'
    const fileName = `notes/${Math.random().toString(36).substring(2)}-${Date.now()}.${fileExt.toLowerCase()}`

    const { error: uploadError } = await supabase.storage
      .from('documents')
      .upload(fileName, file)

    if (uploadError) {
      throw new Error(`File upload failed: ${uploadError.message}`)
    }

    const { data } = supabase.storage.from('documents').getPublicUrl(fileName)
    return data.publicUrl
  }

  const handleSave = async (e: React.FormEvent) => {
    e.preventDefault()

    const trimmedTitle = title.trim()
    const trimmedSubject = subject.trim()
    const trimmedClassLevel = classLevel.trim()
    const trimmedDescription = description.trim()

    if (!trimmedTitle) return alert('Title is required')

    try {
      let finalFileUrl = fileUrl.trim() || null

      if (uploadFile) {
        setUploading(true)
        finalFileUrl = await handleFileUpload(uploadFile)
      }

      const finalContent = hasRichTextContent(content) ? content : null

      if (!finalContent && !finalFileUrl) {
        return alert('Add rich text note content or attach a note file.')
      }

      const payload = {
        title: trimmedTitle,
        subject: trimmedSubject || null,
        class_level: trimmedClassLevel || null,
        description: trimmedDescription || null,
        content: finalContent,
        file_url: finalFileUrl,
        sort_order: sortOrder,
        is_active: isActive,
        updated_at: new Date().toISOString()
      }

      if (editingItem) {
        const { error } = await supabase
          .from('notes')
          .update(payload)
          .eq('id', editingItem.id)

        if (error) throw error
      } else {
        const { error } = await supabase
          .from('notes')
          .insert(payload)

        if (error) throw error
      }

      resetForm()
      setShowForm(false)
      fetchNotes()
    } catch (err: any) {
      alert(err.message || 'Operation failed')
    } finally {
      setUploading(false)
    }
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this academic note permanently?')) {
      const { error } = await supabase.from('notes').delete().eq('id', id)
      if (error) alert(error.message)
      else fetchNotes()
    }
  }

  const startEdit = (item: StudyNote) => {
    setEditingItem(item)
    setTitle(item.title)
    setSubject(item.subject || 'Computer Science')
    setClassLevel(item.class_level || 'Class 10 (SEE)')
    setDescription(item.description || '')
    setContent(item.content || '')
    setFileUrl(item.file_url || '')
    setSortOrder(item.sort_order)
    setIsActive(item.is_active)
    setUploadFile(null)
    setShowForm(true)
  }

  const startAdd = () => {
    resetForm()
    setShowForm(true)
  }

  const handleCancel = () => {
    resetForm()
    setShowForm(false)
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
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Subject / Category</label>
                <input
                  list="admin-notes-subject-options"
                  placeholder="Subject or category"
                  value={subject}
                  onChange={e => setSubject(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}
                />
                <datalist id="admin-notes-subject-options">
                  {subjectOptions.map(s => <option key={s} value={s} />)}
                </datalist>
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Academic Level</label>
                <input
                  list="admin-notes-level-options"
                  placeholder="Class, program, or level"
                  value={classLevel}
                  onChange={e => setClassLevel(e.target.value)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}
                />
                <datalist id="admin-notes-level-options">
                  {classLevelOptions.map(l => <option key={l} value={l} />)}
                </datalist>
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
                <input type="number" value={sortOrder} onChange={e => setSortOrder(parseInt(e.target.value) || 0)}
                  style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
              </div>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Short Description / Summary</label>
              <textarea placeholder="Write brief notes description, chapters covered..." value={description} onChange={e => setDescription(e.target.value)}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, height: 90, resize: 'vertical' }} />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Rich Text Note Content</label>
              <RichTextEditor
                content={content}
                onChange={setContent}
                minHeight={220}
                placeholder="Write the full note content students should read online..."
              />
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 15 }}>
              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Optional Note File Upload (PDF / Images / Docs)</label>
                <input
                  type="file"
                  id="admin-notes-file-upload"
                  accept=".pdf,.png,.jpg,.jpeg,.doc,.docx"
                  onChange={e => setUploadFile(e.target.files?.[0] || null)}
                  style={{ padding: 8, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 13, background: '#fafafa' }}
                />
              </div>

              <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Optional Direct Note File URL</label>
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
              <button type="button" onClick={handleCancel}
                style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
            </div>
          </form>
        </div>
      )}

      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
          <thead>
            <tr style={{ background: '#f8f9fa', borderBottom: '2px solid #e0e0e0' }}>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Level</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Subject</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Note Title</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Content / File</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Order</th>
              <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Active</th>
              <th style={{ padding: '12px 15px', textAlign: 'center', fontSize: 13, color: '#666', width: 180 }}>Actions</th>
            </tr>
          </thead>
          <tbody>
            {items.slice((currentPage - 1) * ITEMS_PER_PAGE, currentPage * ITEMS_PER_PAGE).map((item) => (
              <tr key={item.id} style={{ borderBottom: '1px solid #f0f0f0' }}>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  <span style={{ background: '#eef1ff', color: '#3347B0', padding: '3px 8px', borderRadius: 4, fontSize: 11, fontWeight: 600 }}>{item.class_level || 'General'}</span>
                </td>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  <span style={{ background: '#e1f5fe', color: '#0288d1', padding: '3px 8px', borderRadius: 4, fontSize: 11, fontWeight: 600 }}>{item.subject || 'Other'}</span>
                </td>
                <td style={{ padding: '12px 15px', fontSize: 14, fontWeight: 600 }}>{item.title}</td>
                <td style={{ padding: '12px 15px', fontSize: 13 }}>
                  <div style={{ display: 'flex', gap: 8, alignItems: 'center', flexWrap: 'wrap' }}>
                    {hasRichTextContent(item.content) && (
                      <span style={{ color: '#27ae60', background: '#eafaf1', padding: '3px 8px', borderRadius: 4, fontSize: 11, fontWeight: 600 }}>
                        <i className="fa fa-align-left" style={{ marginRight: 5 }}></i>Text
                      </span>
                    )}
                    {item.file_url ? (
                      <a href={item.file_url} target="_blank" rel="noopener noreferrer" style={{ color: '#3347B0', textDecoration: 'none' }}>
                        <i className="fa fa-file-o" style={{ marginRight: 5 }}></i>Open file
                      </a>
                    ) : (
                      <span style={{ color: '#999', fontSize: 12 }}>No file</span>
                    )}
                  </div>
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
