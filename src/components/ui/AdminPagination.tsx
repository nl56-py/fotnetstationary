'use client'

interface AdminPaginationProps {
  currentPage: number
  totalItems: number
  itemsPerPage: number
  onPageChange: (page: number) => void
}

export default function AdminPagination({ currentPage, totalItems, itemsPerPage, onPageChange }: AdminPaginationProps) {
  const totalPages = Math.ceil(totalItems / itemsPerPage)

  if (totalPages <= 1) return null

  const startItem = (currentPage - 1) * itemsPerPage + 1
  const endItem = Math.min(currentPage * itemsPerPage, totalItems)

  // Build visible page numbers with ellipsis logic
  const getPageNumbers = (): (number | '...')[] => {
    const pages: (number | '...')[] = []

    if (totalPages <= 7) {
      for (let i = 1; i <= totalPages; i++) pages.push(i)
    } else {
      pages.push(1)
      if (currentPage > 3) pages.push('...')

      const start = Math.max(2, currentPage - 1)
      const end = Math.min(totalPages - 1, currentPage + 1)
      for (let i = start; i <= end; i++) pages.push(i)

      if (currentPage < totalPages - 2) pages.push('...')
      pages.push(totalPages)
    }
    return pages
  }

  const btnBase: React.CSSProperties = {
    padding: '7px 12px',
    border: '1px solid #e0e0e0',
    borderRadius: 6,
    background: '#fff',
    cursor: 'pointer',
    fontSize: 13,
    fontWeight: 600,
    color: '#555',
    transition: 'all 0.15s ease',
    minWidth: 36,
    textAlign: 'center',
  }

  const activeBtnStyle: React.CSSProperties = {
    ...btnBase,
    background: '#3347B0',
    color: '#fff',
    borderColor: '#3347B0',
  }

  const disabledBtnStyle: React.CSSProperties = {
    ...btnBase,
    cursor: 'not-allowed',
    opacity: 0.4,
  }

  return (
    <div style={{
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      padding: '16px 20px',
      background: '#fff',
      borderRadius: '0 0 12px 12px',
      borderTop: '1px solid #f0f0f0',
      flexWrap: 'wrap',
      gap: 12,
    }}>
      <span style={{ fontSize: 13, color: '#888' }}>
        Showing <strong style={{ color: '#333' }}>{startItem}–{endItem}</strong> of{' '}
        <strong style={{ color: '#333' }}>{totalItems}</strong> items
      </span>

      <div style={{ display: 'flex', gap: 6, alignItems: 'center' }}>
        {/* Previous */}
        <button
          onClick={() => onPageChange(currentPage - 1)}
          disabled={currentPage === 1}
          style={currentPage === 1 ? disabledBtnStyle : btnBase}
          title="Previous page"
        >
          <i className="fa fa-chevron-left" style={{ fontSize: 11 }}></i>
        </button>

        {/* Page Numbers */}
        {getPageNumbers().map((p, idx) =>
          p === '...' ? (
            <span key={`ellipsis-${idx}`} style={{ padding: '4px 6px', color: '#aaa', fontSize: 13, userSelect: 'none' }}>…</span>
          ) : (
            <button
              key={p}
              onClick={() => onPageChange(p)}
              style={p === currentPage ? activeBtnStyle : btnBase}
            >
              {p}
            </button>
          )
        )}

        {/* Next */}
        <button
          onClick={() => onPageChange(currentPage + 1)}
          disabled={currentPage === totalPages}
          style={currentPage === totalPages ? disabledBtnStyle : btnBase}
          title="Next page"
        >
          <i className="fa fa-chevron-right" style={{ fontSize: 11 }}></i>
        </button>
      </div>
    </div>
  )
}
