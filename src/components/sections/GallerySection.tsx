'use client'
import { useState, useEffect } from 'react'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'
import { createClient } from '@/lib/supabase/client'
import { getImageSrc } from '@/lib/media-helper'

interface GalleryItem {
  id: string | number
  image_url: string
  category: string
  title: string | null
}

const defaultGalleryImages = [
  { id: 1, image_url: '/images/gallery.jpg', category: 'Printing', title: 'Printing Service' },
  { id: 2, image_url: '/images/projects.jpg', category: 'Photocopy', title: 'Photocopy Center' },
  { id: 3, image_url: '/images/gallery.jpg', category: 'Printing', title: 'Document Print' },
  { id: 4, image_url: '/images/projects.jpg', category: 'Products', title: 'Custom Products' },
  { id: 5, image_url: '/images/gallery.jpg', category: 'Stationary', title: 'Stationary Items' },
  { id: 6, image_url: '/images/projects.jpg', category: 'Printing', title: 'Flex Banner' },
]

export default function GallerySection() {
  const [items, setItems] = useState<GalleryItem[]>([])
  const [categories, setCategories] = useState<string[]>(['All'])
  const [activeFilter, setActiveFilter] = useState('All')
  const [loading, setLoading] = useState(true)
  
  // Lightbox state
  const [lightboxIndex, setLightboxIndex] = useState<number | null>(null)

  useEffect(() => {
    async function fetchGallery() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('gallery_images')
          .select('*')
          .eq('is_active', true)
          .order('sort_order', { ascending: true })

        if (error) throw error

        if (data && data.length > 0) {
          const formatted = data.map((item: any) => ({
            id: item.id,
            image_url: item.image_url,
            category: item.category || 'General',
            title: item.title,
          }))
          setItems(formatted)
          
          // Generate unique categories dynamically
          const cats = ['All', ...Array.from(new Set(formatted.map((img: any) => img.category)))] as string[]
          setCategories(cats)
        } else {
          // Fallback to defaults
          setItems(defaultGalleryImages)
          const cats = ['All', ...Array.from(new Set(defaultGalleryImages.map(img => img.category)))]
          setCategories(cats)
        }
      } catch (err) {
        console.error('Error fetching gallery images', err)
        // Fallback on error
        setItems(defaultGalleryImages)
        const cats = ['All', ...Array.from(new Set(defaultGalleryImages.map(img => img.category)))]
        setCategories(cats)
      } finally {
        setLoading(false)
      }
    }

    fetchGallery()
  }, [])

  const filtered = activeFilter === 'All'
    ? items
    : items.filter((img) => img.category === activeFilter)

  const handleOpenLightbox = (index: number) => {
    setLightboxIndex(index)
  }

  const handleCloseLightbox = () => {
    setLightboxIndex(null)
  }

  const handlePrevImage = (e: React.MouseEvent) => {
    e.stopPropagation()
    if (lightboxIndex === null) return
    setLightboxIndex(lightboxIndex === 0 ? filtered.length - 1 : lightboxIndex - 1)
  }

  const handleNextImage = (e: React.MouseEvent) => {
    e.stopPropagation()
    if (lightboxIndex === null) return
    setLightboxIndex(lightboxIndex === filtered.length - 1 ? 0 : lightboxIndex + 1)
  }

  if (loading) {
    return (
      <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: '300px' }}>
        <div className="spinner"></div>
      </div>
    )
  }

  return (
    <div id="cb-sec3">
      <section id="gallery" style={{ padding: '60px 0' }}>
        <div className="container">
          <div className="head_white head_center" style={{ marginBottom: 40 }}>
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">PRODUCT</div>
              <h2>GALLERY</h2>
            </div>
          </div>

          {/* Category filter */}
          <div className="gallery-filters" style={{ display: 'flex', justifyContent: 'center', gap: 10, flexWrap: 'wrap', marginBottom: 40 }}>
            {categories.map((cat) => (
              <button
                key={cat}
                className={activeFilter === cat ? 'active' : ''}
                onClick={() => setActiveFilter(cat)}
                style={{
                  padding: '8px 20px',
                  borderRadius: '30px',
                  border: '1px solid #3347B0',
                  background: activeFilter === cat ? '#3347B0' : 'transparent',
                  color: activeFilter === cat ? '#fff' : '#3347B0',
                  cursor: 'pointer',
                  fontSize: 14,
                  fontWeight: 600,
                  transition: 'all 0.3s ease',
                  boxShadow: activeFilter === cat ? '0 4px 15px rgba(51, 71, 176, 0.3)' : 'none'
                }}
              >
                {cat}
              </button>
            ))}
          </div>

          <div id="image-gallery">
            <div className="row" style={{ display: 'flex', flexWrap: 'wrap' }}>
              {filtered.map((image, idx) => (
                <AnimateOnScroll
                  key={image.id}
                  className="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 portfolio_item_post"
                  style={{ marginBottom: 30 }}
                >
                  <div className="item_content" style={{ cursor: 'pointer' }} onClick={() => handleOpenLightbox(idx)}>
                    <div className="img-wrapper post_media" style={{ borderRadius: 12, overflow: 'hidden', boxShadow: '0 4px 15px rgba(0,0,0,0.06)', position: 'relative' }}>
                      <img 
                        src={getImageSrc(image.image_url)} 
                        alt={image.title || 'Gallery Image'} 
                        style={{ width: '100%', height: 250, objectFit: 'cover', transition: 'transform 0.5s ease' }}
                        className="gallery-item-image"
                      />
                      <div className="img-overlay">
                        <div className="cwsportfolio_content_wrap">
                          <div className="hover-effect">
                            <i className="fa fa-search-plus" style={{ fontSize: 24, color: '#fff' }}></i>
                          </div>
                          <div style={{ position: 'absolute', bottom: 15, left: 15, right: 15, color: '#fff', zIndex: 10 }}>
                            <h4 style={{ margin: 0, fontSize: 16, fontWeight: 700, fontFamily: "'Oswald', sans-serif" }}>{image.title || 'Gallery View'}</h4>
                            <span style={{ fontSize: 12, opacity: 0.8, textTransform: 'uppercase', letterSpacing: 1 }}>{image.category}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </AnimateOnScroll>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Lightbox Overlay */}
      {lightboxIndex !== null && (
        <div 
          onClick={handleCloseLightbox}
          style={{
            position: 'fixed',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: 'rgba(0,0,0,0.92)',
            zIndex: 9999,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            flexDirection: 'column',
            padding: 20,
            animation: 'fadeIn 0.3s ease'
          }}
        >
          {/* Close Button */}
          <button 
            onClick={handleCloseLightbox}
            style={{
              position: 'absolute',
              top: 20,
              right: 25,
              background: 'transparent',
              border: 'none',
              color: '#fff',
              fontSize: 35,
              cursor: 'pointer',
              zIndex: 10001,
              transition: 'color 0.2s'
            }}
          >
            &times;
          </button>

          {/* Prev Button */}
          <button 
            onClick={handlePrevImage}
            style={{
              position: 'absolute',
              left: 20,
              top: '50%',
              transform: 'translateY(-50%)',
              background: 'rgba(255,255,255,0.1)',
              border: 'none',
              borderRadius: '50%',
              width: 50,
              height: 50,
              color: '#fff',
              fontSize: 20,
              cursor: 'pointer',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              zIndex: 10001,
              transition: 'background 0.3s'
            }}
          >
            <i className="fa fa-chevron-left"></i>
          </button>

          {/* Image Container */}
          <div 
            onClick={(e) => e.stopPropagation()}
            style={{
              position: 'relative',
              maxWidth: '85%',
              maxHeight: '75%',
              display: 'flex',
              flexDirection: 'column',
              alignItems: 'center'
            }}
          >
            <img 
              src={getImageSrc(filtered[lightboxIndex].image_url)} 
              alt={filtered[lightboxIndex].title || ''} 
              style={{
                maxWidth: '100%',
                maxHeight: '70vh',
                objectFit: 'contain',
                borderRadius: 8,
                boxShadow: '0 10px 30px rgba(0,0,0,0.5)'
              }}
            />
            <div style={{ marginTop: 15, textAlign: 'center', color: '#fff' }}>
              <h3 style={{ margin: '0 0 5px 0', fontSize: 20, fontFamily: "'Oswald', sans-serif" }}>
                {filtered[lightboxIndex].title || 'Untitled'}
              </h3>
              <p style={{ margin: 0, fontSize: 13, color: '#aaa', textTransform: 'uppercase', letterSpacing: 1.5 }}>
                {filtered[lightboxIndex].category}
              </p>
            </div>
          </div>

          {/* Next Button */}
          <button 
            onClick={handleNextImage}
            style={{
              position: 'absolute',
              right: 20,
              top: '50%',
              transform: 'translateY(-50%)',
              background: 'rgba(255,255,255,0.1)',
              border: 'none',
              borderRadius: '50%',
              width: 50,
              height: 50,
              color: '#fff',
              fontSize: 20,
              cursor: 'pointer',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              zIndex: 10001,
              transition: 'background 0.3s'
            }}
          >
            <i className="fa fa-chevron-right"></i>
          </button>

          {/* Index Counter */}
          <div style={{ position: 'absolute', bottom: 20, color: '#888', fontSize: 14 }}>
            {lightboxIndex + 1} / {filtered.length}
          </div>
        </div>
      )}
    </div>
  )
}
