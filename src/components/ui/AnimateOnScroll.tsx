'use client'
import { useState, useEffect, useCallback } from 'react'

interface AnimateOnScrollProps {
  children: React.ReactNode
  className?: string
  animation?: string
  duration?: string
  style?: React.CSSProperties
}

export function AnimateOnScroll({ children, className = '', animation = 'zoom-in', duration = '0.6s', style }: AnimateOnScrollProps) {
  const [ref, setRef] = useState<HTMLDivElement | null>(null)
  const [isVisible, setIsVisible] = useState(false)

  const callbackRef = useCallback((node: HTMLDivElement | null) => {
    setRef(node)
  }, [])

  useEffect(() => {
    if (!ref) return
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true)
          observer.unobserve(ref)
        }
      },
      { threshold: 0.1, rootMargin: '50px' }
    )
    observer.observe(ref)
    return () => observer.disconnect()
  }, [ref])

  return (
    <div
      ref={callbackRef}
      className={`animate-on-scroll ${animation} ${isVisible ? 'animated' : ''} ${className}`}
      style={{ transitionDuration: duration, ...style }}
    >
      {children}
    </div>
  )
}
