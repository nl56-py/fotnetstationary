'use client'
import { useEffect, useMemo, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { GalleryImage } from '@/lib/types'
import { getImageSrc } from '@/lib/media-helper'
import AdminPagination from '@/components/ui/AdminPagination'

interface GalleryForm {
  title: string
  image_url: string
  category: string
  sort_order: number
}

const defaultCategories = ['General', 'Printing', 'Photocopy', 'Products', 'Stationary', 'Events']
const emptyForm: GalleryForm = { title: '', image_url: '', category: 'General', sort_order: 0 }

const buildOptions = (defaults: string[], values: Array<string | null | undefined>) => {
  const seen = new Set<string>()
  const options: string[] = []

  defaults.concat(values.map(value => value || '')).forEach((value) => {
    const trimmed = value.trim()
    const key = trimmed.toLowerCase()
    if (trimmed && !seen.has(key)) {
      seen.add(key)
      options.push(trimmed)
    }
  })

  return options
}

export default function AdminGallery() {
  const [images, setImages] = useState<GalleryImage[]>([])
  const [loading, setLoading] = useState(true)
  const [showForm, setShowForm] = useState(false)
  const [editingItem, setEditingItem] = useState<GalleryImage | null>(null)
  const [form, setForm] = useState<GalleryForm>(emptyForm)
  const [uploadFile, setUploadFile] = useState<File | null>(null)
  const [editUploadFile, setEditUploadFile] = useState<File | null>(null)
  const [uploadPreview, setUploadPreview] = useState('')
  const [editUploadPreview, setEditUploadPreview] = useState('')
  const [uploading, setUploading] = useState(false)
  const [currentPage, setCurrentPage] = useState(1)
  const ITEMS_PER_PAGE = 20

  const supabase = createClient()

  const categoryOptions = useMemo(
    () => buildOptions(defaultCategories, images.map(image => image.category)),
    [images]
  )

  const fetchImages = async () => {
    const { data, error } = await supabase.from('gallery_images').select('*').order('sort_order')
    if (error) {
      alert(error.message)
    } else {
      setImages(data || [])
    }
    setLoading(false)
  }

  useEffect(() => {
    fetchImages()
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [])

  useEffect(() => {
    if (!uploadFile) {
      setUploadPreview('')
      return
    }

    const previewUrl = URL.createObjectURL(uploadFile)
    setUploadPreview(previewUrl)

    return () => URL.revokeObjectURL(previewUrl)
  }, [uploadFile])

  useEffect(() => {
    if (!editUploadFile) {
      setEditUploadPreview('')
      return
    }

    const previewUrl = URL.createObjectURL(editUploadFile)
    setEditUploadPreview(previewUrl)

    return () => URL.revokeObjectURL(previewUrl)
  }, [editUploadFile])

  const resetAddForm = () => {
    setForm(emptyForm)
    setUploadFile(null)
    const fileInput = document.getElementById('admin-gallery-image-upload') as HTMLInputElement | null
    if (fileInput) fileInput.value = ''
  }

  const resetEditUpload = () => {
    setEditUploadFile(null)
    const fileInput = document.getElementById('admin-gallery-edit-image-upload') as HTMLInputElement | null
    if (fileInput) fileInput.value = ''
  }

  const handleImageUpload = async (file: File): Promise<string> => {
    if (!file.type.startsWith('image/')) {
      throw new Error('Please choose an image file.')
    }

    const fileExt = file.name.split('.').pop() || file.type.split('/')[1] || 'jpg'
    const fileName = `gallery/${Math.random().toString(36).substring(2)}-${Date.now()}.${fileExt.toLowerCase()}`

    const { error: uploadError } = await supabase.storage
      .from('documents')
      .upload(fileName, file)

    if (uploadError) {
      throw new Error(`Image upload failed: ${uploadError.message}`)
    }

    const { data } = supabase.storage.from('documents').getPublicUrl(fileName)
    return data.publicUrl
  }

  const handleAdd = async () => {
    if (!form.image_url.trim() && !uploadFile) return alert('Image URL or direct image upload is required')

    try {
      setUploading(true)
      let imageUrl = form.image_url.trim()

      if (uploadFile) {
        imageUrl = await handleImageUpload(uploadFile)
      }

      const sort_order = form.sort_order || images.length + 1
      const { error } = await supabase.from('gallery_images').insert({
        title: form.title.trim() || null,
        image_url: imageUrl,
        category: form.category.trim() || 'General',
        sort_order
      })

      if (error) throw error

      resetAddForm()
      setShowForm(false)
      fetchImages()
    } catch (err: any) {
      alert(err.message || 'Image save failed')
    } finally {
      setUploading(false)
    }
  }

  const handleUpdate = async () => {
    if (!editingItem) return
    if (!editingItem.image_url.trim() && !editUploadFile) return alert('Image URL or direct image upload is required')

    try {
      setUploading(true)
      let imageUrl = editingItem.image_url.trim()

      if (editUploadFile) {
        imageUrl = await handleImageUpload(editUploadFile)
      }

      const { error } = await supabase.from('gallery_images')
        .update({
          title: editingItem.title?.trim() || null,
          image_url: imageUrl,
          category: editingItem.category?.trim() || 'General',
          sort_order: editingItem.sort_order
        })
        .eq('id', editingItem.id)

      if (error) throw error

      setEditingItem(null)
      resetEditUpload()
      fetchImages()
    } catch (err: any) {
      alert(err.message || 'Image update failed')
    } finally {
      setUploading(false)
    }
  }

  const handleDelete = async (id: string) => {
    if (confirm('Delete this image?')) {
      const { error } = await supabase.from('gallery_images').delete().eq('id', id)
      if (error) alert(error.message)
      else fetchImages()
    }
  }

  const handleStartEdit = (img: GalleryImage) => {
    setEditingItem({ ...img, category: img.category || 'General' })
    setShowForm(false)
    resetAddForm()
    resetEditUpload()
  }

  const addPreviewSrc = uploadPreview || form.image_url
  const editPreviewSrc = editUploadPreview || editingItem?.image_url

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

      {showForm && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Add Gallery Image</h4>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 1fr 1fr', gap: 15, marginBottom: 15 }}>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title</label>
              <input placeholder="e.g. Printing Service" value={form.title} onChange={e => setForm({ ...form, title: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Upload Image</label>
              <input
                type="file"
                id="admin-gallery-image-upload"
                accept="image/*"
                onChange={e => setUploadFile(e.target.files?.[0] || null)}
                style={{ padding: 8, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 13, background: '#fafafa' }}
              />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Category</label>
              <input
                list="admin-gallery-category-options"
                placeholder="Category"
                value={form.category}
                onChange={e => setForm({ ...form, category: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}
              />
              <datalist id="admin-gallery-category-options">
                {categoryOptions.map(c => <option key={c} value={c} />)}
              </datalist>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
              <input type="number" placeholder="0" value={form.sort_order || ''} onChange={e => setForm({ ...form, sort_order: parseInt(e.target.value) || 0 })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>
          </div>

          <div style={{ display: 'flex', flexDirection: 'column', gap: 6, marginBottom: 15 }}>
            <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Or Image URL (Can paste Google Drive link)</label>
            <input placeholder="https://..." value={form.image_url} onChange={e => setForm({ ...form, image_url: e.target.value })}
              style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
          </div>

          {addPreviewSrc && (
            <div style={{ marginBottom: 20 }}>
              <div style={{ fontSize: 12, color: '#666', fontWeight: 600, marginBottom: 8 }}>Live Preview:</div>
              <div style={{ border: '1px dashed #ccc', borderRadius: 8, padding: 10, display: 'inline-block', background: '#fafafa' }}>
                <img
                  src={getImageSrc(addPreviewSrc)}
                  alt="Preview"
                  style={{ maxHeight: 150, borderRadius: 6, objectFit: 'contain' }}
                  onError={(e) => {
                    (e.target as HTMLElement).style.display = 'none'
                  }}
                />
              </div>
            </div>
          )}

          <div style={{ display: 'flex', gap: 10 }}>
            <button onClick={handleAdd} disabled={uploading}
              style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: uploading ? 'not-allowed' : 'pointer', fontWeight: 600 }}>
              {uploading ? 'Saving...' : 'Save'}
            </button>
            <button onClick={() => { resetAddForm(); setShowForm(false) }} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      {editingItem && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)', borderLeft: '4px solid #3347B0' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Edit Gallery Image</h4>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 1fr 1fr', gap: 15, marginBottom: 15 }}>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Title</label>
              <input placeholder="Title" value={editingItem.title || ''} onChange={e => setEditingItem({ ...editingItem, title: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Upload Replacement</label>
              <input
                type="file"
                id="admin-gallery-edit-image-upload"
                accept="image/*"
                onChange={e => setEditUploadFile(e.target.files?.[0] || null)}
                style={{ padding: 8, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 13, background: '#fafafa' }}
              />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Category</label>
              <input
                list="admin-gallery-edit-category-options"
                placeholder="Category"
                value={editingItem.category || ''}
                onChange={e => setEditingItem({ ...editingItem, category: e.target.value })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }}
              />
              <datalist id="admin-gallery-edit-category-options">
                {categoryOptions.map(c => <option key={c} value={c} />)}
              </datalist>
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Sort Order</label>
              <input type="number" placeholder="Sort Order" value={editingItem.sort_order} onChange={e => setEditingItem({ ...editingItem, sort_order: parseInt(e.target.value) || 0 })}
                style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
            </div>
          </div>

          <div style={{ display: 'flex', flexDirection: 'column', gap: 6, marginBottom: 15 }}>
            <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Image URL</label>
            <input placeholder="Image URL" value={editingItem.image_url} onChange={e => setEditingItem({ ...editingItem, image_url: e.target.value })}
              style={{ padding: 11, border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14 }} />
          </div>

          {editPreviewSrc && (
            <div style={{ marginBottom: 20 }}>
              <div style={{ fontSize: 12, color: '#666', fontWeight: 600, marginBottom: 8 }}>Image Preview:</div>
              <div style={{ border: '1px dashed #ccc', borderRadius: 8, padding: 10, display: 'inline-block', background: '#fafafa' }}>
                <img
                  src={getImageSrc(editPreviewSrc)}
                  alt="Preview"
                  style={{ maxHeight: 150, borderRadius: 6, objectFit: 'contain' }}
                  onError={(e) => {
                    (e.target as HTMLElement).style.display = 'none'
                  }}
                />
              </div>
            </div>
          )}

          <div style={{ display: 'flex', gap: 10 }}>
            <button onClick={handleUpdate} disabled={uploading}
              style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: uploading ? 'not-allowed' : 'pointer', fontWeight: 600 }}>
              {uploading ? 'Saving...' : 'Update'}
            </button>
            <button onClick={() => { setEditingItem(null); resetEditUpload() }} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(240px, 1fr))', gap: 20 }}>
        {images.slice((currentPage - 1) * ITEMS_PER_PAGE, currentPage * ITEMS_PER_PAGE).map((img) => (
          <div key={img.id} style={{
            background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 12px rgba(0,0,0,0.04)', position: 'relative',
            display: 'flex', flexDirection: 'column', border: '1px solid #f0f0f0'
          }}>
            <img src={getImageSrc(img.image_url)} alt={img.title || ''} style={{ width: '100%', height: 180, objectFit: 'cover' }} />
            <div style={{ padding: '12px 15px', flexGrow: 1 }}>
              <div style={{ fontSize: 14, fontWeight: 700, color: '#333', marginBottom: 4 }}>{img.title || 'Untitled'}</div>
              <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginTop: 8 }}>
                <span style={{ fontSize: 11, color: '#3347B0', background: '#eef1ff', padding: '2px 8px', borderRadius: 12, fontWeight: 600 }}>{img.category || 'General'}</span>
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
      <AdminPagination
        currentPage={currentPage}
        totalItems={images.length}
        itemsPerPage={ITEMS_PER_PAGE}
        onPageChange={setCurrentPage}
      />
    </div>
  )
}
