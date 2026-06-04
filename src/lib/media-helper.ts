/**
 * Utility functions for parsing and converting media URLs
 * (Google Drive shareable links, YouTube, Shorts, social media platforms)
 */

/**
 * Checks if a URL is a Google Drive share link and converts it to a direct image link
 */
export function getImageSrc(url: string | null | undefined): string {
  if (!url) return '';

  const trimmed = url.trim();

  // Handle Google Drive links
  if (trimmed.includes('drive.google.com')) {
    // Format 1: https://drive.google.com/file/d/FILE_ID/view?usp=sharing
    const fileDMatch = trimmed.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
    if (fileDMatch && fileDMatch[1]) {
      return `https://drive.google.com/uc?export=view&id=${fileDMatch[1]}`;
    }

    // Format 2: https://drive.google.com/open?id=FILE_ID
    const openIdMatch = trimmed.match(/[?&]id=([a-zA-Z0-9_-]+)/);
    if (openIdMatch && openIdMatch[1]) {
      return `https://drive.google.com/uc?export=view&id=${openIdMatch[1]}`;
    }
  }

  return trimmed;
}

/**
 * Parses any video URL (YouTube, Drive, Instagram, Facebook, TikTok, direct video files)
 * and returns the appropriate iframe embed URL or flags if it's a direct HTML5 video.
 */
export function getVideoEmbedInfo(url: string | null | undefined): {
  embedUrl: string;
  isDirectVideo: boolean;
} {
  if (!url) return { embedUrl: '', isDirectVideo: false };

  const trimmed = url.trim();

  // 1. Direct video files
  const lowerUrl = trimmed.toLowerCase();
  if (
    lowerUrl.endsWith('.mp4') ||
    lowerUrl.endsWith('.webm') ||
    lowerUrl.endsWith('.ogg') ||
    lowerUrl.includes('.mp4?') ||
    lowerUrl.includes('.webm?')
  ) {
    return { embedUrl: trimmed, isDirectVideo: true };
  }

  try {
    // 2. YouTube Standard Video
    if (trimmed.includes('youtube.com/watch')) {
      const urlObj = new URL(trimmed);
      const v = urlObj.searchParams.get('v');
      if (v) {
        return { embedUrl: `https://www.youtube.com/embed/${v}`, isDirectVideo: false };
      }
    }

    // 3. YouTube Short Link
    if (trimmed.includes('youtu.be/')) {
      const parts = trimmed.split('youtu.be/');
      if (parts[1]) {
        const v = parts[1].split('?')[0];
        return { embedUrl: `https://www.youtube.com/embed/${v}`, isDirectVideo: false };
      }
    }

    // 4. YouTube Shorts
    if (trimmed.includes('youtube.com/shorts/')) {
      const match = trimmed.match(/\/shorts\/([a-zA-Z0-9_-]+)/);
      if (match && match[1]) {
        return { embedUrl: `https://www.youtube.com/embed/${match[1]}`, isDirectVideo: false };
      }
    }

    // 5. Google Drive Video
    if (trimmed.includes('drive.google.com/file/d/')) {
      const fileDMatch = trimmed.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
      if (fileDMatch && fileDMatch[1]) {
        return {
          embedUrl: `https://drive.google.com/file/d/${fileDMatch[1]}/preview`,
          isDirectVideo: false,
        };
      }
    }

    // 6. Instagram (Post or Reel)
    // E.g. https://www.instagram.com/p/CODE/ or https://www.instagram.com/reel/CODE/
    if (trimmed.includes('instagram.com/p/') || trimmed.includes('instagram.com/reel/')) {
      const match = trimmed.match(/\/(p|reel)\/([a-zA-Z0-9_-]+)/);
      if (match && match[2]) {
        return {
          embedUrl: `https://www.instagram.com/p/${match[2]}/embed/captioned/`,
          isDirectVideo: false,
        };
      }
    }

    // 7. Facebook Video
    // E.g. https://www.facebook.com/watch/?v=VIDEO_ID or https://www.facebook.com/user/videos/VIDEO_ID
    if (trimmed.includes('facebook.com/')) {
      const encodedUrl = encodeURIComponent(trimmed);
      return {
        embedUrl: `https://www.facebook.com/plugins/video.php?href=${encodedUrl}&show_text=false&t=0`,
        isDirectVideo: false,
      };
    }

    // 8. TikTok Video
    // E.g. https://www.tiktok.com/@user/video/VIDEO_ID
    if (trimmed.includes('tiktok.com/') && trimmed.includes('/video/')) {
      const match = trimmed.match(/\/video\/([0-9]+)/);
      if (match && match[1]) {
        return {
          embedUrl: `https://www.tiktok.com/embed/v2/${match[1]}`,
          isDirectVideo: false,
        };
      }
    }
  } catch (err) {
    console.error('Error parsing video URL', err);
  }

  // Fallback to original URL
  return { embedUrl: trimmed, isDirectVideo: false };
}
