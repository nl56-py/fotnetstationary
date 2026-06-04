'use client'
import { AnimateOnScroll } from '@/components/ui/AnimateOnScroll'

const blogPosts = [
  {
    title: 'Why Quality Printing Matters',
    excerpt: 'Learn why choosing the right printing service can make a difference in your business documents and marketing materials.',
    image: '/images/default-gray.png',
    date: { day: '15', month: 'Jan', year: '2024' },
    comments: 0,
  },
  {
    title: 'Tips for Thesis Formatting',
    excerpt: 'Essential formatting tips every student should know before submitting their thesis paper for printing.',
    image: '/images/default-gray.png',
    date: { day: '22', month: 'Feb', year: '2024' },
    comments: 2,
  },
  {
    title: 'Our New Flex Print Machine',
    excerpt: 'We have upgraded our flex printing capabilities with a brand new machine for better quality and faster delivery.',
    image: '/images/default-gray.png',
    date: { day: '10', month: 'Mar', year: '2024' },
    comments: 1,
  },
]

export default function BlogSection() {
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
        <div className="blog-area-wrap">
          <div className="blog-posts">
            {blogPosts.map((post, idx) => (
              <AnimateOnScroll key={idx} className="col-md-4 col-sm-6 col-xs-12">
                <div className="post-row">
                  <div className="blog-boxes">
                    <div className="blog-post">
                      <div className="box-area-S">
                        <div className="blog-thumbnail pd-0">
                          <a href="/blog"><img className="blog-img" src={post.image} alt={post.title} /></a>
                        </div>
                        <div className="clearfix"></div>
                      </div>
                      <div className="blog-single">
                        <div className="blog-single-img">
                          <li className="blog-date col-md-6 col-sm-6 col-xs-6 pd-1">
                            <i className="fa fa-calendar" aria-hidden="true"></i> {post.date.day} {post.date.month} {post.date.year}
                          </li>
                          <li className="blog-author col-md-6 col-sm-6 col-xs-6 pd-1">
                            <i className="fa fa-commenting" aria-hidden="true"></i> {post.comments} comment
                          </li>
                          <div className="clearfix"></div>
                          <div className="section-area-text">
                            <a href="/blog">
                              <h4 className="inner-area-title">{post.title}</h4>
                            </a>
                            <div className="clearfix"></div>
                            <p style={{ fontSize: 14, color: '#666', lineHeight: 1.6 }}>{post.excerpt}</p>
                            <div className="clearfix"></div>
                            <button className="snip007">
                              <a href="/blog">READ MORE</a>
                            </button>
                            <div className="box-circle"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </AnimateOnScroll>
            ))}
          </div>
          <div className="clearfix"></div>
        </div>
      </div>
    </div>
  )
}
