'use client'
import { useEffect, useState } from 'react'
import { useRouter, usePathname } from 'next/navigation'
import Link from 'next/link'
import { useAuth } from '@/context/AuthContext'

const sidebarItems = [
  { label: 'Dashboard', icon: 'fa fa-dashboard', href: '/admin' },
  { label: 'Services', icon: 'fa fa-cogs', href: '/admin/services' },
  { label: 'Notary Requests', icon: 'fa fa-file-text-o', href: '/admin/notary' },
  { label: 'Notices & News', icon: 'fa fa-bullhorn', href: '/admin/notices' },
  { label: 'Notes', icon: 'fa fa-sticky-note', href: '/admin/notes' },
  { label: 'Gallery', icon: 'fa fa-image', href: '/admin/gallery' },
  { label: 'Pricing', icon: 'fa fa-money', href: '/admin/pricing' },
  { label: 'Blog Posts', icon: 'fa fa-pencil-square-o', href: '/admin/blogs' },
  { label: 'Bookings', icon: 'fa fa-calendar-check-o', href: '/admin/bookings' },
  { label: 'Videos', icon: 'fa fa-video-camera', href: '/admin/videos' },
  { label: 'Messages', icon: 'fa fa-envelope', href: '/admin/messages' },
  { label: 'Popup Banners', icon: 'fa fa-bell', href: '/admin/popup-notice' },
  { label: 'Settings', icon: 'fa fa-sliders', href: '/admin/settings' },
]

