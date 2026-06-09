import type { Metadata } from 'next'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createServerSupabaseClient } from '@/lib/supabase/server'
import { sanitizeHtml } from '@/lib/sanitize-html'
import Link from 'next/link'
import { notFound } from 'next/navigation'

export const revalidate = 0;

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params
  const supabase = await createServerSupabaseClient()
  const { data: post } = await supabase
    .from('blog_posts')
    .select('title, excerpt, featured_image')
    .eq('slug', slug)
    .single()

  if (!post) {
    return { title: 'Blog Post - Fonet Stationary Center' }
  }

  const title = `${post.title} - Fonet Stationary Center`
  const description = post.excerpt || ''
  const imageUrl = post.featured_image || '/images/fonet logo.PNG'

  return {
    title,
    description,
    openGraph: {
      title,
      description,
      type: 'article',
      url: `https://fonet.com.np/blog/${slug}`,
      images: [
        {
          url: imageUrl.startsWith('/') ? `https://fonet.com.np${imageUrl}` : imageUrl,
          alt: post.title,
        },
      ],
    },
    twitter: {
      card: 'summary_large_image',
      title,
      description,
      images: [imageUrl.startsWith('/') ? `https://fonet.com.np${imageUrl}` : imageUrl],
    },
  }
}

export default async function BlogPostPage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params
  const supabase = await createServerSupabaseClient()

  // Fetch the specific blog post
  const { data: post, error } = await supabase
    .from('blog_posts')
    .select('*')
    .eq('slug', slug)
    .single()

  if (error || !post) {
    notFound()
  }

  const articleSchema = {
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": post.title,
    "description": post.excerpt || "",
    "image": post.featured_image ? (post.featured_image.startsWith('/') ? `https://fonet.com.np${post.featured_image}` : post.featured_image) : "https://fonet.com.np/images/fonet logo.PNG",
    "datePublished": post.created_at,
    "dateModified": post.updated_at || post.created_at,
    "author": {
      "@type": "Person",
      "name": post.author || "Admin"
    },
    "publisher": {
      "@type": "Organization",
      "name": "Fonet Stationary Center",
      "logo": {
        "@type": "ImageObject",
        "url": "https://fonet.com.np/images/fonet logo.PNG"
      }
    },
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": `https://fonet.com.np/blog/${slug}`
    }
  }

  return (
    <div>
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(articleSchema) }}
      />
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>{post.title}</h1>
          <ul className="breadcrumb">
            <li><Link href="/">Home</Link></li>
            <li><Link href="/blog">Blog</Link></li>
            <li>{post.title}</li>
          </ul>
        </div>
      </div>

      <div className="single-blog-area" style={{ paddingTop: 60, paddingBottom: 60 }}>
        <div className="container">
          <div className="row">
            <div className="col-md-8 col-md-offset-2">
              <div className="single-blog-post">
                {post.featured_image && (
                  <div className="blog-thumbnail" style={{ marginBottom: 30 }}>
                    <img 
                      src={post.featured_image} 
                      alt={post.title} 
                      style={{ width: '100%', borderRadius: 8, maxHeight: 400, objectFit: 'cover' }} 
                    />
                  </div>
                )}
                
                <div className="blog-meta" style={{ marginBottom: 20, color: '#777' }}>
                  <span style={{ marginRight: 15 }}><i className="fa fa-calendar"></i> {new Date(post.created_at).toLocaleDateString()}</span>
                  <span style={{ marginRight: 15 }}><i className="fa fa-user"></i> {post.author || 'Admin'}</span>
                </div>

                <h2 style={{ marginBottom: 20 }}>{post.title}</h2>
                
                {/* Render Rich Text Content — sanitized for XSS safety */}
                <div 
                  className="blog-content prose" 
                  dangerouslySetInnerHTML={{ __html: sanitizeHtml(post.content) }} 
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
