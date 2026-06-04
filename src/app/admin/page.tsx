'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'

interface DashboardStats {
  bookings: number
  messages: number
  services: number
  gallery: number
  blogs: number
}

interface RecentBooking {
  id: string
  customer_name: string
  customer_phone: string
  service_type: string | null
  status: string
  created_at: string
}

export default function AdminDashboard() {
  const [stats, setStats] = useState<DashboardStats>({ bookings: 0, messages: 0, services: 0, gallery: 0, blogs: 0 })
  const [recentBookings, setRecentBookings] = useState<RecentBooking[]>([])
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    const fetchData = async () => {
      const supabase = createClient()

      const [bookingsRes, messagesRes, servicesRes, galleryRes, blogsRes, recentRes] = await Promise.all([
        supabase.from('bookings').select('id', { count: 'exact', head: true }),
        supabase.from('contact_submissions').select('id', { count: 'exact', head: true }).eq('is_read', false),
        supabase.from('services').select('id', { count: 'exact', head: true }),
        supabase.from('gallery_images').select('id', { count: 'exact', head: true }),
        supabase.from('blog_posts').select('id', { count: 'exact', head: true }),
        supabase.from('bookings').select('*').order('created_at', { ascending: false }).limit(5),
      ])

      setStats({
        bookings: bookingsRes.count || 0,
        messages: messagesRes.count || 0,
        services: servicesRes.count || 0,
        gallery: galleryRes.count || 0,
        blogs: blogsRes.count || 0,
      })
      setRecentBookings(recentRes.data || [])
      setLoading(false)
    }
    fetchData()
  }, [])

  const statCards = [
    { label: 'Total Bookings', value: stats.bookings, icon: 'fa fa-calendar-check-o', color: '#3347B0', bg: '#eef1ff' },
    { label: 'Unread Messages', value: stats.messages, icon: 'fa fa-envelope', color: '#e74c3c', bg: '#fdecea' },
    { label: 'Active Services', value: stats.services, icon: 'fa fa-cogs', color: '#27ae60', bg: '#e8f8f0' },
    { label: 'Gallery Images', value: stats.gallery, icon: 'fa fa-image', color: '#f39c12', bg: '#fef9e7' },
    { label: 'Blog Posts', value: stats.blogs, icon: 'fa fa-pencil-square-o', color: '#8e44ad', bg: '#f4ecf7' },
  ]

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  return (
    <div>
      {/* Stats Grid */}
      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: 20, marginBottom: 30 }}>
        {statCards.map((card, idx) => (
          <div key={idx} style={{
            background: '#fff', borderRadius: 12, padding: '20px', boxShadow: '0 2px 10px rgba(0,0,0,0.06)',
            display: 'flex', alignItems: 'center', gap: 15, transition: 'transform 0.2s ease',
          }}>
            <div style={{
              width: 50, height: 50, background: card.bg, borderRadius: 10,
              display: 'flex', alignItems: 'center', justifyContent: 'center',
            }}>
              <i className={card.icon} style={{ fontSize: 22, color: card.color }}></i>
            </div>
            <div>
              <div style={{ fontSize: 28, fontWeight: 700, color: '#222', fontFamily: "'Oswald', sans-serif" }}>
                {card.value}
              </div>
              <div style={{ fontSize: 12, color: '#888', textTransform: 'uppercase', letterSpacing: 0.5 }}>
                {card.label}
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Recent Bookings */}
      <div style={{ background: '#fff', borderRadius: 12, padding: 25, boxShadow: '0 2px 10px rgba(0,0,0,0.06)' }}>
        <h3 style={{ fontSize: 18, color: '#222', fontFamily: "'Oswald', sans-serif", marginBottom: 20 }}>
          Recent Bookings
        </h3>
        {recentBookings.length === 0 ? (
          <p style={{ color: '#888', textAlign: 'center', padding: 30 }}>No bookings yet</p>
        ) : (
          <table style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr style={{ borderBottom: '2px solid #f0f0f0' }}>
                <th style={{ padding: '10px 12px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Customer</th>
                <th style={{ padding: '10px 12px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Phone</th>
                <th style={{ padding: '10px 12px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Service</th>
                <th style={{ padding: '10px 12px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Status</th>
                <th style={{ padding: '10px 12px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Date</th>
              </tr>
            </thead>
            <tbody>
              {recentBookings.map((booking) => (
                <tr key={booking.id} style={{ borderBottom: '1px solid #f5f5f5' }}>
                  <td style={{ padding: '12px', fontSize: 14 }}>{booking.customer_name}</td>
                  <td style={{ padding: '12px', fontSize: 14 }}>{booking.customer_phone}</td>
                  <td style={{ padding: '12px', fontSize: 14 }}>{booking.service_type || '-'}</td>
                  <td style={{ padding: '12px' }}>
                    <span className={`status-badge status-${booking.status}`}>{booking.status}</span>
                  </td>
                  <td style={{ padding: '12px', fontSize: 13, color: '#888' }}>
                    {new Date(booking.created_at).toLocaleDateString()}
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
