import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createServerSupabaseClient } from '@/lib/supabase/server'
import Link from 'next/link'
import { notFound } from 'next/navigation'

export const revalidate = 0;

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

  return (
    <div>
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
                
                {/* Render Rich Text Content */}
                <div 
                  className="blog-content prose" 
                  dangerouslySetInnerHTML={{ __html: post.content || '' }} 
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
