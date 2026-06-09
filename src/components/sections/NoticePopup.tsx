'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'

export default function NoticePopup() {
  const [isOpen, setIsOpen] = useState(false)
  const [noticeText, setNoticeText] = useState('')
  const [noticeImageUrl, setNoticeImageUrl] = useState('')

  useEffect(() => {
    async function checkNotice() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('site_settings')
          .select('key, value')
          .in('key', ['banner_notice_active', 'banner_notice_text', 'banner_notice_image_url'])

        if (error) throw error

        const activeSetting = data?.find((s) => s.key === 'banner_notice_active')
        const textSetting = data?.find((s) => s.key === 'banner_notice_text')
        const imageSetting = data?.find((s) => s.key === 'banner_notice_image_url')

        if (activeSetting && activeSetting.value === 'true' && textSetting && textSetting.value) {
          const text = textSetting.value
          setNoticeText(text)
          if (imageSetting && imageSetting.value) {
            setNoticeImageUrl(imageSetting.value)
          }

          // Check localStorage to see if user dismissed it recently
          const lastDismissed = localStorage.getItem('fonet_notice_dismissed_time')
          const savedText = localStorage.getItem('fonet_notice_dismissed_text')
          
          if (lastDismissed && savedText === text) {
            const timeDiff = Date.now() - parseInt(lastDismissed)
            const twentyFourHours = 24 * 60 * 60 * 1000
            if (timeDiff < twentyFourHours) {
              // Dismissed within last 24 hours, don't show
              return
            }
          }
          
          // Show popup after a short delay (1.5 seconds)
          const timer = setTimeout(() => {
            setIsOpen(true)
          }, 1500)
          return () => clearTimeout(timer)
        }
      } catch (err) {
        console.error('Failed to load popup banner setting', err)
      }
    }
    checkNotice()
  }, [])

  const handleClose = () => {
    setIsOpen(false)
    localStorage.setItem('fonet_notice_dismissed_time', Date.now().toString())
    localStorage.setItem('fonet_notice_dismissed_text', noticeText)
  }

  if (!isOpen) return null

  return (
    <div className="notice-popup-overlay" onClick={handleClose}>
      <div className="notice-popup-content animate__animated animate__zoomIn" onClick={(e) => e.stopPropagation()}>
        <button className="notice-popup-close-btn" onClick={handleClose}>
          &times;
        </button>
        <div className="notice-popup-header">
          <div className="notice-bell-container">
            <i className="fa fa-bell-o notice-bell-icon"></i>
          </div>
          <h3>IMPORTANT NOTICE</h3>
        </div>
        <div className="notice-popup-body">
          <p className="notice-popup-text">{noticeText}</p>
          {noticeImageUrl && (
            <div className="notice-popup-media">
              {noticeImageUrl.toLowerCase().split('?')[0].endsWith('.pdf') ? (
                <a
                  href={noticeImageUrl}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="notice-pdf-button"
                >
                  <i className="fa fa-file-pdf-o"></i> View Attached PDF Document
                </a>
              ) : (
                <img
                  src={noticeImageUrl}
                  alt="Announcement banner"
                  className="notice-popup-img"
                />
              )}
            </div>
          )}
        </div>
        <div className="notice-popup-footer">
          <button className="notice-popup-action-btn" onClick={handleClose}>
            Acknowledge & Close
          </button>
        </div>
      </div>
    </div>
  )
}
