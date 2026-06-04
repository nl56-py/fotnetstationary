'use client'
import { useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import { useRouter } from 'next/navigation'
import RichTextEditor from '@/components/ui/RichTextEditor'

export default function NewBlogPost() {
  const [form, setForm] = useState({
    title: '',
    slug: '',
    excerpt: '',
    content: '',
    featured_image: '',
    author: 'Admin',
    is_published: false,
  })
  const [saving, setSaving] = useState(false)
  const router = useRouter()
  const supabase = createClient()

  const handleSave = async () => {
    if (!form.title) return alert('Title is required')
    setSaving(true)
    const slug = form.slug || form.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '')
    const { error } = await supabase.from('blog_posts').insert({
      ...form,
      slug,
      published_at: form.is_published ? new Date().toISOString() : null,
    })
    if (error) {
      alert('Error saving post: ' + error.message)
    } else {
      router.push('/admin/blogs')
    }
    setSaving(false)
  }

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
        <button onClick={() => router.back()} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#3347B0', fontSize: 14 }}>
          <i className="fa fa-arrow-left" style={{ marginRight: 8 }}></i>Back to Posts
        </button>
        <div style={{ display: 'flex', gap: 10 }}>
          <label style={{ display: 'flex', alignItems: 'center', gap: 8, fontSize: 14, cursor: 'pointer' }}>
            <input type="checkbox" checked={form.is_published} onChange={e => setForm({ ...form, is_published: e.target.checked })} />
            Publish
          </label>
          <button onClick={handleSave} disabled={saving}
            style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>
            {saving ? 'Saving...' : 'Save Post'}
          </button>
        </div>
      </div>

      <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr', gap: 20 }}>
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
          <input placeholder="Post Title" value={form.title} onChange={e => setForm({ ...form, title: e.target.value })}
            style={{ width: '100%', padding: '14px 16px', border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 20, fontWeight: 600, fontFamily: "'Oswald', sans-serif", marginBottom: 15, boxSizing: 'border-box' }} />
          <input placeholder="Excerpt (short description)" value={form.excerpt} onChange={e => setForm({ ...form, excerpt: e.target.value })}
            style={{ width: '100%', padding: '12px 16px', border: '1px solid #e0e0e0', borderRadius: 8, fontSize: 14, marginBottom: 15, boxSizing: 'border-box' }} />

          {/* Rich Text Editor Area */}
          <div style={{ marginBottom: 15 }}>
            <label style={{ display: 'block', fontSize: 13, color: '#666', marginBottom: 6 }}>Content</label>
            <RichTextEditor 
              content={form.content} 
              onChange={(content) => setForm({ ...form, content })} 
            />
          </div>
        </div>

        <div>
          <div style={{ background: '#fff', borderRadius: 12, padding: 20, boxShadow: '0 2px 10px rgba(0,0,0,0.06)', marginBottom: 16 }}>
            <h4 style={{ marginBottom: 12, fontSize: 14, color: '#888', textTransform: 'uppercase' }}>Post Settings</h4>
            <label style={{ display: 'block', fontSize: 13, color: '#666', marginBottom: 6 }}>Slug</label>
            <input placeholder="post-url-slug" value={form.slug} onChange={e => setForm({ ...form, slug: e.target.value })}
              style={{ width: '100%', padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13, marginBottom: 12, boxSizing: 'border-box' }} />
            <label style={{ display: 'block', fontSize: 13, color: '#666', marginBottom: 6 }}>Author</label>
            <input placeholder="Author name" value={form.author} onChange={e => setForm({ ...form, author: e.target.value })}
              style={{ width: '100%', padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13, boxSizing: 'border-box' }} />
          </div>
          <div style={{ background: '#fff', borderRadius: 12, padding: 20, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
            <h4 style={{ marginBottom: 12, fontSize: 14, color: '#888', textTransform: 'uppercase' }}>Featured Image</h4>
            <input placeholder="Image URL" value={form.featured_image} onChange={e => setForm({ ...form, featured_image: e.target.value })}
              style={{ width: '100%', padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13, boxSizing: 'border-box' }} />
            {form.featured_image && (
              <img src={form.featured_image} alt="Preview" style={{ width: '100%', borderRadius: 6, marginTop: 10, maxHeight: 200, objectFit: 'cover' }} />
            )}
          </div>
        </div>
      </div>
    </div>
  )
}
