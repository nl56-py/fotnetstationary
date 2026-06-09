import { createServerSupabaseClient } from '@/lib/supabase/server'
import { services as staticServices } from '@/lib/services-data'
import type { Metadata } from 'next'
import ServicesClient from './ServicesClient'

export const revalidate = 0

export const metadata: Metadata = {
  title: 'Our Services - Fonet Stationary Center',
  description: 'Explore the full range of services offered by Fonet Stationary Center including thesis typing, photocopy, printing, lamination, notary service, visiting cards, PVC cards, and more.',
}

export default async function ServicesPage() {
  const supabase = await createServerSupabaseClient()
  const { data: dbServices } = await supabase
    .from('services')
    .select('*')
    .eq('is_active', true)
    .order('sort_order')

  // Use DB services if available, else fall back to static data
  const services = dbServices && dbServices.length > 0
    ? dbServices.map((s: any) => ({
        slug: s.slug,
        title: s.title,
        icon: s.icon || 'fa fa-print',
        image: s.image_url || '/images/servicesimg.jpg',
        shortDesc: s.description || '',
      }))
    : staticServices.map(s => ({
        slug: s.slug,
        title: s.title,
        icon: s.icon,
        image: s.image,
        shortDesc: s.shortDesc,
      }))

  return <ServicesClient services={services} />
}
