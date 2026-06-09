-- ============================================
-- FONET STATIONARY CENTER - Database Schema
-- Run this in your Supabase SQL Editor
-- ============================================

-- Site Settings (key-value store)
CREATE TABLE IF NOT EXISTS site_settings (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  key TEXT UNIQUE NOT NULL,
  value TEXT,
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Slider Items
CREATE TABLE IF NOT EXISTS sliders (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  subtitle TEXT,
  image_url TEXT NOT NULL,
  button_text TEXT,
  button_link TEXT,
  button2_text TEXT,
  button2_link TEXT,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Services
CREATE TABLE IF NOT EXISTS services (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  slug TEXT UNIQUE NOT NULL,
  description TEXT,
  long_description TEXT,
  icon TEXT DEFAULT 'fa fa-print',
  image_url TEXT,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Gallery Images
CREATE TABLE IF NOT EXISTS gallery_images (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT,
  image_url TEXT NOT NULL,
  category TEXT DEFAULT 'General',
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Pricing Items
CREATE TABLE IF NOT EXISTS pricing_items (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  sn INT,
  service_name TEXT NOT NULL,
  category TEXT DEFAULT 'PRINT AND PHOTOCOPY SERVICES',
  price TEXT,
  notes TEXT,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Blog Posts
CREATE TABLE IF NOT EXISTS blog_posts (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  slug TEXT UNIQUE NOT NULL,
  excerpt TEXT,
  content TEXT,
  featured_image TEXT,
  author TEXT DEFAULT 'Admin',
  is_published BOOLEAN DEFAULT FALSE,
  published_at TIMESTAMPTZ,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Service Bookings
CREATE TABLE IF NOT EXISTS bookings (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  customer_name TEXT NOT NULL,
  customer_email TEXT,
  customer_phone TEXT NOT NULL,
  service_type TEXT,
  message TEXT,
  file_url TEXT,
  status TEXT DEFAULT 'pending',
  admin_notes TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Contact Form Submissions
CREATE TABLE IF NOT EXISTS contact_submissions (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  first_name TEXT NOT NULL,
  last_name TEXT,
  phone TEXT,
  email TEXT,
  message TEXT,
  file_url TEXT,
  is_read BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Testimonials
CREATE TABLE IF NOT EXISTS testimonials (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  name TEXT NOT NULL,
  designation TEXT,
  content TEXT NOT NULL,
  image_url TEXT,
  rating INT DEFAULT 5,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Counter Stats
CREATE TABLE IF NOT EXISTS counter_stats (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  count INT NOT NULL,
  icon TEXT DEFAULT 'fa fa-star',
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE
);

-- Team Members
CREATE TABLE IF NOT EXISTS team_members (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  name TEXT NOT NULL,
  position TEXT,
  image_url TEXT,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE
);

-- Videos
CREATE TABLE IF NOT EXISTS videos (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  video_url TEXT NOT NULL,
  description TEXT,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ============================================
-- Row Level Security
-- ============================================
ALTER TABLE site_settings ENABLE ROW LEVEL SECURITY;
ALTER TABLE sliders ENABLE ROW LEVEL SECURITY;
ALTER TABLE services ENABLE ROW LEVEL SECURITY;
ALTER TABLE gallery_images ENABLE ROW LEVEL SECURITY;
ALTER TABLE pricing_items ENABLE ROW LEVEL SECURITY;
ALTER TABLE blog_posts ENABLE ROW LEVEL SECURITY;
ALTER TABLE bookings ENABLE ROW LEVEL SECURITY;
ALTER TABLE contact_submissions ENABLE ROW LEVEL SECURITY;
ALTER TABLE testimonials ENABLE ROW LEVEL SECURITY;
ALTER TABLE counter_stats ENABLE ROW LEVEL SECURITY;
ALTER TABLE team_members ENABLE ROW LEVEL SECURITY;
ALTER TABLE videos ENABLE ROW LEVEL SECURITY;

-- Public read
DROP POLICY IF EXISTS "public_read_settings" ON site_settings;
CREATE POLICY "public_read_settings" ON site_settings FOR SELECT USING (true);

DROP POLICY IF EXISTS "public_read_sliders" ON sliders;
CREATE POLICY "public_read_sliders" ON sliders FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_services" ON services;
CREATE POLICY "public_read_services" ON services FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_gallery" ON gallery_images;
CREATE POLICY "public_read_gallery" ON gallery_images FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_pricing" ON pricing_items;
CREATE POLICY "public_read_pricing" ON pricing_items FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_blogs" ON blog_posts;
CREATE POLICY "public_read_blogs" ON blog_posts FOR SELECT USING (is_published = true);

DROP POLICY IF EXISTS "public_read_testimonials" ON testimonials;
CREATE POLICY "public_read_testimonials" ON testimonials FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_counters" ON counter_stats;
CREATE POLICY "public_read_counters" ON counter_stats FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_team" ON team_members;
CREATE POLICY "public_read_team" ON team_members FOR SELECT USING (is_active = true);

DROP POLICY IF EXISTS "public_read_videos" ON videos;
CREATE POLICY "public_read_videos" ON videos FOR SELECT USING (is_active = true);

-- Public insert for forms
DROP POLICY IF EXISTS "public_insert_bookings" ON bookings;
CREATE POLICY "public_insert_bookings" ON bookings FOR INSERT WITH CHECK (true);

DROP POLICY IF EXISTS "public_insert_contact" ON contact_submissions;
CREATE POLICY "public_insert_contact" ON contact_submissions FOR INSERT WITH CHECK (true);

-- Helper function for admin RLS checks
CREATE OR REPLACE FUNCTION public.is_admin()
RETURNS BOOLEAN AS $$
BEGIN
  RETURN EXISTS (
    SELECT 1 FROM public.admin_users
    WHERE id = auth.uid() AND is_admin = true
  );
END;
$$ LANGUAGE plpgsql SECURITY DEFINER STABLE;

-- Admin full access (restricted to admin_users with is_admin = true)
DROP POLICY IF EXISTS "admin_all_settings" ON site_settings;
CREATE POLICY "admin_all_settings" ON site_settings FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_sliders" ON sliders;
CREATE POLICY "admin_all_sliders" ON sliders FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_services" ON services;
CREATE POLICY "admin_all_services" ON services FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_gallery" ON gallery_images;
CREATE POLICY "admin_all_gallery" ON gallery_images FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_pricing" ON pricing_items;
CREATE POLICY "admin_all_pricing" ON pricing_items FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_blogs" ON blog_posts;
CREATE POLICY "admin_all_blogs" ON blog_posts FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_bookings" ON bookings;
CREATE POLICY "admin_all_bookings" ON bookings FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_contact" ON contact_submissions;
CREATE POLICY "admin_all_contact" ON contact_submissions FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_testimonials" ON testimonials;
CREATE POLICY "admin_all_testimonials" ON testimonials FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_counters" ON counter_stats;
CREATE POLICY "admin_all_counters" ON counter_stats FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_team" ON team_members;
CREATE POLICY "admin_all_team" ON team_members FOR ALL USING (public.is_admin());

DROP POLICY IF EXISTS "admin_all_videos" ON videos;
CREATE POLICY "admin_all_videos" ON videos FOR ALL USING (public.is_admin());

-- ============================================
-- Seed Data
-- ============================================
INSERT INTO site_settings (key, value) VALUES
('site_name', 'Fonet Stationary Center'),
('site_tagline', 'Today Write''s for Tomorrow'),
('phone', '056526307'),
('mobile', '9845220077'),
('email', 'fcichitwan@gmail.com'),
('address', 'Bharatpur Metropolitan City Ward No.10, Saptagandaki Chowk, Chitwan, Nepal'),
('facebook', 'https://facebook.com/'),
('youtube', 'https://youtube.com/'),
('twitter', 'https://twitter.com/'),
('instagram', 'https://instagram.com/'),
('fax', '+977-056-526307'),
('working_hours', '7:00 AM - 7:00 PM'),
('hero_background_image_url', '/images/slider1.jpg'),
('about_text', 'Fonet Stationary Center (FCI) is located at central location of Bharatpur, in front of Saptagandaki Campus. We are here to cater you all required services for Computer such as typing, printing, photocopy and other related tasks.'),
('history_text', 'FCI was established in 2070 B.S. We have earned trust of people from all Chitwan and neighbor for quality and quick service. Fonet Stationary Center is Business Enterprise, is a registered and licensed business enterprise in the Business Service Centers that will operate a standard business services firm.'),
('mission_text', 'Our mission is to establish a standard business services center cum copy shop that will make available a wide range of services and products as it relates to the service offerings in the business center services industry at affordable prices to the customer and other locations.'),
('vision_text', 'Our vision is to build a business services center cum copy shop that will have active presence all over major locations.'),
('copyright', '© 2024 Fonet Stationary Center. All Rights Reserved.')
ON CONFLICT (key) DO NOTHING;

INSERT INTO services (title, slug, description, icon, sort_order) VALUES
('Thesis Typing', 'thesis-typing', 'Professional thesis typing with formatting and proofreading services for students.', 'fa fa-keyboard-o', 1),
('Best Photocopy', 'photocopy', 'High-quality photocopying services up to A0 size, black and white and color.', 'fa fa-copy', 2),
('Stationary', 'stationary', 'Complete range of stationary items for office and school needs.', 'fa fa-pencil', 3),
('General Typing', 'general-typing', 'Accurate typing services for manuscripts, documents, and all forms.', 'fa fa-file-text-o', 4),
('Documentations', 'documentations', 'Professional documentation and legal document preparation services.', 'fa fa-folder-open-o', 5),
('Students Materials', 'students-materials', 'Study materials, notes, and academic support for students.', 'fa fa-graduation-cap', 6),
('Courier Services', 'courier-services', 'Reliable courier and delivery services across Chitwan.', 'fa fa-truck', 7),
('T-Shirt Print', 'tshirt-print', 'Custom T-shirt printing with your own designs and logos.', 'fa fa-tags', 8),
('Cup/Plate Print', 'cup-plate-print', 'Personalized cup and plate printing for gifts and events.', 'fa fa-coffee', 9),
('Photo & Stickers', 'photo-stickers', 'High-quality photo printing and custom sticker production.', 'fa fa-camera', 10),
('Flex Print', 'flex-print', 'Large format flex banner printing for advertisements.', 'fa fa-picture-o', 11),
('Lamination', 'lamination', 'Document and photo lamination in various sizes.', 'fa fa-shield', 12),
('Visiting Card', 'visiting-card', 'Professional visiting card design and printing services.', 'fa fa-address-card-o', 13),
('PVC Card', 'pvc-card', 'PVC ID card printing for organizations and individuals.', 'fa fa-id-card', 14),
('Self Stamp', 'self-stamp', 'Custom self-inking stamp design and production.', 'fa fa-circle', 15),
('Ribbon Batch', 'ribbon-batch', 'Medal, ribbon, and batch printing for events.', 'fa fa-bookmark', 16),
('Token of Love', 'token-of-love', 'Personalized gift items and token of love products.', 'fa fa-heart', 17)
ON CONFLICT (slug) DO NOTHING;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pricing_items) THEN
    INSERT INTO pricing_items (sn, service_name, category, price, notes, sort_order) VALUES
    (1, 'Stationary Services', 'STATIONARY', '', '', 1),
    (2, 'Typing/Binding (Spiral+Ring)', 'STATIONARY', '', '', 2),
    (1, 'Photocopy', 'PRINT AND PHOTOCOPY', '', '', 3),
    (2, 'Print', 'PRINT AND PHOTOCOPY', '', '', 4),
    (3, 'Print Both Side', 'PRINT AND PHOTOCOPY', '', '', 5),
    (4, 'Print Both Side (0-200)', 'PRINT AND PHOTOCOPY', '', '', 6),
    (5, 'Print Both Side (200-500)', 'PRINT AND PHOTOCOPY', '', '', 7),
    (6, 'Print Both Side (500-1000)', 'PRINT AND PHOTOCOPY', '', '', 8),
    (7, 'Print Both Side (1000-2000)', 'PRINT AND PHOTOCOPY', '', '', 9),
    (8, 'Print Both Side (2000 and above)', 'PRINT AND PHOTOCOPY', '', '', 10),
    (9, 'Print Single Side', 'PRINT AND PHOTOCOPY', '', '', 11),
    (10, 'Print Single Side (0-200)', 'PRINT AND PHOTOCOPY', '', '', 12),
    (11, 'Print Single Side (200-500)', 'PRINT AND PHOTOCOPY', '', '', 13),
    (12, 'Print Single Side (500-1000)', 'PRINT AND PHOTOCOPY', '', '', 14),
    (13, 'Print Single Side (1000 and above)', 'PRINT AND PHOTOCOPY', '', '', 15),
    (1, 'Self Stamp', 'OTHERS', '', 'Price may change according to quantity', 16),
    (2, 'PVC ID Card Single Side', 'OTHERS', '', 'Price may change according to quantity', 17),
    (3, 'PVC ID Card Both Side', 'OTHERS', '', 'Price may change according to quantity', 18),
    (4, 'Ribbon Batch', 'OTHERS', '', '', 19),
    (5, 'Flex Print', 'OTHERS', '', '', 20),
    (6, 'Lamination', 'OTHERS', '', '', 21),
    (7, 'A3 Print/Scan', 'OTHERS', '', '', 22),
    (8, 'Cup Print/T-Shirt', 'OTHERS', '', '', 23),
    (9, 'T-Shirt Print', 'OTHERS', '', '', 24),
    (10, 'Token of Love/Batch/Medal', 'OTHERS', '', '', 25),
    (11, 'Sticker/Photo', 'OTHERS', '', '', 26),
    (12, 'Color Laser Print upto 12x18', 'OTHERS', '', '', 27),
    (13, 'Menu Design', 'OTHERS', '', '', 28),
    (14, 'Visiting Card', 'OTHERS', '', '', 29);
  END IF;
END $$;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM counter_stats) THEN
    INSERT INTO counter_stats (title, count, icon, sort_order) VALUES
    ('Happy Customers', 5000, 'fa fa-smile-o', 1),
    ('Projects Completed', 12000, 'fa fa-check-circle', 2),
    ('Years Experience', 10, 'fa fa-calendar', 3),
    ('Services Offered', 17, 'fa fa-cogs', 4);
  END IF;
END $$;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM team_members) THEN
    INSERT INTO team_members (name, position, sort_order) VALUES
    ('Shubarna Neupane', 'Managing Director', 1),
    ('Ranjana Poudel Neupane', 'Co-Manager', 2),
    ('Tapesh Mahato', 'Operations', 3);
  END IF;
END $$;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM testimonials) THEN
    INSERT INTO testimonials (name, designation, content, sort_order) VALUES
    ('Satisfied Customer', 'Student', 'Fonet Stationary Center provides excellent thesis typing and printing services. Their quality and quick turnaround time is unmatched in Chitwan. Highly recommended for all students!', 1),
    ('Business Client', 'Entrepreneur', 'We have been using FCI for all our business printing needs including visiting cards, flex prints, and document services. Professional service at affordable prices.', 2);
  END IF;
END $$;

-- ============================================
-- Admin Users (manually managed — no auto-insert trigger)
-- ============================================
CREATE TABLE IF NOT EXISTS admin_users (
  id UUID PRIMARY KEY REFERENCES auth.users(id) ON DELETE CASCADE,
  email TEXT NOT NULL UNIQUE,
  is_admin BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

ALTER TABLE admin_users ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS "public_read_admin_users" ON admin_users;
CREATE POLICY "public_read_admin_users" ON admin_users FOR SELECT USING (true);

DROP POLICY IF EXISTS "admin_all_admin_users" ON admin_users;
CREATE POLICY "admin_all_admin_users" ON admin_users FOR ALL USING (public.is_admin());

-- NOTE: The auto-insert trigger has been intentionally removed.
-- Admin users must be manually added via the Supabase dashboard or SQL editor.
-- To add an admin:
--   INSERT INTO admin_users (id, email, is_admin) VALUES ('<user-uuid>', '<email>', true);


-- ============================================
-- NOTARY SERVICES, NOTICES & DOWNLOADS, STUDY NOTES
-- ============================================

-- Notary Service Requests
CREATE TABLE IF NOT EXISTS notary_requests (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  customer_name TEXT NOT NULL,
  customer_email TEXT,
  customer_phone TEXT NOT NULL,
  service_type TEXT NOT NULL,
  sub_service_type TEXT,
  message TEXT,
  file_url TEXT,
  drive_link TEXT,
  status TEXT DEFAULT 'pending',
  admin_notes TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Enable RLS and add policies for notary_requests
ALTER TABLE notary_requests ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_insert_notary_requests" ON notary_requests;
CREATE POLICY "public_insert_notary_requests" ON notary_requests FOR INSERT WITH CHECK (true);
DROP POLICY IF EXISTS "admin_all_notary_requests" ON notary_requests;
CREATE POLICY "admin_all_notary_requests" ON notary_requests FOR ALL USING (public.is_admin());

-- Notices and News/Downloads
CREATE TABLE IF NOT EXISTS notices_downloads (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  content TEXT,
  type TEXT DEFAULT 'Notice', -- 'Notice', 'News', 'Download'
  file_url TEXT, -- for downloads or notice attachments
  is_active BOOLEAN DEFAULT TRUE,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Enable RLS and add policies for notices_downloads
ALTER TABLE notices_downloads ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_read_notices_downloads" ON notices_downloads;
CREATE POLICY "public_read_notices_downloads" ON notices_downloads FOR SELECT USING (is_active = true);
DROP POLICY IF EXISTS "admin_all_notices_downloads" ON notices_downloads;
CREATE POLICY "admin_all_notices_downloads" ON notices_downloads FOR ALL USING (public.is_admin());

-- Study Notes
CREATE TABLE IF NOT EXISTS notes (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  subject TEXT,
  class_level TEXT,
  file_url TEXT,
  description TEXT,
  content TEXT,
  is_active BOOLEAN DEFAULT TRUE,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Keep existing projects compatible when this schema is re-run after notes
-- already existed with file-only content.
ALTER TABLE notes ADD COLUMN IF NOT EXISTS content TEXT;
ALTER TABLE notes ALTER COLUMN file_url DROP NOT NULL;

-- Enable RLS and add policies for notes
ALTER TABLE notes ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_read_notes" ON notes;
CREATE POLICY "public_read_notes" ON notes FOR SELECT USING (is_active = true);
DROP POLICY IF EXISTS "admin_all_notes" ON notes;
CREATE POLICY "admin_all_notes" ON notes FOR ALL USING (public.is_admin());

-- Storage Bucket creation and policies (for documents upload)
INSERT INTO storage.buckets (id, name, public)
VALUES ('documents', 'documents', true)
ON CONFLICT (id) DO NOTHING;

-- Policies for documents bucket inside storage.objects
-- Public read access only; write operations restricted to admin users
DROP POLICY IF EXISTS "Public Access" ON storage.objects;
DROP POLICY IF EXISTS "Public Read Access" ON storage.objects;
CREATE POLICY "Public Read Access" ON storage.objects FOR SELECT USING (bucket_id = 'documents');

-- Remove dangerous public write policies
DROP POLICY IF EXISTS "Public Upload" ON storage.objects;
DROP POLICY IF EXISTS "Public Update" ON storage.objects;
DROP POLICY IF EXISTS "Public Delete" ON storage.objects;

-- Admin-only write access (service-role key bypasses RLS for API route uploads)
DROP POLICY IF EXISTS "Admin Upload" ON storage.objects;
CREATE POLICY "Admin Upload" ON storage.objects
  FOR INSERT WITH CHECK (bucket_id = 'documents' AND public.is_admin());
DROP POLICY IF EXISTS "Admin Update" ON storage.objects;
CREATE POLICY "Admin Update" ON storage.objects
  FOR UPDATE USING (bucket_id = 'documents' AND public.is_admin());
DROP POLICY IF EXISTS "Admin Delete" ON storage.objects;
CREATE POLICY "Admin Delete" ON storage.objects
  FOR DELETE USING (bucket_id = 'documents' AND public.is_admin());

-- Seed settings for banner popup
INSERT INTO site_settings (key, value) VALUES
('banner_notice_active', 'false'),
('banner_notice_text', 'Welcome to Fonet Stationery Center! Check out our new Notary services.'),
('banner_notice_image_url', '')
ON CONFLICT (key) DO NOTHING;
