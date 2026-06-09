import type { Metadata } from 'next'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createServerSupabaseClient } from '@/lib/supabase/server'
import Link from 'next/link'
import { getVideoEmbedInfo } from '@/lib/media-helper'

export const revalidate = 0; // Disable static caching so videos are always dynamic

export const metadata: Metadata = {
  title: "Service Videos & Tutorials - Fonet Stationary Center",
  description: "Watch video guides and tutorials of printing processes, binding, certified translation, and notary requests. See our equipment in action at Fonet Chitwan.",
}

// Helper to determine the source provider name for badge display
const getVideoSourceLabel = (url: string): { name: string; color: string; icon: string } => {
  const lowerUrl = url.toLowerCase();
  if (lowerUrl.includes('youtube.com') || lowerUrl.includes('youtu.be')) {
    return { name: 'YouTube', color: '#ff0000', icon: 'fa fa-youtube-play' };
  }
  if (lowerUrl.includes('drive.google.com')) {
    return { name: 'Google Drive', color: '#1da1f2', icon: 'fa fa-hdd-o' };
  }
  if (lowerUrl.includes('facebook.com')) {
    return { name: 'Facebook', color: '#3b5998', icon: 'fa fa-facebook' };
  }
  if (lowerUrl.includes('instagram.com')) {
    return { name: 'Instagram', color: '#e1306c', icon: 'fa fa-instagram' };
  }
  if (lowerUrl.includes('tiktok.com')) {
    return { name: 'TikTok', color: '#010101', icon: 'fa fa-music' };
  }
  if (lowerUrl.endsWith('.mp4') || lowerUrl.endsWith('.webm') || lowerUrl.endsWith('.ogg') || lowerUrl.includes('.mp4?') || lowerUrl.includes('.webm?')) {
    return { name: 'Direct Video', color: '#3347B0', icon: 'fa fa-file-video-o' };
  }
  return { name: 'Video Link', color: '#6c757d', icon: 'fa fa-play-circle' };
};

export default async function VideosPage() {
  const supabase = await createServerSupabaseClient()
  
  // Fetch active videos
  const { data: videos, error } = await supabase
    .from('videos')
    .select('*')
    .eq('is_active', true)
    .order('sort_order', { ascending: true })

  return (
    <div>
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>Videos</h1>
          <ul className="breadcrumb">
            <li><Link href="/">Home</Link></li>
            <li>Videos</li>
          </ul>
        </div>
      </div>

      <div className="videos-area" style={{ padding: '60px 0', minHeight: '60vh', background: '#f8f9fa' }}>
        <div className="container">
          <div className="head_white head_center" style={{ marginBottom: 20 }}>
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">VIDEO</div>
              <h2>GALLERY & TUTORIALS</h2>
            </div>
          </div>
          <p style={{ textAlign: 'center', color: '#666', marginBottom: 50, fontSize: 15, maxWidth: '600px', margin: '0 auto 40px auto', lineHeight: 1.6 }}>
            Browse through our service tutorials, demo clips, and social posts. Learn how we carry out our premium printing and stationery processes!
          </p>

          {error ? (
            <div className="alert alert-danger" style={{ padding: 20, borderRadius: 8, background: '#f8d7da', color: '#721c24' }}>
              Error loading videos. Please try again later.
            </div>
          ) : !videos || videos.length === 0 ? (
            <div className="text-center" style={{ padding: '60px 0', background: '#fff', borderRadius: 12, boxShadow: '0 4px 20px rgba(0,0,0,0.03)' }}>
              <i className="fa fa-video-camera" style={{ fontSize: 48, color: '#ccc', marginBottom: 15 }}></i>
              <h3>No videos available yet.</h3>
              <p style={{ color: '#888' }}>Our team is preparing fresh tutorial clips. Check back soon!</p>
            </div>
          ) : (
            <div className="row" style={{ display: 'flex', flexWrap: 'wrap' }}>
              {videos.map((video) => {
                const { embedUrl, isDirectVideo } = getVideoEmbedInfo(video.video_url)
                const source = getVideoSourceLabel(video.video_url)

                return (
                  <div key={video.id} className="col-md-6 col-sm-6 col-xs-12" style={{ marginBottom: 40, display: 'flex' }}>
                    <div className="video-card" style={{ 
                      background: '#fff', 
                      borderRadius: 12, 
                      overflow: 'hidden', 
                      boxShadow: '0 4px 20px rgba(0,0,0,0.05)',
                      display: 'flex',
                      flexDirection: 'column',
                      width: '100%',
                      transition: 'transform 0.3s ease, box-shadow 0.3s ease',
                      border: '1px solid #eee'
                    }}>
                      <div className="video-wrapper" style={{ 
                        position: 'relative', 
                        paddingBottom: '56.25%', // 16:9 aspect ratio
                        height: 0,
                        background: '#000'
                      }}>
                        {isDirectVideo ? (
                          <video 
                            src={embedUrl} 
                            controls 
                            preload="metadata"
                            style={{ position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', border: 'none' }}
                          />
                        ) : (
                          <iframe 
                            src={embedUrl} 
                            title={video.title}
                            style={{ position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', border: 'none' }}
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowFullScreen
                          />
                        )}
                        
                        {/* Platform Badge */}
                        <div style={{
                          position: 'absolute',
                          top: 15,
                          left: 15,
                          background: source.color,
                          color: '#fff',
                          padding: '4px 12px',
                          borderRadius: 20,
                          fontSize: 11,
                          fontWeight: 700,
                          display: 'flex',
                          alignItems: 'center',
                          gap: 6,
                          boxShadow: '0 2px 8px rgba(0,0,0,0.3)',
                          zIndex: 2
                        }}>
                          <i className={source.icon}></i>
                          {source.name}
                        </div>
                      </div>

                      <div className="video-info" style={{ padding: 24, flexGrow: 1, display: 'flex', flexDirection: 'column' }}>
                        <h3 style={{ marginTop: 0, marginBottom: 12, fontSize: 18, fontWeight: 700, fontFamily: "'Oswald', sans-serif", color: '#333' }}>
                          {video.title}
                        </h3>
                        {video.description && (
                          <p style={{ color: '#666', marginBottom: 0, fontSize: 14, lineHeight: 1.6, flexGrow: 1 }}>
                            {video.description}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>
                )
              })}
            </div>
          )}
        </div>
      </div>
      <Footer />
    </div>
  )
}
