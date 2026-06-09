-- ============================================
-- SECURITY MIGRATION — Fonet Stationary Center
-- Run this in your Supabase SQL Editor
-- ============================================
-- This migration hardens RLS policies and storage policies.
-- Before running, ensure your admin user(s) exist in admin_users.
--
-- IMPORTANT: After running this migration, manually set is_admin = true
-- for your admin user(s):
--   UPDATE admin_users SET is_admin = true WHERE email = 'your-admin@email.com';
-- ============================================

-- 1. Add is_admin flag to admin_users
ALTER TABLE admin_users ADD COLUMN IF NOT EXISTS is_admin BOOLEAN DEFAULT FALSE;

-- 2. Remove the auto-insert trigger that makes every signup an admin
DROP TRIGGER IF EXISTS on_auth_user_created ON auth.users;
DROP FUNCTION IF EXISTS public.handle_new_user();

-- 3. Create a helper function for RLS checks
CREATE OR REPLACE FUNCTION public.is_admin()
RETURNS BOOLEAN AS $$
BEGIN
  RETURN EXISTS (
    SELECT 1 FROM public.admin_users
    WHERE id = auth.uid() AND is_admin = true
  );
END;
$$ LANGUAGE plpgsql SECURITY DEFINER STABLE;

-- ============================================
-- 4. Replace all "admin" RLS policies
--    OLD: auth.role() = 'authenticated' (any logged-in user)
--    NEW: public.is_admin() (only users in admin_users with is_admin = true)
-- ============================================

-- site_settings
DROP POLICY IF EXISTS "admin_all_settings" ON site_settings;
CREATE POLICY "admin_all_settings" ON site_settings
  FOR ALL USING (public.is_admin());

-- sliders
DROP POLICY IF EXISTS "admin_all_sliders" ON sliders;
CREATE POLICY "admin_all_sliders" ON sliders
  FOR ALL USING (public.is_admin());

-- services
DROP POLICY IF EXISTS "admin_all_services" ON services;
CREATE POLICY "admin_all_services" ON services
  FOR ALL USING (public.is_admin());

-- gallery_images
DROP POLICY IF EXISTS "admin_all_gallery" ON gallery_images;
CREATE POLICY "admin_all_gallery" ON gallery_images
  FOR ALL USING (public.is_admin());

-- pricing_items
DROP POLICY IF EXISTS "admin_all_pricing" ON pricing_items;
CREATE POLICY "admin_all_pricing" ON pricing_items
  FOR ALL USING (public.is_admin());

-- blog_posts
DROP POLICY IF EXISTS "admin_all_blogs" ON blog_posts;
CREATE POLICY "admin_all_blogs" ON blog_posts
  FOR ALL USING (public.is_admin());

-- bookings
DROP POLICY IF EXISTS "admin_all_bookings" ON bookings;
CREATE POLICY "admin_all_bookings" ON bookings
  FOR ALL USING (public.is_admin());

-- contact_submissions
DROP POLICY IF EXISTS "admin_all_contact" ON contact_submissions;
CREATE POLICY "admin_all_contact" ON contact_submissions
  FOR ALL USING (public.is_admin());

-- testimonials
DROP POLICY IF EXISTS "admin_all_testimonials" ON testimonials;
CREATE POLICY "admin_all_testimonials" ON testimonials
  FOR ALL USING (public.is_admin());

-- counter_stats
DROP POLICY IF EXISTS "admin_all_counters" ON counter_stats;
CREATE POLICY "admin_all_counters" ON counter_stats
  FOR ALL USING (public.is_admin());

-- team_members
DROP POLICY IF EXISTS "admin_all_team" ON team_members;
CREATE POLICY "admin_all_team" ON team_members
  FOR ALL USING (public.is_admin());

-- videos
DROP POLICY IF EXISTS "admin_all_videos" ON videos;
CREATE POLICY "admin_all_videos" ON videos
  FOR ALL USING (public.is_admin());

-- admin_users (only admins can manage other admins)
DROP POLICY IF EXISTS "admin_all_admin_users" ON admin_users;
CREATE POLICY "admin_all_admin_users" ON admin_users
  FOR ALL USING (public.is_admin());

-- notary_requests
DROP POLICY IF EXISTS "admin_all_notary_requests" ON notary_requests;
CREATE POLICY "admin_all_notary_requests" ON notary_requests
  FOR ALL USING (public.is_admin());

-- notices_downloads
DROP POLICY IF EXISTS "admin_all_notices_downloads" ON notices_downloads;
CREATE POLICY "admin_all_notices_downloads" ON notices_downloads
  FOR ALL USING (public.is_admin());

-- notes
DROP POLICY IF EXISTS "admin_all_notes" ON notes;
CREATE POLICY "admin_all_notes" ON notes
  FOR ALL USING (public.is_admin());

-- ============================================
-- 5. Harden storage policies
--    Remove public write/update/delete access.
--    Only admin users (via service-role key or RLS) can write.
--    Public read access is preserved.
-- ============================================

-- Remove dangerous public write policies
DROP POLICY IF EXISTS "Public Upload" ON storage.objects;
DROP POLICY IF EXISTS "Public Update" ON storage.objects;
DROP POLICY IF EXISTS "Public Delete" ON storage.objects;

-- Keep public read access
DROP POLICY IF EXISTS "Public Access" ON storage.objects;
CREATE POLICY "Public Read Access" ON storage.objects
  FOR SELECT USING (bucket_id = 'documents');

-- Admin-only write access (if needed from browser with authenticated session)
CREATE POLICY "Admin Upload" ON storage.objects
  FOR INSERT WITH CHECK (bucket_id = 'documents' AND public.is_admin());

CREATE POLICY "Admin Update" ON storage.objects
  FOR UPDATE USING (bucket_id = 'documents' AND public.is_admin());

CREATE POLICY "Admin Delete" ON storage.objects
  FOR DELETE USING (bucket_id = 'documents' AND public.is_admin());

-- ============================================
-- AFTER RUNNING THIS MIGRATION:
-- Set your admin user(s) as admins:
--
--   UPDATE admin_users SET is_admin = true WHERE email = 'your-admin@email.com';
--
-- ============================================