export default function AdminLayout({ children }: { children: React.ReactNode }) {
  const { user, loading, signOut } = useAuth()
  const [sidebarOpen, setSidebarOpen] = useState(true)
  const [isMobile, setIsMobile] = useState(false)
  const router = useRouter()
  const pathname = usePathname()

  // Skip auth check for login page
  const isLoginPage = pathname === '/admin/login'

  // Detect mobile viewport
  useEffect(() => {
    const checkMobile = () => {
      const mobile = window.innerWidth <= 768
      setIsMobile(mobile)
      if (mobile) setSidebarOpen(false)
      else setSidebarOpen(true)
    }
    checkMobile()
    window.addEventListener('resize', checkMobile)
    return () => window.removeEventListener('resize', checkMobile)
  }, [])

  useEffect(() => {
    if (!loading && !user && !isLoginPage) {
      router.push('/admin/login')
    }
  }, [user, loading, isLoginPage, router])

  const handleLogout = async () => {
    await signOut()
    router.push('/admin/login')
  }

  // Auto logout on inactivity (15 minutes of no interaction)
  useEffect(() => {
    if (!user || isLoginPage) return

    const INACTIVITY_TIMEOUT = 15 * 60 * 1000 // 15 minutes
    let timeoutId: NodeJS.Timeout

    const handleInactivityLogout = async () => {
      await signOut()
      router.push('/admin/login')
    }

    const resetTimer = () => {
      if (timeoutId) clearTimeout(timeoutId)
      timeoutId = setTimeout(handleInactivityLogout, INACTIVITY_TIMEOUT)
    }

    const events = ['mousemove', 'keydown', 'mousedown', 'touchstart', 'scroll']
    events.forEach(event => window.addEventListener(event, resetTimer))

    resetTimer()

    return () => {
      if (timeoutId) clearTimeout(timeoutId)
      events.forEach(event => window.removeEventListener(event, resetTimer))
    }
  }, [user, isLoginPage, signOut, router])

  // Close sidebar on route change on mobile
  useEffect(() => {
    if (isMobile) setSidebarOpen(false)
  }, [pathname, isMobile])

  if (isLoginPage) return <>{children}</>
  if (loading || !user) return (
    <div style={{ minHeight: '100vh', display: 'flex', alignItems: 'center', justifyContent: 'center', background: '#1a1a2e' }}>
      <div className="spinner"></div>
    </div>
  )

  const currentPageLabel = sidebarItems.find(i => i.href === pathname)?.label || 'Dashboard'

  return (
    <>
      <style>{`
        .admin-root {
          display: flex;
          min-height: 100vh;
          background: #f0f2f5;
          font-family: 'Roboto', sans-serif;
        }

        /* --- Sidebar --- */
        .admin-sidebar {
          width: ${sidebarOpen ? '260px' : '70px'};
          background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
          color: #fff;
          transition: width 0.3s ease, left 0.3s ease;
          position: fixed;
          top: 0; left: 0; bottom: 0;
          z-index: 200;
          box-shadow: 2px 0 15px rgba(0,0,0,0.2);
          overflow-y: auto;
          overflow-x: hidden;
        }

        .admin-sidebar-overlay {
          display: none;
        }

        .admin-main {
          flex: 1;
          margin-left: ${sidebarOpen ? '260px' : '70px'};
          transition: margin-left 0.3s ease;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
          .admin-sidebar {
            width: 260px;
            left: ${sidebarOpen ? '0' : '-280px'};
          }

          .admin-sidebar-overlay {
            display: ${sidebarOpen ? 'block' : 'none'};
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.45);
            z-index: 199;
            transition: opacity 0.3s ease;
          }

          .admin-main {
            margin-left: 0;
          }
        }

        .sidebar-brand {
          padding: ${sidebarOpen ? '20px' : '20px 10px'};
          border-bottom: 1px solid rgba(255,255,255,0.08);
          display: flex;
          align-items: center;
          gap: 12px;
          justify-content: ${sidebarOpen ? 'flex-start' : 'center'};
        }

        @media (max-width: 768px) {
          .sidebar-brand {
            padding: 20px;
            justify-content: flex-start;
          }
        }

        .sidebar-brand-icon {
          width: 36px; height: 36px;
          background: linear-gradient(135deg, #3347B0, #5b6fd6);
          border-radius: 8px;
          display: flex; align-items: center; justify-content: center;
          flex-shrink: 0;
        }

        .sidebar-brand-text {
          display: ${sidebarOpen ? 'block' : 'none'};
        }

        @media (max-width: 768px) {
          .sidebar-brand-text { display: block; }
        }

        .sidebar-nav-link {
          display: flex;
          align-items: center;
          gap: 12px;
          padding: ${sidebarOpen ? '12px 20px' : '12px'};
          justify-content: ${sidebarOpen ? 'flex-start' : 'center'};
          font-size: 14px;
          transition: all 0.2s ease;
          text-decoration: none;
          border-left: 3px solid transparent;
        }

        @media (max-width: 768px) {
          .sidebar-nav-link {
            padding: 12px 20px;
            justify-content: flex-start;
          }
        }

        .sidebar-nav-link:hover {
          background: rgba(51,71,176,0.15);
          color: #fff;
        }

        .sidebar-nav-link-label {
          display: ${sidebarOpen ? 'inline' : 'none'};
          white-space: nowrap;
        }

        @media (max-width: 768px) {
          .sidebar-nav-link-label { display: inline; }
        }

        .sidebar-logout-area {
          position: absolute; bottom: 0; left: 0; right: 0;
          padding: 15px;
          border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-logout-btn {
          width: 100%;
          padding: 10px;
          background: rgba(220,53,69,0.15);
          border: 1px solid rgba(220,53,69,0.3);
          border-radius: 8px;
          color: #ff6b7a;
          cursor: pointer;
          font-size: 13px;
          display: flex;
          align-items: center;
          justify-content: ${sidebarOpen ? 'flex-start' : 'center'};
          gap: 10px;
        }

        @media (max-width: 768px) {
          .sidebar-logout-btn { justify-content: flex-start; }
        }

        .sidebar-logout-btn:hover {
          background: rgba(220,53,69,0.25);
        }

        .sidebar-logout-label {
          display: ${sidebarOpen ? 'inline' : 'none'};
        }

        @media (max-width: 768px) {
          .sidebar-logout-label { display: inline; }
        }

        /* --- Admin Header --- */
        .admin-header {
          background: #fff;
          padding: 12px 25px;
          display: flex;
          align-items: center;
          justify-content: space-between;
          box-shadow: 0 2px 8px rgba(0,0,0,0.06);
          position: sticky;
          top: 0;
          z-index: 50;
        }

        .admin-header-right {
          display: flex;
          align-items: center;
          gap: 15px;
        }

        @media (max-width: 480px) {
          .admin-header-right .admin-view-site-link { display: none; }
          .admin-header { padding: 10px 15px; }
        }
      `}</style>

      <div className="admin-root">
        {/* Mobile overlay backdrop */}
        <div
          className="admin-sidebar-overlay"
          onClick={() => setSidebarOpen(false)}
        />

        {/* Sidebar */}
        <aside className="admin-sidebar">
          <div className="sidebar-brand">
            <div className="sidebar-brand-icon">
              <i className="fa fa-print" style={{ color: '#fff', fontSize: 16 }}></i>
            </div>
            <div className="sidebar-brand-text">
              <div style={{ fontSize: 14, fontWeight: 700, fontFamily: "'Oswald', sans-serif", whiteSpace: 'nowrap' }}>FCI Admin</div>
              <div style={{ fontSize: 11, color: 'rgba(255,255,255,0.5)' }}>Control Panel</div>
            </div>
          </div>

          <nav style={{ padding: '15px 0' }}>
            {sidebarItems.map((item) => {
              const isActive = pathname === item.href
              return (
                <Link
                  key={item.href}
                  href={item.href}
                  className="sidebar-nav-link"
                  style={{
                    color: isActive ? '#fff' : 'rgba(255,255,255,0.6)',
                    background: isActive ? 'rgba(51,71,176,0.3)' : 'transparent',
                    borderLeftColor: isActive ? '#3347B0' : 'transparent',
                    fontWeight: isActive ? 600 : 400,
                  }}
                >
                  <i className={item.icon} style={{ fontSize: 16, width: 20, textAlign: 'center' }}></i>
                  <span className="sidebar-nav-link-label">{item.label}</span>
                </Link>
              )
            })}
          </nav>

          <div className="sidebar-logout-area">
            <button onClick={handleLogout} className="sidebar-logout-btn">
              <i className="fa fa-sign-out"></i>
              <span className="sidebar-logout-label">Sign Out</span>
            </button>
          </div>
        </aside>

        {/* Main Content */}
        <div className="admin-main">
          {/* Top Header */}
          <header className="admin-header">
            <div style={{ display: 'flex', alignItems: 'center', gap: 15 }}>
              <button
                onClick={() => setSidebarOpen(!sidebarOpen)}
                style={{ background: 'none', border: 'none', cursor: 'pointer', fontSize: 20, color: '#555', padding: 5 }}
              >
                <i className="fa fa-bars"></i>
              </button>
              <h3 style={{ margin: 0, fontSize: 18, color: '#333', fontFamily: "'Oswald', sans-serif" }}>
                {currentPageLabel}
              </h3>
            </div>
            <div className="admin-header-right">
              <a href="/" target="_blank" rel="noopener noreferrer" className="admin-view-site-link" style={{ fontSize: 13, color: '#3347B0' }}>
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
    </>
  )
}
