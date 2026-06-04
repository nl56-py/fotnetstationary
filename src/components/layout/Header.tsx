'use client'
import { useState, useEffect } from 'react'
import Link from 'next/link'
import { usePathname } from 'next/navigation'

export default function Header() {
  const pathname = usePathname()
  const [menuOpen, setMenuOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)
  const [mobileDropdownOpen, setMobileDropdownOpen] = useState(false)

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 50)
    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

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

  interface NavItem {
    label: string
    href: string
    dropdownItems?: { label: string; href: string }[]
  }

  const navItems: NavItem[] = [
    { label: 'Home', href: '/' },
    { label: 'About Us', href: '/about' },
    { label: 'Services', href: '/services' },
    { label: 'Pricing', href: '/pricing' },
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
    <header className={`site-header-custom ${scrolled ? 'scrolled' : ''}`} id="header">
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

            {/* Top Right: Clock & Social Icons */}
            <div className="header-info-socials">
              <div className="header-info-item">
                <i className="fa fa-clock-o" aria-hidden="true"></i>
                <span>10-00.AM 6.00.PM</span>
              </div>
              <span className="separator">|</span>
              <div className="header-socials">
                <a href="https://facebook.com/" title="Facebook" target="_blank" rel="noopener noreferrer">
                  <i className="fa fa-facebook"></i>
                </a>
                <a href="https://instagram.com/" title="Instagram" target="_blank" rel="noopener noreferrer">
                  <i className="fa fa-instagram"></i>
                </a>
                <a href="https://twitter.com/" title="Twitter" target="_blank" rel="noopener noreferrer">
                  <i className="fa fa-twitter"></i>
                </a>
                <a href="https://youtube.com/" title="Youtube" target="_blank" rel="noopener noreferrer">
                  <i className="fa fa-youtube-play"></i>
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

      {/* Header Navigation Row (Capsule Menu) */}
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
          </div>
        </div>
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
            <span>10-00.AM 6.00.PM</span>
          </div>
          <div className="mobile-socials">
            <a href="https://facebook.com/" target="_blank" rel="noopener noreferrer"><i className="fa fa-facebook"></i></a>
            <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer"><i className="fa fa-instagram"></i></a>
            <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer"><i className="fa fa-twitter"></i></a>
            <a href="https://youtube.com/" target="_blank" rel="noopener noreferrer"><i className="fa fa-youtube-play"></i></a>
          </div>
        </div>
      </div>
    </header>
  )
}
