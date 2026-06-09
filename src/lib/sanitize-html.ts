/**
 * Server-safe HTML sanitizer using an allowlist approach.
 * Works in both Node.js (server components) and the browser.
 *
 * This does NOT rely on DOMParser, so it can be used in RSC / API routes.
 */

/** Tags that are allowed through the sanitizer. */
const ALLOWED_TAGS = new Set([
  'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'strike',
  'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
  'ul', 'ol', 'li',
  'blockquote', 'code', 'pre',
  'a', 'img',
  'table', 'thead', 'tbody', 'tr', 'th', 'td',
  'div', 'span', 'hr',
])

/** Attributes allowed per tag.  `'*'` key applies to all tags. */
const ALLOWED_ATTRS: Record<string, Set<string>> = {
  '*': new Set(['class', 'id']),
  a: new Set(['href', 'title', 'target', 'rel']),
  img: new Set(['src', 'alt', 'title', 'width', 'height', 'loading']),
  td: new Set(['colspan', 'rowspan']),
  th: new Set(['colspan', 'rowspan']),
}

/** Protocols considered safe for href / src attributes. */
const SAFE_URL_PROTOCOLS = /^(?:https?:|mailto:|tel:|\/|#)/i

/**
 * Check whether a URL value is safe to keep.
 */
function isSafeUrl(value: string): boolean {
  const trimmed = value.trim()
  if (!trimmed) return false
  // Relative paths and fragment links are safe
  if (trimmed.startsWith('/') || trimmed.startsWith('#')) return true
  return SAFE_URL_PROTOCOLS.test(trimmed)
}

/**
 * Sanitize a single HTML attribute.
 * Returns the sanitized `key="value"` string, or empty string if the
 * attribute should be removed.
 */
function sanitizeAttribute(tag: string, attrName: string, attrValue: string): string {
  const lowerAttr = attrName.toLowerCase()

  // Block all event handlers
  if (lowerAttr.startsWith('on')) return ''

  // Block style attribute (can contain expressions in old browsers)
  if (lowerAttr === 'style') return ''

  // Check allowlist
  const tagAllowed = ALLOWED_ATTRS[tag]
  const globalAllowed = ALLOWED_ATTRS['*']
  const isAllowed =
    (tagAllowed && tagAllowed.has(lowerAttr)) ||
    (globalAllowed && globalAllowed.has(lowerAttr))

  if (!isAllowed) return ''

  // Validate URL attributes
  if (lowerAttr === 'href' || lowerAttr === 'src') {
    if (!isSafeUrl(attrValue)) return ''
  }

  // Escape the attribute value
  const escaped = attrValue
    .replace(/&/g, '&amp;')
    .replace(/"/g, '&quot;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')

  return ` ${lowerAttr}="${escaped}"`
}

/**
 * Sanitize an HTML string by removing disallowed tags and attributes.
 *
 * - Allowed tags are kept; disallowed tags are stripped (their text content
 *   is kept unless the tag is `script`, `style`, `iframe`, `object`, `embed`,
 *   `form`, or `input`).
 * - Allowed attributes are filtered per-tag; event handlers and `javascript:`
 *   URLs are always removed.
 *
 * @param html - Raw HTML string (may come from a rich text editor / DB)
 * @returns Sanitized HTML string safe for `dangerouslySetInnerHTML`
 */
export function sanitizeHtml(html: string | null | undefined): string {
  if (!html) return ''

  // Tags whose entire content should be removed (not just the tag itself)
  const STRIP_CONTENT_TAGS = /(<\s*(?:script|style|iframe|object|embed|form|input|textarea|select|button)\b[^>]*>[\s\S]*?<\s*\/\s*(?:script|style|iframe|object|embed|form|input|textarea|select|button)\s*>)/gi
  let result = html.replace(STRIP_CONTENT_TAGS, '')

  // Also strip self-closing variants of dangerous tags
  result = result.replace(/<\s*(?:script|style|iframe|object|embed|form|input|textarea|select|button)\b[^>]*\/?>/gi, '')

  // Process remaining tags
  result = result.replace(/<\s*\/?\s*([a-zA-Z][a-zA-Z0-9]*)\b([^>]*)?\s*\/?>/g, (match, tagName, attrsStr) => {
    const tag = tagName.toLowerCase()
    const isClosing = match.trimStart().startsWith('</')

    if (!ALLOWED_TAGS.has(tag)) {
      // Strip the tag but keep content (already handled for dangerous tags above)
      return ''
    }

    if (isClosing) {
      return `</${tag}>`
    }

    // Parse and sanitize attributes
    let sanitizedAttrs = ''
    if (attrsStr) {
      // Match attributes: name="value", name='value', name=value, or standalone name
      const attrRegex = /([a-zA-Z_][\w\-.:]*)\s*(?:=\s*(?:"([^"]*)"|'([^']*)'|([^\s"'=<>`]+)))?/g
      let attrMatch: RegExpExecArray | null
      while ((attrMatch = attrRegex.exec(attrsStr)) !== null) {
        const attrName = attrMatch[1]
        const attrValue = attrMatch[2] ?? attrMatch[3] ?? attrMatch[4] ?? ''
        sanitizedAttrs += sanitizeAttribute(tag, attrName, attrValue)
      }
    }

    // For <a> tags, enforce rel="noopener noreferrer" on external links
    if (tag === 'a' && sanitizedAttrs.includes('href=')) {
      if (!sanitizedAttrs.includes('rel=')) {
        sanitizedAttrs += ' rel="noopener noreferrer"'
      }
      if (!sanitizedAttrs.includes('target=')) {
        sanitizedAttrs += ' target="_blank"'
      }
    }

    // For <img> tags, enforce lazy loading
    if (tag === 'img' && !sanitizedAttrs.includes('loading=')) {
      sanitizedAttrs += ' loading="lazy"'
    }

    const selfClosing = tag === 'br' || tag === 'hr' || tag === 'img'
    return selfClosing ? `<${tag}${sanitizedAttrs} />` : `<${tag}${sanitizedAttrs}>`
  })

  return result
}
