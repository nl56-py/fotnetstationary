'use client'
import { useState, useEffect, useCallback, type ReactNode } from 'react'
import { createClient } from '@/lib/supabase/client'

export default function HeroSlider() {
  const [currentSlide, setCurrentSlide] = useState(0)
  const [heroImage, setHeroImage] = useState('/images/slider1.jpg')

  const slides = [
    {
      image: heroImage,
      title: <><span className="text-white">FONET</span>{'\n'}<span className="text-yellow">STATIONARY</span>{'\n'}<span className="text-blue">CENTER</span></>,
      altText: 'Fonet Stationary Center',
      subtitle: 'Your one-stop solution for printing, photocopy, typing, and all stationary needs in Bharatpur, Chitwan.',
      btn1: { text: 'Contact Us', link: '/contact' },
      btn2: { text: 'About Us', link: '/about' },
    },
    {
      image: heroImage,
      title: <><span className="text-white">BEST PRINTING.</span>{'\n'}<span className="text-yellow">BEST COST</span></>,
      altText: 'Best Printing Best Cost',
      subtitle: 'Professional thesis typing, document printing, lamination, flex print, visiting cards, and more at affordable prices.',
      btn1: { text: 'Our Services', link: '/services' },
      btn2: { text: 'View Pricing', link: '/pricing' },
    },
    {
      image: heroImage,
      title: <><span className="text-white">TODAY WRITE&apos;S</span>{'\n'}<span className="text-blue">FOR TOMORROW</span></>,
      altText: 'Today Writes For Tomorrow',
      subtitle: 'Established in 2070 B.S., serving students and businesses across Chitwan with quality and quick service.',
      btn1: { text: 'Book Now', link: '/contact' },
      btn2: { text: 'Gallery', link: '/gallery' },
    },
  ]

  const nextSlide = useCallback(() => {
    setCurrentSlide((prev) => (prev + 1) % slides.length)
  }, [slides.length])

  const prevSlide = () => {
    setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length)
  }

  useEffect(() => {
    const timer = setInterval(nextSlide, 5000)
    return () => clearInterval(timer)
  }, [nextSlide])

  useEffect(() => {
    async function fetchHeroImage() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('site_settings')
          .select('value')
          .eq('key', 'hero_background_image_url')
          .maybeSingle()

        if (!error && data?.value) {
          setHeroImage(data.value)
        }
      } catch (err) {
        console.error('Unable to load hero background setting', err)
      }
    }

    fetchHeroImage()
  }, [])

  return (
    <div className="slider_section" id="slider">
      <div className="owl-slider">
        <div style={{ position: 'relative', overflow: 'hidden' }}>
          {slides.map((slide, idx) => (
            <div
              key={idx}
              className="item"
              style={{
                display: idx === currentSlide ? 'block' : 'none',
                position: 'relative',
              }}
            >
              <div className="slider_gradiant"></div>
              <img
                className="slide-mainimg"
                alt={slide.altText}
                src={slide.image}
              />
              <div className="carousel-caption">
                <div className="title" style={{ whiteSpace: 'pre-line' }}>
                  {slide.title}
                </div>
                <div className="clearfix"></div>
                <div className="sub-title">{slide.subtitle}</div>
                <div className="slide-btna">
                  <div className="btn5">
                    <a href={slide.btn1.link}>{slide.btn1.text}</a>
                  </div>
                  <div className="btn5">
                    <a href={slide.btn2.link}>{slide.btn2.text}</a>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
        {/* Navigation */}
        <div className="slider-nav">
          <button onClick={prevSlide} aria-label="Previous slide">
            <i className="fa fa-arrow-left"></i>
          </button>
          <button onClick={nextSlide} aria-label="Next slide">
            <i className="fa fa-arrow-right"></i>
          </button>
        </div>
        {/* Dots */}
        <div className="slider-dots">
          {slides.map((_, idx) => (
            <span
              key={idx}
              className={idx === currentSlide ? 'active' : ''}
              onClick={() => setCurrentSlide(idx)}
            ></span>
          ))}
        </div>
      </div>
    </div>
  )
}
