-- ============================================
-- POPUP BANNERS - Multiple sequential popup banners
-- Run this in your Supabase SQL Editor
-- ============================================

CREATE TABLE IF NOT EXISTS popup_banners (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  title TEXT NOT NULL,
  content TEXT,
  image_url TEXT,
  sort_order INT DEFAULT 0,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Enable RLS
ALTER TABLE popup_banners ENABLE ROW LEVEL SECURITY;

-- Public read access (only active banners)
DROP POLICY IF EXISTS "public_read_popup_banners" ON popup_banners;
CREATE POLICY "public_read_popup_banners" ON popup_banners FOR SELECT USING (is_active = true);

-- Admin full access
DROP POLICY IF EXISTS "admin_all_popup_banners" ON popup_banners;
CREATE POLICY "admin_all_popup_banners" ON popup_banners FOR ALL USING (public.is_admin());
