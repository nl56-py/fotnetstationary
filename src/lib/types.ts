// ============================================
// Database Types for Fonet Stationary Center
// ============================================

export interface SiteSetting {
  id: string
  key: string
  value: string | null
  updated_at: string
}

export interface Slider {
  id: string
  title: string
  subtitle: string | null
  image_url: string
  button_text: string | null
  button_link: string | null
  button2_text: string | null
  button2_link: string | null
  sort_order: number
  is_active: boolean
  created_at: string
}

export interface Service {
  id: string
  title: string
  slug: string
  description: string | null
  long_description: string | null
  icon: string
  image_url: string | null
  sort_order: number
  is_active: boolean
  created_at: string
  updated_at: string
}

export interface GalleryImage {
  id: string
  title: string | null
  image_url: string
  category: string
  sort_order: number
  is_active: boolean
  created_at: string
}

export interface PricingItem {
  id: string
  sn: number | null
  service_name: string
  category: string
  price: string | null
  notes: string | null
  sort_order: number
  is_active: boolean
  created_at: string
  updated_at: string
}

export interface BlogPost {
  id: string
  title: string
  slug: string
  excerpt: string | null
  content: string | null
  featured_image: string | null
  author: string
  is_published: boolean
  published_at: string | null
  created_at: string
  updated_at: string
}

export interface Booking {
  id: string
  customer_name: string
  customer_email: string | null
  customer_phone: string
  service_type: string | null
  message: string | null
  file_url: string | null
  status: 'pending' | 'in_progress' | 'completed' | 'cancelled'
  admin_notes: string | null
  created_at: string
  updated_at: string
}

export interface ContactSubmission {
  id: string
  first_name: string
  last_name: string | null
  phone: string | null
  email: string | null
  message: string | null
  file_url: string | null
  is_read: boolean
  created_at: string
}

export interface Testimonial {
  id: string
  name: string
  designation: string | null
  content: string
  image_url: string | null
  rating: number
  sort_order: number
  is_active: boolean
  created_at: string
}

export interface CounterStat {
  id: string
  title: string
  count: number
  icon: string | null
  sort_order: number
  is_active: boolean
}

export interface TeamMember {
  id: string
  name: string
  position: string | null
  image_url: string | null
  sort_order: number
  is_active: boolean
}

// Settings helper type
export type SiteSettings = Record<string, string>
