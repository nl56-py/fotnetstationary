/**
 * Shared input validation helpers for API routes.
 * Provides bounded string validation, email/phone format checks,
 * and a consistent validation result type.
 */

export interface ValidationError {
  field: string
  message: string
}

/**
 * Trim and validate a string field.
 * Returns the trimmed value or null if empty and not required.
 */
export function validateString(
  value: unknown,
  fieldName: string,
  options: { required?: boolean; maxLength?: number } = {}
): { value: string | null; error?: ValidationError } {
  const { required = false, maxLength = 1000 } = options

  if (value === null || value === undefined || value === '') {
    if (required) {
      return { value: null, error: { field: fieldName, message: `${fieldName} is required` } }
    }
    return { value: null }
  }

  if (typeof value !== 'string') {
    return { value: null, error: { field: fieldName, message: `${fieldName} must be a string` } }
  }

  const trimmed = value.trim()

  if (trimmed.length === 0 && required) {
    return { value: null, error: { field: fieldName, message: `${fieldName} is required` } }
  }

  if (trimmed.length > maxLength) {
    return { value: null, error: { field: fieldName, message: `${fieldName} must be ${maxLength} characters or fewer` } }
  }

  return { value: trimmed.length > 0 ? trimmed : null }
}

/**
 * Validate an email address format.
 */
export function validateEmail(
  value: unknown,
  options: { required?: boolean } = {}
): { value: string | null; error?: ValidationError } {
  const result = validateString(value, 'Email', { required: options.required, maxLength: 254 })
  if (result.error || result.value === null) return result

  // Basic email regex — not exhaustive, but catches obvious bad input
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(result.value)) {
    return { value: null, error: { field: 'email', message: 'Invalid email format' } }
  }

  return result
}

/**
 * Validate a phone number format.
 * Allows digits, spaces, dashes, plus sign, and parentheses.
 */
export function validatePhone(
  value: unknown,
  options: { required?: boolean } = {}
): { value: string | null; error?: ValidationError } {
  const result = validateString(value, 'Phone', { required: options.required, maxLength: 30 })
  if (result.error || result.value === null) return result

  const phoneRegex = /^[+]?[\d\s\-().]{6,30}$/
  if (!phoneRegex.test(result.value)) {
    return { value: null, error: { field: 'phone', message: 'Invalid phone number format' } }
  }

  return result
}

/**
 * Validate a URL format.
 */
export function validateUrl(
  value: unknown,
  options: { required?: boolean } = {}
): { value: string | null; error?: ValidationError } {
  const result = validateString(value, 'URL', { required: options.required, maxLength: 2000 })
  if (result.error || result.value === null) return result

  try {
    const url = new URL(result.value)
    if (!['http:', 'https:'].includes(url.protocol)) {
      return { value: null, error: { field: 'url', message: 'URL must use http or https protocol' } }
    }
  } catch {
    return { value: null, error: { field: 'url', message: 'Invalid URL format' } }
  }

  return result
}
