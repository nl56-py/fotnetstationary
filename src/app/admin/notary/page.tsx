'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import AdminPagination from '@/components/ui/AdminPagination'

interface NotaryRequest {
  id: string
  customer_name: string
  customer_email: string | null
  customer_phone: string
  service_type: string
  sub_service_type: string | null
  message: string | null
  file_url: string | null
  drive_link: string | null
  status: 'pending' | 'in_progress' | 'completed' | 'cancelled'
  admin_notes: string | null
  created_at: string
  updated_at: string
}

const statusOptions = ['pending', 'in_progress', 'completed', 'cancelled']

export default function AdminNotaryRequests() {
  const [requests, setRequests] = useState<NotaryRequest[]>([])
  const [loading, setLoading] = useState(true)
  const [filter, setFilter] = useState('all')
  const [editingNotesId, setEditingNotesId] = useState<string | null>(null)
  const [notesTemp, setNotesTemp] = useState('')
  const [currentPage, setCurrentPage] = useState(1)
  const ITEMS_PER_PAGE = 20

  const supabase = createClient()

  const fetchRequests = async () => {
    let query = supabase.from('notary_requests').select('*').order('created_at', { ascending: false })
    if (filter !== 'all') query = query.eq('status', filter)
    const { data } = await query
    setRequests(data || [])
    setLoading(false)
  }

  useEffect(() => {
    setCurrentPage(1)
    fetchRequests()
  }, [filter])

  const updateStatus = async (id: string, status: string) => {
    await supabase.from('notary_requests').update({ status, updated_at: new Date().toISOString() }).eq('id', id)
    fetchRequests()
  }

  const saveNotes = async (id: string) => {
    await supabase.from('notary_requests').update({ admin_notes: notesTemp, updated_at: new Date().toISOString() }).eq('id', id)
    setEditingNotesId(null)
    fetchRequests()
  }

  const startEditNotes = (req: NotaryRequest) => {
    setEditingNotesId(req.id)
    setNotesTemp(req.admin_notes || '')
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      <div style={{ display: 'flex', gap: 10, marginBottom: 20, flexWrap: 'wrap' }}>
        {['all', ...statusOptions].map((s) => (
          <button
            key={s}
            onClick={() => setFilter(s)}
            style={{
              padding: '8px 18px',
              borderRadius: 20,
              border: 'none',
              cursor: 'pointer',
              background: filter === s ? '#3347B0' : '#e0e0e0',
              color: filter === s ? '#fff' : '#555',
              fontSize: 13,
              fontWeight: 600,
              textTransform: 'capitalize',
            }}
          >
            {s === 'all' ? 'All' : s.replace('_', ' ')}
          </button>
        ))}
      </div>

      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        {requests.length === 0 ? (
          <p style={{ textAlign: 'center', padding: 40, color: '#888' }}>No notary requests found</p>
        ) : (
          <div style={{ overflowX: 'auto' }}>
            <table style={{ width: '100%', borderCollapse: 'collapse', minWidth: 900 }}>
              <thead>
                <tr style={{ background: '#f8f9fa', borderBottom: '2px solid #e0e0e0' }}>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Customer</th>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Contact</th>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Service Details</th>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Documents</th>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Notes / Message</th>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Status</th>
                  <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Date</th>
                </tr>
              </thead>
              <tbody>
                {requests.slice((currentPage - 1) * ITEMS_PER_PAGE, currentPage * ITEMS_PER_PAGE).map((r) => (
                  <tr key={r.id} style={{ borderBottom: '1px solid #f0f0f0', verticalAlign: 'top' }}>
                    <td style={{ padding: '15px', fontSize: 14 }}>
                      <div style={{ fontWeight: 600 }}>{r.customer_name}</div>
                    </td>
                    <td style={{ padding: '15px', fontSize: 13 }}>
                      <div><i className="fa fa-phone" style={{ marginRight: 5 }}></i>{r.customer_phone}</div>
                      {r.customer_email && <div style={{ color: '#666', marginTop: 4 }}><i className="fa fa-envelope-o" style={{ marginRight: 5 }}></i>{r.customer_email}</div>}
                    </td>
                    <td style={{ padding: '15px', fontSize: 13 }}>
                      <div style={{ fontWeight: 600, color: '#3347B0' }}>{r.service_type}</div>
                      {r.sub_service_type && <div style={{ color: '#555', marginTop: 4 }}>Sub-service: {r.sub_service_type}</div>}
                    </td>
                    <td style={{ padding: '15px', fontSize: 13 }}>
                      <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
                        {r.file_url ? (
                          <a
                            href={r.file_url}
                            target="_blank"
                            rel="noopener noreferrer"
                            style={{
                              padding: '5px 10px',
                              background: '#eef1ff',
                              color: '#3347B0',
                              borderRadius: 4,
                              textDecoration: 'none',
                              fontSize: 12,
                              fontWeight: 600,
                              display: 'inline-flex',
                              alignItems: 'center',
                              gap: 5
                            }}
                          >
                            <i className="fa fa-file-pdf-o"></i> View File
                          </a>
                        ) : null}

                        {r.drive_link ? (
                          <a
                            href={r.drive_link}
                            target="_blank"
                            rel="noopener noreferrer"
                            style={{
                              padding: '5px 10px',
                              background: '#fff9e6',
                              color: '#d48a00',
                              borderRadius: 4,
                              textDecoration: 'none',
                              fontSize: 12,
                              fontWeight: 600,
                              display: 'inline-flex',
                              alignItems: 'center',
                              gap: 5,
                              border: '1px solid #ffe8cc'
                            }}
                          >
                            <i className="fa fa-external-link"></i> Cloud Link
                          </a>
                        ) : null}

                        {!r.file_url && !r.drive_link ? <span style={{ color: '#999' }}>No files</span> : null}
                      </div>
                    </td>
                    <td style={{ padding: '15px', fontSize: 13 }}>
                      <div style={{ marginBottom: 10 }}>
                        <strong>Customer Message:</strong>
                        <p style={{ margin: '4px 0 0 0', color: '#555', fontStyle: 'italic' }}>{r.message || 'None'}</p>
                      </div>

                      {/* Admin Notes Section */}
                      <div style={{ borderTop: '1px dashed #eee', paddingTop: 8 }}>
                        <strong>Admin Notes:</strong>
                        {editingNotesId === r.id ? (
                          <div style={{ marginTop: 6, display: 'flex', flexDirection: 'column', gap: 6 }}>
                            <textarea
                              value={notesTemp}
                              onChange={(e) => setNotesTemp(e.target.value)}
                              style={{ width: '100%', padding: 8, fontSize: 12, borderRadius: 6, border: '1px solid #ccc', resize: 'vertical' }}
                              rows={2}
                            />
                            <div style={{ display: 'flex', gap: 6 }}>
                              <button
                                onClick={() => saveNotes(r.id)}
                                style={{ padding: '4px 8px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 4, fontSize: 11, cursor: 'pointer' }}
                              >
                                Save
                              </button>
                              <button
                                onClick={() => setEditingNotesId(null)}
                                style={{ padding: '4px 8px', background: '#ccc', color: '#333', border: 'none', borderRadius: 4, fontSize: 11, cursor: 'pointer' }}
                              >
                                Cancel
                              </button>
                            </div>
                          </div>
                        ) : (
                          <div style={{ marginTop: 4, display: 'flex', justifyContent: 'space-between', alignItems: 'center', gap: 8 }}>
                            <span style={{ color: '#666', fontStyle: r.admin_notes ? 'normal' : 'italic' }}>{r.admin_notes || 'No admin notes'}</span>
                            <button
                              onClick={() => startEditNotes(r)}
                              style={{ background: 'none', border: 'none', color: '#3347B0', cursor: 'pointer', fontSize: 11 }}
                            >
                              <i className="fa fa-pencil"></i> Edit
                            </button>
                          </div>
                        )}
                      </div>
                    </td>
                    <td style={{ padding: '15px' }}>
                      <select
                        value={r.status}
                        onChange={(e) => updateStatus(r.id, e.target.value)}
                        style={{
                          padding: '6px 12px',
                          borderRadius: 6,
                          border: '1px solid #ddd',
                          fontSize: 12,
                          cursor: 'pointer',
                          textTransform: 'capitalize',
                          fontWeight: 600,
                          background:
                            r.status === 'pending'
                              ? '#ffebeb'
                              : r.status === 'in_progress'
                              ? '#eef1ff'
                              : r.status === 'completed'
                              ? '#eafaf1'
                              : '#f5f5f5',
                          color:
                            r.status === 'pending'
                              ? '#e74c3c'
                              : r.status === 'in_progress'
                              ? '#3347B0'
                              : r.status === 'completed'
                              ? '#27ae60'
                              : '#666'
                        }}
                      >
                        {statusOptions.map(s => <option key={s} value={s}>{s.replace('_', ' ')}</option>)}
                      </select>
                    </td>
                    <td style={{ padding: '15px', fontSize: 12, color: '#888' }}>
                      {new Date(r.created_at).toLocaleDateString()}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>
      <AdminPagination
        currentPage={currentPage}
        totalItems={requests.length}
        itemsPerPage={ITEMS_PER_PAGE}
        onPageChange={setCurrentPage}
      />
    </div>
  )
}
