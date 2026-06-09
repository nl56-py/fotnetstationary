import type { Metadata } from 'next'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createServerSupabaseClient } from '@/lib/supabase/server'
import Link from 'next/link'

export const revalidate = 0; // Disable static caching so blogs are always up-to-date

export const metadata: Metadata = {
  title: "Our Blog - Fonet Stationary Center",
  description: "Read helpful articles on academic thesis writing, legal translation formats, notary requirements in Nepal, custom mug printing, and stationery advice.",
}

export default async function BlogPage() {
  const supabase = await createServerSupabaseClient()
  
  // Fetch published blog posts
  const { data: posts, error } = await supabase
    .from('blog_posts')
    .select('*')
    .eq('is_published', true)
    .order('created_at', { ascending: false })

  return (
    <div>
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>Blog</h1>
          <ul className="breadcrumb">
            <li><Link href="/">Home</Link></li>
            <li>Blog</li>
          </ul>
        </div>
      </div>

      <div className="blog-area" style={{ paddingTop: 60, minHeight: '60vh' }}>
        <div className="container">
          {error ? (
            <div className="alert alert-danger">Error loading blogs. Please try again later.</div>
          ) : !posts || posts.length === 0 ? (
            <div className="text-center" style={{ padding: '40px 0' }}>
              <h3>No blog posts available yet.</h3>
              <p>Check back later for updates!</p>
            </div>
          ) : (
            <div className="row">
              {posts.map((post) => (
                <div key={post.id} className="col-md-4 col-sm-6 col-xs-12" style={{ marginBottom: 30 }}>
                  <div className="blog-post">
                    <div className="blog-thumbnail" style={{ height: 200, overflow: 'hidden' }}>
                      <img 
                        className="blog-img" 
                        src={post.featured_image || '/images/default-gray.png'} 
                        alt={post.title} 
                        style={{ width: '100%', height: '100%', objectFit: 'cover' }}
                      />
                    </div>
                    <div className="blog-single">
                      <div className="blog-single-img">
                        <li className="blog-date col-md-6 col-sm-6 col-xs-6 pd-1">
                          <i className="fa fa-calendar"></i> {new Date(post.created_at).toLocaleDateString()}
                        </li>
                        <li className="blog-author col-md-6 col-sm-6 col-xs-6 pd-1">
                          <i className="fa fa-user"></i> {post.author || 'Admin'}
                        </li>
                        <div className="clearfix"></div>
                        <div className="section-area-text">
                          <h4 className="inner-area-title" style={{ height: '48px', overflow: 'hidden' }}>
                            {post.title}
                          </h4>
                          <p style={{ fontSize: 14, color: '#666', lineHeight: 1.6, height: '65px', overflow: 'hidden' }}>
                            {post.excerpt}
                          </p>
                          <button className="snip007">
                            <Link href={`/blog/${post.slug}`}>READ MORE</Link>
                          </button>
                          <div className="box-circle"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>

      <Footer />
    </div>
  )
}
