'use client'
import { useEffect, useState, useCallback } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { PopupBanner } from '@/lib/types'

const DISMISS_STORAGE_KEY = 'fonet_popup_banners_dismissed'
const DISMISS_EXPIRY_MS = 24 * 60 * 60 * 1000 // 24 hours

interface DismissedRecord {
  [bannerId: string]: number // timestamp when dismissed
}

function getDismissedBanners(): DismissedRecord {
  try {
    const raw = localStorage.getItem(DISMISS_STORAGE_KEY)
    if (!raw) return {}
    const parsed: DismissedRecord = JSON.parse(raw)
    // Clean up expired entries
    const now = Date.now()
    const cleaned: DismissedRecord = {}
    for (const [id, time] of Object.entries(parsed)) {
      if (now - time < DISMISS_EXPIRY_MS) {
        cleaned[id] = time
      }
    }
    return cleaned
  } catch {
    return {}
  }
}

function dismissBanner(bannerId: string) {
  const dismissed = getDismissedBanners()
  dismissed[bannerId] = Date.now()
  localStorage.setItem(DISMISS_STORAGE_KEY, JSON.stringify(dismissed))
}

export default function NoticePopup() {
  const [banners, setBanners] = useState<PopupBanner[]>([])
  const [currentIndex, setCurrentIndex] = useState(0)
  const [isOpen, setIsOpen] = useState(false)
  const [animClass, setAnimClass] = useState('animate__zoomIn')

  useEffect(() => {
    async function loadBanners() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('popup_banners')
          .select('*')
          .eq('is_active', true)
          .order('sort_order', { ascending: true })

        if (error) throw error
        if (!data || data.length === 0) return

        // Filter out already-dismissed banners
        const dismissed = getDismissedBanners()
        const undismissed = data.filter(b => !dismissed[b.id])

        if (undismissed.length === 0) return

        setBanners(undismissed)
        setCurrentIndex(0)

        // Show first banner after a short delay
        const timer = setTimeout(() => {
          setIsOpen(true)
        }, 1500)
        return () => clearTimeout(timer)
      } catch (err) {
        console.error('Failed to load popup banners', err)
      }
    }
    loadBanners()
  }, [])

  const handleClose = useCallback(() => {
    const currentBanner = banners[currentIndex]
    if (currentBanner) {
      dismissBanner(currentBanner.id)
    }

    // Check if there's a next banner
    const nextIndex = currentIndex + 1
    if (nextIndex < banners.length) {
      // Animate out, then show next
      setAnimClass('animate__zoomOut')
      setTimeout(() => {
        setCurrentIndex(nextIndex)
        setAnimClass('animate__zoomIn')
      }, 300)
    } else {
      // No more banners, close the overlay
      setAnimClass('animate__zoomOut')
      setTimeout(() => {
        setIsOpen(false)
      }, 300)
    }
  }, [banners, currentIndex])

  if (!isOpen || banners.length === 0) return null

  const banner = banners[currentIndex]
  if (!banner) return null

  const totalCount = banners.length
  const currentNumber = currentIndex + 1

  return (
    <div className="notice-popup-overlay" onClick={handleClose}>
      <div
        className={`notice-popup-content animate__animated ${animClass}`}
        onClick={(e) => e.stopPropagation()}
      >
        <button className="notice-popup-close-btn" onClick={handleClose}>
          &times;
        </button>

        <div className="notice-popup-header">
          <div className="notice-bell-container">
            <i className="fa fa-bell-o notice-bell-icon"></i>
          </div>
          <h3>{banner.title || 'IMPORTANT NOTICE'}</h3>
        </div>

        <div className="notice-popup-body">
          {banner.content && (
            <p className="notice-popup-text">{banner.content}</p>
          )}
          {banner.image_url && (
            <div className="notice-popup-media">
              {banner.image_url.toLowerCase().split('?')[0].endsWith('.pdf') ? (
                <a
                  href={banner.image_url}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="notice-pdf-button"
                >
                  <i className="fa fa-file-pdf-o"></i> View Attached PDF Document
                </a>
              ) : (
                <img
                  src={banner.image_url}
                  alt={banner.title || 'Announcement banner'}
                  className="notice-popup-img"
                />
              )}
            </div>
          )}
        </div>

        <div className="notice-popup-footer">
          {totalCount > 1 && (
            <div className="notice-popup-counter">
              <span>{currentNumber}</span> of <span>{totalCount}</span> announcements
            </div>
          )}
          <button className="notice-popup-action-btn" onClick={handleClose}>
            {currentNumber < totalCount ? 'Next Announcement' : 'Acknowledge & Close'}
            {currentNumber < totalCount && (
              <i className="fa fa-arrow-right" style={{ marginLeft: 8, fontSize: 12 }}></i>
            )}
          </button>
        </div>
      </div>
    </div>
  )
}
