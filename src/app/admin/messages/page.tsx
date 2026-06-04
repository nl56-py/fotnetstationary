'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { ContactSubmission } from '@/lib/types'

export default function AdminMessages() {
  const [messages, setMessages] = useState<ContactSubmission[]>([])
  const [loading, setLoading] = useState(true)

  const supabase = createClient()

  const fetchMessages = async () => {
    const { data } = await supabase.from('contact_submissions').select('*').order('created_at', { ascending: false })
    setMessages(data || [])
    setLoading(false)
  }

  useEffect(() => { fetchMessages() }, [])

  const markAsRead = async (id: string) => {
    await supabase.from('contact_submissions').update({ is_read: true }).eq('id', id)
    fetchMessages()
  }

  const deleteMessage = async (id: string) => {
    if (confirm('Delete this message?')) {
      await supabase.from('contact_submissions').delete().eq('id', id)
      fetchMessages()
    }
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <p style={{ color: '#888', marginBottom: 20 }}>
        {messages.filter(m => !m.is_read).length} unread messages
      </p>

      <div style={{ display: 'flex', flexDirection: 'column', gap: 12 }}>
        {messages.length === 0 ? (
          <div style={{ background: '#fff', borderRadius: 12, padding: 40, textAlign: 'center', color: '#888' }}>
            No messages yet
          </div>
        ) : messages.map((msg) => (
          <div key={msg.id} style={{
            background: '#fff', borderRadius: 12, padding: 20, boxShadow: '0 2px 10px rgba(0,0,0,0.06)',
            borderLeft: msg.is_read ? '4px solid #e0e0e0' : '4px solid #3347B0',
          }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start' }}>
              <div>
                <div style={{ fontSize: 16, fontWeight: 600, color: '#222', marginBottom: 4 }}>
                  {msg.first_name} {msg.last_name || ''}
                  {!msg.is_read && <span style={{ background: '#3347B0', color: '#fff', fontSize: 10, padding: '2px 8px', borderRadius: 10, marginLeft: 10 }}>New</span>}
                </div>
                <div style={{ fontSize: 13, color: '#888', marginBottom: 8 }}>
                  {msg.email && <><i className="fa fa-envelope-o" style={{ marginRight: 5 }}></i>{msg.email} &nbsp;&nbsp;</>}
                  {msg.phone && <><i className="fa fa-phone" style={{ marginRight: 5 }}></i>{msg.phone}</>}
                </div>
                {msg.message && <p style={{ fontSize: 14, color: '#555', lineHeight: 1.6, margin: 0 }}>{msg.message}</p>}
              </div>
              <div style={{ display: 'flex', gap: 8, flexShrink: 0 }}>
                <span style={{ fontSize: 12, color: '#aaa' }}>{new Date(msg.created_at).toLocaleDateString()}</span>
                {!msg.is_read && (
                  <button onClick={() => markAsRead(msg.id)} title="Mark as read"
                    style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#3347B0' }}>
                    <i className="fa fa-check"></i>
                  </button>
                )}
                <button onClick={() => deleteMessage(msg.id)} title="Delete"
                  style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#e74c3c' }}>
                  <i className="fa fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}
