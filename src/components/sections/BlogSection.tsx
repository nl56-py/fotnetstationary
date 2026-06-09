'use client'
import { useState, useEffect, useRef } from 'react'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'
import { createClient } from '@/lib/supabase/client'
import Link from 'next/link'

interface BlogPostData {
  id: string
  title: string
  slug: string
  excerpt: string | null
  featured_image: string | null
  author: string
  created_at: string
}

export default function BlogSection() {
  const [posts, setPosts] = useState<BlogPostData[]>([])
  const [loading, setLoading] = useState(true)
  const scrollRef = useRef<HTMLDivElement>(null)
  const [canScrollLeft, setCanScrollLeft] = useState(false)
  const [canScrollRight, setCanScrollRight] = useState(false)

  useEffect(() => {
    async function fetchBlogs() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('blog_posts')
          .select('id, title, slug, excerpt, featured_image, author, created_at')
          .eq('is_published', true)
          .order('created_at', { ascending: false })
          .limit(9)

        if (error) throw error
        setPosts(data || [])
      } catch (err) {
        console.error('Error fetching blog posts:', err)
      } finally {
        setLoading(false)
      }
    }
    fetchBlogs()
  }, [])

  const checkScroll = () => {
    const el = scrollRef.current
    if (!el) return
    setCanScrollLeft(el.scrollLeft > 10)
    setCanScrollRight(el.scrollLeft < el.scrollWidth - el.clientWidth - 10)
  }

  useEffect(() => {
    checkScroll()
    const el = scrollRef.current
    if (el) {
      el.addEventListener('scroll', checkScroll, { passive: true })
      window.addEventListener('resize', checkScroll)
      return () => {
        el.removeEventListener('scroll', checkScroll)
        window.removeEventListener('resize', checkScroll)
      }
    }
  }, [posts])

  const scrollBy = (dir: 'left' | 'right') => {
    const el = scrollRef.current
    if (!el) return
    const cardWidth = el.querySelector('.blog-scroll-card')?.clientWidth || 350
    el.scrollBy({ left: dir === 'left' ? -cardWidth - 20 : cardWidth + 20, behavior: 'smooth' })
  }

  if (loading) {
    return (
      <div className="blog-area" id="blog">
        <div className="container">
          <div style={{ display: 'flex', justifyContent: 'center', padding: 40 }}>
            <div className="spinner"></div>
          </div>
        </div>
      </div>
    )
  }

  if (posts.length === 0) return null

  const formatDate = (dateStr: string) => {
    const d = new Date(dateStr)
    return {
      day: d.getDate().toString(),
      month: d.toLocaleString('en', { month: 'short' }),
      year: d.getFullYear().toString(),
    }
  }

  return (
    <div className="blog-area" id="blog">
      <div className="container">
        <div className="row">
          <div className="head_white head_center">
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">LATEST</div>
              <h2>NEWS</h2>
            </div>
          </div>
        </div>
        <div className="clearfix"></div>

        <div style={{ position: 'relative' }}>
          {/* Scroll arrows */}
          {posts.length > 3 && canScrollLeft && (
            <button
              onClick={() => scrollBy('left')}
              style={{
                position: 'absolute', left: -20, top: '50%', transform: 'translateY(-50%)',
                background: '#3347B0', color: '#fff', border: 'none', borderRadius: '50%',
                width: 40, height: 40, cursor: 'pointer', zIndex: 10,
                display: 'flex', alignItems: 'center', justifyContent: 'center',
                boxShadow: '0 4px 10px rgba(0,0,0,0.15)',
              }}
              aria-label="Scroll left"
            >
              <i className="fa fa-chevron-left"></i>
            </button>
          )}
          {posts.length > 3 && canScrollRight && (
            <button
              onClick={() => scrollBy('right')}
              style={{
                position: 'absolute', right: -20, top: '50%', transform: 'translateY(-50%)',
                background: '#3347B0', color: '#fff', border: 'none', borderRadius: '50%',
                width: 40, height: 40, cursor: 'pointer', zIndex: 10,
                display: 'flex', alignItems: 'center', justifyContent: 'center',
                boxShadow: '0 4px 10px rgba(0,0,0,0.15)',
              }}
              aria-label="Scroll right"
            >
              <i className="fa fa-chevron-right"></i>
            </button>
          )}

          <div
            ref={scrollRef}
            style={{
              display: 'flex',
              gap: 20,
              overflowX: posts.length > 3 ? 'auto' : 'hidden',
              scrollSnapType: 'x mandatory',
              scrollbarWidth: 'none',
              msOverflowStyle: 'none',
              padding: '5px 0',
            }}
          >
            {posts.map((post) => {
              const date = formatDate(post.created_at)
              return (
                <AnimateOnScroll
                  key={post.id}
                  className="blog-scroll-card"
                  style={{
                    flex: '0 0 calc(33.333% - 14px)',
                    minWidth: 280,
                    scrollSnapAlign: 'start',
                  }}
                >
                  <div className="post-row">
                    <div className="blog-boxes">
                      <div className="blog-post">
                        <div className="box-area-S">
                          <div className="blog-thumbnail pd-0">
                            <Link href={`/blog/${post.slug}`}>
                              <img
                                className="blog-img"
                                src={post.featured_image || '/images/default-gray.png'}
                                alt={post.title}
                              />
                            </Link>
                          </div>
                          <div className="clearfix"></div>
                        </div>
                        <div className="blog-single">
                          <div className="blog-single-img">
                            <li className="blog-date col-md-6 col-sm-6 col-xs-6 pd-1">
                              <i className="fa fa-calendar" aria-hidden="true"></i> {date.day} {date.month} {date.year}
                            </li>
                            <li className="blog-author col-md-6 col-sm-6 col-xs-6 pd-1">
                              <i className="fa fa-user" aria-hidden="true"></i> {post.author || 'Admin'}
                            </li>
                            <div className="clearfix"></div>
                            <div className="section-area-text">
                              <Link href={`/blog/${post.slug}`}>
                                <h4 className="inner-area-title">{post.title}</h4>
                              </Link>
                              <div className="clearfix"></div>
                              <p style={{ fontSize: 14, color: '#666', lineHeight: 1.6, height: 65, overflow: 'hidden' }}>
                                {post.excerpt || ''}
                              </p>
                              <div className="clearfix"></div>
                              <button className="snip007">
                                <Link href={`/blog/${post.slug}`}>READ MORE</Link>
                              </button>
                              <div className="box-circle"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </AnimateOnScroll>
              )
            })}
          </div>
        </div>
        <div className="clearfix"></div>
      </div>
    </div>
  )
}
