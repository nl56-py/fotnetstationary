'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { BlogPost } from '@/lib/types'
import Link from 'next/link'

export default function AdminBlogs() {
  const [posts, setPosts] = useState<BlogPost[]>([])
  const [loading, setLoading] = useState(true)

  const supabase = createClient()

  useEffect(() => {
    const fetchPosts = async () => {
      const sb = createClient()
      const { data } = await sb.from('blog_posts').select('*').order('created_at', { ascending: false })
      setPosts(data || [])
      setLoading(false)
    }
    fetchPosts()
  }, [])

  const togglePublish = async (id: string, isPublished: boolean) => {
    await supabase.from('blog_posts').update({
      is_published: !isPublished,
      published_at: !isPublished ? new Date().toISOString() : null,
    }).eq('id', id)
    setPosts(posts.map(p => p.id === id ? { ...p, is_published: !isPublished } : p))
  }

  const deletePost = async (id: string) => {
    if (confirm('Delete this blog post?')) {
      await supabase.from('blog_posts').delete().eq('id', id)
      setPosts(posts.filter(p => p.id !== id))
    }
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
        <p style={{ color: '#888', margin: 0 }}>{posts.length} blog posts</p>
        <Link href="/admin/blogs/new"
          style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', borderRadius: 8, fontWeight: 600, textDecoration: 'none', fontSize: 14 }}>
          <i className="fa fa-plus" style={{ marginRight: 8 }}></i>New Post
        </Link>
      </div>

      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        {posts.length === 0 ? (
          <p style={{ textAlign: 'center', padding: 40, color: '#888' }}>No blog posts yet. Create your first post!</p>
        ) : (
          <table style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr style={{ background: '#f8f9fa', borderBottom: '2px solid #e0e0e0' }}>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Title</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Author</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Status</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Date</th>
                <th style={{ padding: '12px 15px', textAlign: 'right', fontSize: 13, color: '#666' }}>Actions</th>
              </tr>
            </thead>
            <tbody>
              {posts.map((post) => (
                <tr key={post.id} style={{ borderBottom: '1px solid #f0f0f0' }}>
                  <td style={{ padding: '12px 15px', fontSize: 14, fontWeight: 600 }}>
                    <Link href={`/admin/blogs/${post.id}`} style={{ color: '#222' }}>{post.title}</Link>
                  </td>
                  <td style={{ padding: '12px 15px', fontSize: 13, color: '#666' }}>{post.author}</td>
                  <td style={{ padding: '12px 15px' }}>
                    <button onClick={() => togglePublish(post.id, post.is_published)} style={{
                      padding: '4px 12px', borderRadius: 20, border: 'none', fontSize: 12, cursor: 'pointer',
                      background: post.is_published ? '#d4edda' : '#fff3cd',
                      color: post.is_published ? '#155724' : '#856404',
                    }}>{post.is_published ? 'Published' : 'Draft'}</button>
                  </td>
                  <td style={{ padding: '12px 15px', fontSize: 13, color: '#888' }}>
                    {new Date(post.created_at).toLocaleDateString()}
                  </td>
                  <td style={{ padding: '12px 15px', textAlign: 'right' }}>
                    <Link href={`/admin/blogs/${post.id}`} style={{ color: '#3347B0', marginRight: 12 }}>
                      <i className="fa fa-pencil"></i>
                    </Link>
                    <button onClick={() => deletePost(post.id)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#e74c3c' }}>
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
