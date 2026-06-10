'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { Booking } from '@/lib/types'
import AdminPagination from '@/components/ui/AdminPagination'

const statusOptions = ['pending', 'in_progress', 'completed', 'cancelled']

export default function AdminBookings() {
  const [bookings, setBookings] = useState<Booking[]>([])
  const [loading, setLoading] = useState(true)
  const [filter, setFilter] = useState('all')
  const [currentPage, setCurrentPage] = useState(1)
  const ITEMS_PER_PAGE = 20

  const supabase = createClient()

  const fetchBookings = async () => {
    let query = supabase.from('bookings').select('*').order('created_at', { ascending: false })
    if (filter !== 'all') query = query.eq('status', filter)
    const { data } = await query
    setBookings(data || [])
    setLoading(false)
  }

  // eslint-disable-next-line react-hooks/exhaustive-deps
  useEffect(() => { setCurrentPage(1); fetchBookings() }, [filter])

  const updateStatus = async (id: string, status: string) => {
    await supabase.from('bookings').update({ status, updated_at: new Date().toISOString() }).eq('id', id)
    fetchBookings()
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      {(() => { const paginatedBookings = bookings.slice((currentPage - 1) * ITEMS_PER_PAGE, currentPage * ITEMS_PER_PAGE); return (<>
      <div style={{ display: 'flex', gap: 10, marginBottom: 20, flexWrap: 'wrap' }}>
        {['all', ...statusOptions].map((s) => (
          <button key={s} onClick={() => setFilter(s)} style={{
            padding: '8px 18px', borderRadius: 20, border: 'none', cursor: 'pointer',
            background: filter === s ? '#3347B0' : '#e0e0e0',
            color: filter === s ? '#fff' : '#555', fontSize: 13, fontWeight: 600, textTransform: 'capitalize',
          }}>{s === 'all' ? 'All' : s.replace('_', ' ')}</button>
        ))}
      </div>

      <div style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        {bookings.length === 0 ? (
          <p style={{ textAlign: 'center', padding: 40, color: '#888' }}>No bookings found</p>
        ) : (
          <table style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr style={{ background: '#f8f9fa', borderBottom: '2px solid #e0e0e0' }}>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Customer</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Phone</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Email</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Service</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Message</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Status</th>
                <th style={{ padding: '12px 15px', textAlign: 'left', fontSize: 13, color: '#666' }}>Date</th>
              </tr>
            </thead>
            <tbody>
              {paginatedBookings.map((b) => (
                <tr key={b.id} style={{ borderBottom: '1px solid #f0f0f0' }}>
                  <td style={{ padding: '12px 15px', fontSize: 14, fontWeight: 600 }}>{b.customer_name}</td>
                  <td style={{ padding: '12px 15px', fontSize: 14 }}>{b.customer_phone}</td>
                  <td style={{ padding: '12px 15px', fontSize: 13, color: '#666' }}>{b.customer_email || '-'}</td>
                  <td style={{ padding: '12px 15px', fontSize: 14 }}>{b.service_type || '-'}</td>
                  <td style={{ padding: '12px 15px', fontSize: 13, color: '#666', maxWidth: 200, overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{b.message || '-'}</td>
                  <td style={{ padding: '12px 15px' }}>
                    <select value={b.status} onChange={(e) => updateStatus(b.id, e.target.value)}
                      style={{ padding: '5px 10px', borderRadius: 6, border: '1px solid #ddd', fontSize: 12, cursor: 'pointer' }}>
                      {statusOptions.map(s => <option key={s} value={s}>{s.replace('_', ' ')}</option>)}
                    </select>
                  </td>
                  <td style={{ padding: '12px 15px', fontSize: 12, color: '#888' }}>
                    {new Date(b.created_at).toLocaleDateString()}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>
      <AdminPagination
        currentPage={currentPage}
        totalItems={bookings.length}
        itemsPerPage={ITEMS_PER_PAGE}
        onPageChange={setCurrentPage}
      />
      </>); })()}
    </div>
  )
}
