'use client'
import { useState, useEffect, useRef, useCallback } from 'react'
import Link from 'next/link'
import { usePathname } from 'next/navigation'
import { createClient } from '@/lib/supabase/client'
import NepaliDate from 'nepali-date-converter'

const businessHours = '7:00 AM - 7:00 PM'
const facebookHref = 'https://www.facebook.com/p/Fonet-Stationery-Center-100083723779495/'
const dateConverterHref = 'https://merotool.com/date-converter'

const nepaliMonths = [
  'Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashoj', 
  'Kartik', 'Mangsir', 'Poush', 'Magh', 'Fagun', 'Chaitra'
]

export default function Header() {
  const pathname = usePathname()
  const [menuOpen, setMenuOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)
  const [mobileDropdownOpen, setMobileDropdownOpen] = useState(false)

  // Search States
  const [searchOpen, setSearchOpen] = useState(false)
  const [searchQuery, setSearchQuery] = useState('')
  const [searchResults, setSearchResults] = useState<{blogs: any[], services: any[], notices: any[], notes: any[]}>({ blogs: [], services: [], notices: [], notes: [] })
  const [searching, setSearching] = useState(false)
  const searchInputRef = useRef<HTMLInputElement>(null)
  const searchTimerRef = useRef<ReturnType<typeof setTimeout> | null>(null)

  // Date Converter States
  const [mounted, setMounted] = useState(false)
  const [converterOpen, setConverterOpen] = useState(false)
  const [activeTab, setActiveTab] = useState<'ad2bs' | 'bs2ad'>('ad2bs')
  const [todayBS, setTodayBS] = useState('')
  const [todayAD, setTodayAD] = useState('')

  // AD to BS State
  const [adInput, setAdInput] = useState('')
  const [bsOutput, setBsOutput] = useState('')

  // BS to AD State
  const [bsYear, setBsYear] = useState(2081)
  const [bsMonth, setBsMonth] = useState(5) // Ashoj
  const [bsDay, setBsDay] = useState(1)
  const [adOutput, setAdOutput] = useState('')

  useEffect(() => {
    let ticking = false
    const handleScroll = () => {
      if (!ticking) {
        requestAnimationFrame(() => {
          const y = window.scrollY
          setScrolled((prev) => {
            if (!prev && y > 150) return true
            if (prev && y < 50) return false
            return prev
          })
          ticking = false
        })
        ticking = true
      }
    }
    window.addEventListener('scroll', handleScroll, { passive: true })
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  useEffect(() => {
    setMounted(true)
    const today = new Date()
    const nepDate = new NepaliDate(today)
    setTodayBS(nepDate.format('DD MMMM YYYY'))
    setTodayAD(today.toLocaleDateString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' }))
    
    // Set default converter fields to today
    setBsYear(nepDate.getYear())
    setBsMonth(nepDate.getMonth())
    setBsDay(nepDate.getDate())
    
    const adString = today.toISOString().split('T')[0]
    setAdInput(adString)
    setBsOutput(nepDate.format('YYYY MMMM DD, ddd'))
    
    try {
      const adVal = nepDate.toJsDate()
      setAdOutput(adVal.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }))
    } catch (e) {
      setAdOutput('')
    }
  }, [])

  const updateAdOutput = (y: number, m: number, d: number) => {
    try {
      const nep = new NepaliDate(y, m, d)
      const ad = nep.toJsDate()
      setAdOutput(ad.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }))
    } catch (err) {
      setAdOutput('Invalid Date')
    }
  }

  const toggleMenu = () => {
    setMenuOpen(!menuOpen)
  }

  const closeMenu = () => {
    setMenuOpen(false)
    setMobileDropdownOpen(false)
  }

  const toggleMobileDropdown = (e: React.MouseEvent) => {
    e.preventDefault()
    setMobileDropdownOpen(!mobileDropdownOpen)
  }

  const openSearch = () => {
    setSearchOpen(true)
    setTimeout(() => searchInputRef.current?.focus(), 100)
  }

  const closeSearch = () => {
    setSearchOpen(false)
    setSearchQuery('')
    setSearchResults({ blogs: [], services: [], notices: [], notes: [] })
  }

  const handleSearch = useCallback(async (query: string) => {
    if (query.length < 2) {
      setSearchResults({ blogs: [], services: [], notices: [], notes: [] })
      return
    }
    setSearching(true)
    try {
      const supabase = createClient()
      const pattern = `%${query}%`
      const [blogsRes, servicesRes, noticesRes, notesRes] = await Promise.all([
        supabase.from('blog_posts').select('id, title, slug, excerpt').eq('is_published', true).or(`title.ilike.${pattern},excerpt.ilike.${pattern}`).limit(5),
        supabase.from('services').select('id, title, slug, description').eq('is_active', true).or(`title.ilike.${pattern},description.ilike.${pattern}`).limit(5),
        supabase.from('notices_downloads').select('id, title, type').eq('is_active', true).ilike('title', pattern).limit(5),
        supabase.from('notes').select('id, title, subject, class_level, description, content').eq('is_active', true).or(`title.ilike.${pattern},description.ilike.${pattern},content.ilike.${pattern}`).limit(5),
      ])
      setSearchResults({
        blogs: blogsRes.data || [],
        services: servicesRes.data || [],
        notices: noticesRes.data || [],
        notes: notesRes.data || [],
      })
    } catch (err) {
      console.error('Search error:', err)
    }
    setSearching(false)
  }, [])

  const onSearchInput = (val: string) => {
    setSearchQuery(val)
    if (searchTimerRef.current) clearTimeout(searchTimerRef.current)
    searchTimerRef.current = setTimeout(() => handleSearch(val), 300)
  }

  interface NavItem {
    label: string
    href: string
    dropdownItems?: { label: string; href: string }[]
  }

  const navItems: NavItem[] = [
    { label: 'Home', href: '/' },
    { label: 'About Us', href: '/about' },
    { label: 'Services', href: '/services' },
    { label: 'Notary Services', href: '/notary' },
    { label: 'Pricing', href: '/pricing' },
    { label: 'Notice & Downloads', href: '/notices' },
    { label: 'Notes', href: '/notes' },
    { label: 'Gallery', href: '/gallery' },
    { label: 'Videos', href: '/videos' },
    { label: 'Blog', href: '/blog' },
    { label: 'Contact Us', href: '/contact' },
  ]

  // Helper to determine if a route is active
  const isActive = (href: string) => {
    if (href === '#') return false
    if (href === '/') return pathname === '/'
    return pathname.startsWith(href)
  }

  // Helper to determine if the dropdown menu is active (if any child is active)
  const isDropdownActive = (dropdownItems?: { href: string }[]) => {
    if (!dropdownItems) return false
    return dropdownItems.some((item) => pathname === item.href)
  }

  return (
    <>
      {/* Header Top Row (Logo, Date Converter, clock, socials, mobile hamburger) */}
      <header className={`header-top-row-wrapper ${scrolled ? 'scrolled' : ''}`} id="header">
        {/* Top Red Strip */}
        <div className="top-red-strip"></div>

        {/* Header Top Row: Logo & Info */}
        <div className="header-top-row">
        <div className="container">
          <div className="header-top-inner">
            {/* Branding (Logo + Name) */}
            <div className="header-branding">
              <Link href="/" className="logo-link">
                <img 
                  src="/images/fonet logo.PNG" 
                  alt="Fonet Stationary Center" 
                  className="site-logo" 
                />
                <div className="brand-text">
                  <h1 className="brand-name">Fonet Stationary</h1>
                  <p className="brand-slogan">Center</p>
                </div>
              </Link>
            </div>

            {/* Center: Live Nepali Date Converter Directly */}
            <div className="header-date-converter-direct">
              <div className="converter-label-inline">
                <i className="fa fa-calendar-check-o icon"></i>
                <span>Date Converter</span>
              </div>

              {mounted ? (
                <>
                  <div className="converter-mode-toggle">
                    <button 
                      className={`mode-btn ${activeTab === 'ad2bs' ? 'active' : ''}`}
                      onClick={() => setActiveTab('ad2bs')}
                      type="button"
                    >
                      AD to BS
                    </button>
                    <button 
                      className={`mode-btn ${activeTab === 'bs2ad' ? 'active' : ''}`}
                      onClick={() => setActiveTab('bs2ad')}
                      type="button"
                    >
                      BS to AD
                    </button>
                  </div>

                  <div className="converter-inputs-inline">
                    {activeTab === 'ad2bs' ? (
                      <div className="inline-input-group">
                        <input 
                          type="date" 
                          value={adInput}
                          className="inline-input-field"
                          onChange={(e) => {
                            setAdInput(e.target.value)
                            if (e.target.value) {
                              try {
                                const d = new Date(e.target.value)
                                const nep = new NepaliDate(d)
                                setBsOutput(nep.format('YYYY MMMM DD, ddd'))
                              } catch (err) {
                                setBsOutput('Invalid Date')
                              }
                            } else {
                              setBsOutput('')
                            }
                          }}
                        />
                        {bsOutput && (
                          <div className="inline-result-badge" title={bsOutput}>
                            <span className="result-prefix">BS:</span>
                            <span className="result-val">{bsOutput}</span>
                          </div>
                        )}
                      </div>
                    ) : (
                      <div className="inline-input-group">
                        <div className="inline-selects">
                          <select 
                            value={bsYear}
                            className="inline-select-field year-select"
                            onChange={(e) => {
                              const y = Number(e.target.value)
                              setBsYear(y)
                              updateAdOutput(y, bsMonth, bsDay)
                            }}
                          >
                            {Array.from({ length: 91 }, (_, i) => 2000 + i).map(y => (
                              <option key={y} value={y}>{y}</option>
                            ))}
                          </select>
                          
                          <select 
                            value={bsMonth}
                            className="inline-select-field month-select"
                            onChange={(e) => {
                              const m = Number(e.target.value)
                              setBsMonth(m)
                              updateAdOutput(bsYear, m, bsDay)
                            }}
                          >
                            {nepaliMonths.map((m, idx) => (
                              <option key={idx} value={idx}>{m}</option>
                            ))}
                          </select>
                          
                          <select 
                            value={bsDay}
                            className="inline-select-field day-select"
                            onChange={(e) => {
                              const d = Number(e.target.value)
                              setBsDay(d)
                              updateAdOutput(bsYear, bsMonth, d)
                            }}
                          >
                            {Array.from({ length: 32 }, (_, i) => 1 + i).map(d => (
                              <option key={d} value={d}>{d}</option>
                            ))}
                          </select>
                        </div>
                        {adOutput && (
                          <div className="inline-result-badge" title={adOutput}>
                            <span className="result-prefix">AD:</span>
                            <span className="result-val">{adOutput}</span>
                          </div>
                        )}
                      </div>
                    )}
                  </div>
                </>
              ) : (
                <div className="converter-skeleton-loader"></div>
              )}
            </div>

            {/* Top Right: Clock & Header Links */}
            <div className="header-info-socials">
              <div className="header-info-item">
                <i className="fa fa-clock-o" aria-hidden="true"></i>
                <span>{businessHours}</span>
              </div>
              <span className="separator">|</span>
              <div className="header-socials">
                <a
                  href={facebookHref}
                  className="header-social-icon"
                  title="Facebook"
                  aria-label="Fonet Stationary Center on Facebook"
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  <i className="fa fa-facebook" aria-hidden="true"></i>
                </a>
              </div>
            </div>

            {/* Mobile Hamburger (Moves to top-right on mobile) */}
            <div
              className={`hamburger-menus-custom ${menuOpen ? 'active' : ''}`}
              onClick={toggleMenu}
            >
              <span></span>
              <span></span>
              <span></span>
            </div>
            </div>
          </div>
        </div>
      </header>

      {/* Header Navigation Row (Capsule Menu) */}
      <div className={`header-nav-row-wrapper ${scrolled ? 'scrolled' : ''}`}>
        <div className="header-nav-row">
          <div className="container">
          <div className="nav-container-pill">
            <nav className="navigation-custom">
              <ul className="mainmenu-custom">
                {navItems.map((item) => {
                  const hasDropdown = !!item.dropdownItems
                  const active = hasDropdown 
                    ? isDropdownActive(item.dropdownItems) 
                    : isActive(item.href)

                  if (item.dropdownItems) {
                    return (
                      <li 
                        key={item.label} 
                        className={`menu-item-has-children ${active ? 'active' : ''}`}
                      >
                        <Link href={item.href} onClick={(e) => e.preventDefault()}>
                          {item.label} <i className="fa fa-caret-down" aria-hidden="true"></i>
                        </Link>
                        <ul className="dropdown-submenu">
                          {item.dropdownItems.map((subItem) => (
                            <li key={subItem.href} className={pathname === subItem.href ? 'active' : ''}>
                              <Link href={subItem.href} onClick={closeMenu}>
                                {subItem.label}
                              </Link>
                            </li>
                          ))}
                        </ul>
                      </li>
                    )
                  }

                  return (
                    <li key={item.href} className={active ? 'active' : ''}>
                      <Link href={item.href} onClick={closeMenu}>
                        {item.label}
                      </Link>
                    </li>
                  )
                })}
              </ul>
            </nav>
            <button
              className="nav-search-btn"
              onClick={openSearch}
              aria-label="Search"
              style={{
                background: 'rgba(255,255,255,0.15)',
                border: 'none',
                borderRadius: '50%',
                width: 36,
                height: 36,
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                cursor: 'pointer',
                marginLeft: 8,
                flexShrink: 0,
                transition: 'background 0.3s',
              }}
            >
              <i className="fa fa-search" style={{ color: '#fff', fontSize: 15 }}></i>
            </button>
          </div>
        </div>
      </div>

      {/* Search Overlay */}
      {searchOpen && (
        <div className="search-overlay" onClick={closeSearch}>
          <div className="search-overlay-content" onClick={e => e.stopPropagation()}>
            <button className="search-close-btn" onClick={closeSearch}>&times;</button>
            <div className="search-input-wrapper">
              <i className="fa fa-search search-input-icon"></i>
              <input
                ref={searchInputRef}
                type="text"
                placeholder="Search services, notes, blogs, notices..."
                value={searchQuery}
                onChange={e => onSearchInput(e.target.value)}
                className="search-input"
              />
            </div>
            {searching && <div style={{ textAlign: 'center', padding: 20, color: '#888' }}>Searching...</div>}
            {!searching && searchQuery.length >= 2 && (
              <div className="search-results">
                {searchResults.services.length > 0 && (
                  <div className="search-results-group">
                    <h5 className="search-group-title"><i className="fa fa-cogs"></i> Services</h5>
                    {searchResults.services.map((s: any) => (
                      <Link key={s.id} href={`/services/${s.slug}`} className="search-result-item" onClick={closeSearch}>
                        <strong>{s.title}</strong>
                        {s.description && <span>{s.description.substring(0, 80)}...</span>}
                      </Link>
                    ))}
                  </div>
                )}
                {searchResults.blogs.length > 0 && (
                  <div className="search-results-group">
                    <h5 className="search-group-title"><i className="fa fa-newspaper-o"></i> Blog Posts</h5>
                    {searchResults.blogs.map((b: any) => (
                      <Link key={b.id} href={`/blog/${b.slug}`} className="search-result-item" onClick={closeSearch}>
                        <strong>{b.title}</strong>
                        {b.excerpt && <span>{b.excerpt.substring(0, 80)}...</span>}
                      </Link>
                    ))}
                  </div>
                )}
                {searchResults.notices.length > 0 && (
                  <div className="search-results-group">
                    <h5 className="search-group-title"><i className="fa fa-bell"></i> Notices</h5>
                    {searchResults.notices.map((n: any) => (
                      <Link key={n.id} href="/notices" className="search-result-item" onClick={closeSearch}>
                        <strong>{n.title}</strong>
                        <span className="search-result-badge">{n.type}</span>
                      </Link>
                    ))}
                  </div>
                )}
                {searchResults.notes && searchResults.notes.length > 0 && (
                  <div className="search-results-group">
                    <h5 className="search-group-title"><i className="fa fa-book"></i> Academic Notes</h5>
                    {searchResults.notes.map((n: any) => (
                      <Link key={n.id} href={`/notes?search=${encodeURIComponent(searchQuery)}`} className="search-result-item" onClick={closeSearch}>
                        <strong>{n.title}</strong>
                        {n.subject && <span style={{ fontSize: 12, color: '#666', marginTop: 4, display: 'block' }}>{n.subject} ({n.class_level || 'All Levels'})</span>}
                        {n.description && <span style={{ fontSize: 12, color: '#777', display: 'block', marginTop: 2 }}>{n.description.substring(0, 80)}...</span>}
                      </Link>
                    ))}
                  </div>
                )}
                {searchResults.blogs.length === 0 && searchResults.services.length === 0 && searchResults.notices.length === 0 && (!searchResults.notes || searchResults.notes.length === 0) && (
                  <div style={{ textAlign: 'center', padding: 30, color: '#888' }}>
                    <i className="fa fa-search" style={{ fontSize: 24, marginBottom: 10, display: 'block', opacity: 0.5 }}></i>
                    No results found for &ldquo;{searchQuery}&rdquo;
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      )}

    </div>

    {/* Mobile Menu Drawer Overlay */}
    <div
      className={`overlaybg-custom ${menuOpen ? 'active' : ''}`}
      onClick={closeMenu}
    ></div>

    {/* Mobile Drawer Menu Content */}
    <div className={`menu-wrapper-custom ${menuOpen ? 'active' : ''}`}>
      <div className="mobile-menu-header">
        <img 
          src="/images/fonet logo.PNG" 
          alt="Fonet Stationary Center" 
          className="mobile-menu-logo" 
        />
        <button className="mobile-menu-close" onClick={closeMenu}>&times;</button>
      </div>
      {/* Mobile Search Bar */}
      <div className="mobile-drawer-search" onClick={() => { closeMenu(); setTimeout(() => openSearch(), 200); }}>
        <i className="fa fa-search mobile-drawer-search-icon"></i>
        <span className="mobile-drawer-search-text">Search services, notes, blogs...</span>
      </div>
      <ul className="mobile-mainmenu">
        {navItems.map((item) => {
          const hasDropdown = !!item.dropdownItems
          const active = hasDropdown 
            ? isDropdownActive(item.dropdownItems) 
            : isActive(item.href)

          if (item.dropdownItems) {
            return (
              <li key={item.label} className={`mobile-menu-item-has-children ${active ? 'active' : ''}`}>
                <a href="#" onClick={toggleMobileDropdown} className="mobile-dropdown-toggle">
                  {item.label} 
                  <i className={`fa ${mobileDropdownOpen ? 'fa-caret-up' : 'fa-caret-down'}`} aria-hidden="true"></i>
                </a>
                <ul className={`mobile-dropdown-submenu ${mobileDropdownOpen ? 'open' : ''}`}>
                  {item.dropdownItems.map((subItem) => (
                    <li key={subItem.href} className={pathname === subItem.href ? 'active' : ''}>
                      <Link href={subItem.href} onClick={closeMenu}>
                        {subItem.label}
                      </Link>
                    </li>
                  ))}
                </ul>
              </li>
            )
          }

          return (
            <li key={item.href} className={active ? 'active' : ''}>
              <Link href={item.href} onClick={closeMenu}>
                {item.label}
              </Link>
            </li>
          )
        })}
      </ul>
      <div className="mobile-menu-footer">
        <div className="mobile-info-item">
          <i className="fa fa-clock-o" aria-hidden="true"></i>
          <span>{businessHours}</span>
        </div>
        <div className="mobile-socials">
          <a
            href={facebookHref}
            className="header-social-icon"
            aria-label="Fonet Stationary Center on Facebook"
            target="_blank"
            rel="noopener noreferrer"
          >
            <i className="fa fa-facebook" aria-hidden="true"></i>
          </a>

        </div>
      </div>
    </div>
  </>
)
}
