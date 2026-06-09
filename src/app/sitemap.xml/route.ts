import { NextResponse } from 'next/server'
import { createAdminClient } from '@/lib/supabase/admin'

export const dynamic = 'force-dynamic'
export const revalidate = 0

export async function GET() {
  const domain = 'https://fonet.com.np'
  const currentDate = new Date().toISOString()

  // Base static URLs
  const staticPaths = [
    { path: '', changefreq: 'daily', priority: '1.0' },
    { path: '/about', changefreq: 'weekly', priority: '0.8' },
    { path: '/services', changefreq: 'daily', priority: '0.9' },
    { path: '/notary', changefreq: 'weekly', priority: '0.8' },
    { path: '/pricing', changefreq: 'weekly', priority: '0.8' },
    { path: '/notices', changefreq: 'daily', priority: '0.7' },
    { path: '/notes', changefreq: 'daily', priority: '0.7' },
    { path: '/gallery', changefreq: 'weekly', priority: '0.6' },
    { path: '/videos', changefreq: 'weekly', priority: '0.6' },
    { path: '/blog', changefreq: 'daily', priority: '0.7' },
    { path: '/contact', changefreq: 'monthly', priority: '0.5' },
  ]

  let services: any[] = []
  let blogs: any[] = []

  try {
    const supabase = createAdminClient()

    // Fetch active services
    const { data: dbServices } = await supabase
      .from('services')
      .select('slug, updated_at')
      .eq('is_active', true)

    if (dbServices) {
      services = dbServices
    }

    // Fetch published blogs
    const { data: dbBlogs } = await supabase
      .from('blog_posts')
      .select('slug, updated_at')
      .eq('is_published', true)

    if (dbBlogs) {
      blogs = dbBlogs
    }
  } catch (err) {
    console.error('Error fetching sitemap dynamic paths:', err)
  }

  // Generate XML content
  const xml = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <!-- Static Pages -->
  ${staticPaths
    .map(
      (p) => `  <url>
    <loc>${domain}${p.path}</loc>
    <lastmod>${currentDate}</lastmod>
    <changefreq>${p.changefreq}</changefreq>
    <priority>${p.priority}</priority>
  </url>`
    )
    .join('\n')}

  <!-- Dynamic Services -->
  ${services
    .map(
      (s) => `  <url>
    <loc>${domain}/services/${s.slug}</loc>
    <lastmod>${s.updated_at ? new Date(s.updated_at).toISOString() : currentDate}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>`
    )
    .join('\n')}

  <!-- Dynamic Blogs -->
  ${blogs
    .map(
      (b) => `  <url>
    <loc>${domain}/blog/${b.slug}</loc>
    <lastmod>${b.updated_at ? new Date(b.updated_at).toISOString() : currentDate}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>`
    )
    .join('\n')}
</urlset>`

  return new NextResponse(xml.trim(), {
    headers: {
      'Content-Type': 'application/xml',
      'Cache-Control': 'public, max-age=3600, s-maxage=3600, stale-while-revalidate=600',
    },
  })
}
