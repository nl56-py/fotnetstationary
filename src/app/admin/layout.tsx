'use client'
import { useEffect, useState } from 'react'
import { useRouter, usePathname } from 'next/navigation'
import Link from 'next/link'
import { useAuth } from '@/context/AuthContext'

const sidebarItems = [
  { label: 'Dashboard', icon: 'fa fa-dashboard', href: '/admin' },
  { label: 'Services', icon: 'fa fa-cogs', href: '/admin/services' },
  { label: 'Gallery', icon: 'fa fa-image', href: '/admin/gallery' },
  { label: 'Pricing', icon: 'fa fa-money', href: '/admin/pricing' },
  { label: 'Blog Posts', icon: 'fa fa-pencil-square-o', href: '/admin/blogs' },
  { label: 'Bookings', icon: 'fa fa-calendar-check-o', href: '/admin/bookings' },
  { label: 'Videos', icon: 'fa fa-video-camera', href: '/admin/videos' },
  { label: 'Messages', icon: 'fa fa-envelope', href: '/admin/messages' },
  { label: 'Settings', icon: 'fa fa-sliders', href: '/admin/settings' },
]

export default function AdminLayout({ children }: { children: React.ReactNode }) {
  const { user, loading, signOut } = useAuth()
  const [sidebarOpen, setSidebarOpen] = useState(true)
  const router = useRouter()
  const pathname = usePathname()

  // Skip auth check for login page
  const isLoginPage = pathname === '/admin/login'

  useEffect(() => {
    if (!loading && !user && !isLoginPage) {
      router.push('/admin/login')
    }
  }, [user, loading, isLoginPage, router])

  const handleLogout = async () => {
    await signOut()
    router.push('/admin/login')
  }

  if (isLoginPage) return <>{children}</>
  if (loading || !user) return (
    <div style={{ minHeight: '100vh', display: 'flex', alignItems: 'center', justifyContent: 'center', background: '#1a1a2e' }}>
      <div className="spinner"></div>
    </div>
  )

  return (
    <div style={{ display: 'flex', minHeight: '100vh', background: '#f0f2f5', fontFamily: "'Roboto', sans-serif" }}>
      {/* Sidebar */}
      <aside style={{
        width: sidebarOpen ? '260px' : '70px',
        background: 'linear-gradient(180deg, #1a1a2e 0%, #16213e 100%)',
        color: '#fff', transition: 'width 0.3s ease', overflow: 'hidden',
        position: 'fixed', top: 0, left: 0, bottom: 0, zIndex: 100,
        boxShadow: '2px 0 15px rgba(0,0,0,0.2)',
      }}>
        <div style={{
          padding: sidebarOpen ? '20px' : '20px 10px', borderBottom: '1px solid rgba(255,255,255,0.08)',
          display: 'flex', alignItems: 'center', gap: '12px', justifyContent: sidebarOpen ? 'flex-start' : 'center',
        }}>
          <div style={{
            width: 36, height: 36, background: 'linear-gradient(135deg, #3347B0, #5b6fd6)',
            borderRadius: 8, display: 'flex', alignItems: 'center', justifyContent: 'center', flexShrink: 0,
          }}>
            <i className="fa fa-print" style={{ color: '#fff', fontSize: 16 }}></i>
          </div>
          {sidebarOpen && (
            <div>
              <div style={{ fontSize: 14, fontWeight: 700, fontFamily: "'Oswald', sans-serif", whiteSpace: 'nowrap' }}>FCI Admin</div>
              <div style={{ fontSize: 11, color: 'rgba(255,255,255,0.5)' }}>Control Panel</div>
            </div>
          )}
        </div>

        <nav style={{ padding: '15px 0' }}>
          {sidebarItems.map((item) => {
            const isActive = pathname === item.href
            return (
              <Link
                key={item.href}
                href={item.href}
                style={{
                  display: 'flex', alignItems: 'center', gap: '12px',
                  padding: sidebarOpen ? '12px 20px' : '12px',
                  justifyContent: sidebarOpen ? 'flex-start' : 'center',
                  color: isActive ? '#fff' : 'rgba(255,255,255,0.6)',
                  background: isActive ? 'rgba(51,71,176,0.3)' : 'transparent',
                  borderLeft: isActive ? '3px solid #3347B0' : '3px solid transparent',
                  fontSize: 14, fontWeight: isActive ? 600 : 400,
                  transition: 'all 0.2s ease', textDecoration: 'none',
                }}
              >
                <i className={item.icon} style={{ fontSize: 16, width: 20, textAlign: 'center' }}></i>
                {sidebarOpen && <span style={{ whiteSpace: 'nowrap' }}>{item.label}</span>}
              </Link>
            )
          })}
        </nav>

        <div style={{
          position: 'absolute', bottom: 0, left: 0, right: 0,
          padding: '15px', borderTop: '1px solid rgba(255,255,255,0.08)',
        }}>
          <button
            onClick={handleLogout}
            style={{
              width: '100%', padding: '10px', background: 'rgba(220,53,69,0.15)',
              border: '1px solid rgba(220,53,69,0.3)', borderRadius: 8, color: '#ff6b7a',
              cursor: 'pointer', fontSize: 13, display: 'flex', alignItems: 'center',
              justifyContent: sidebarOpen ? 'flex-start' : 'center', gap: 10,
            }}
          >
            <i className="fa fa-sign-out"></i>
            {sidebarOpen && 'Sign Out'}
          </button>
        </div>
      </aside>

      {/* Main Content */}
      <div style={{ flex: 1, marginLeft: sidebarOpen ? '260px' : '70px', transition: 'margin-left 0.3s ease' }}>
        {/* Top Header */}
        <header style={{
          background: '#fff', padding: '12px 25px', display: 'flex',
          alignItems: 'center', justifyContent: 'space-between',
          boxShadow: '0 2px 8px rgba(0,0,0,0.06)', position: 'sticky', top: 0, zIndex: 50,
        }}>
          <div style={{ display: 'flex', alignItems: 'center', gap: 15 }}>
            <button
              onClick={() => setSidebarOpen(!sidebarOpen)}
              style={{ background: 'none', border: 'none', cursor: 'pointer', fontSize: 20, color: '#555', padding: 5 }}
            >
              <i className="fa fa-bars"></i>
            </button>
            <h3 style={{ margin: 0, fontSize: 18, color: '#333', fontFamily: "'Oswald', sans-serif" }}>
              {sidebarItems.find(i => i.href === pathname)?.label || 'Dashboard'}
            </h3>
          </div>
          <div style={{ display: 'flex', alignItems: 'center', gap: 15 }}>
            <a href="/" target="_blank" rel="noopener noreferrer" style={{ fontSize: 13, color: '#3347B0' }}>
              <i className="fa fa-external-link" style={{ marginRight: 5 }}></i>View Site
            </a>
            <div style={{ fontSize: 13, color: '#888' }}>
              <i className="fa fa-user-circle" style={{ marginRight: 5 }}></i>
              {user?.email || 'Admin'}
            </div>
          </div>
        </header>

        {/* Page Content */}
        <main style={{ padding: '25px' }}>
          {children}
        </main>
      </div>
    </div>
  )
}
