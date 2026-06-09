import type { Metadata } from 'next'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createServerSupabaseClient } from '@/lib/supabase/server'
import Link from 'next/link'

export const revalidate = 0; // Disable static caching so prices are always live

export const metadata: Metadata = {
  title: "Our Price List - Fonet Stationary Center",
  description: "Browse affordable pricing rates for photocopy, black & white and color laser printing, custom self stamps, PVC ID cards, visiting cards, lamination, and thesis typing at Fonet Chitwan.",
}

interface PricingItem {
  id: string
  sn: number | null
  service_name: string
  category: string
  price: string | null
  notes: string | null
}

const defaultPricingData = [
  { category: 'STATIONARY', items: [
    { sn: 1, service_name: 'Stationary Services', price: 'Contact Us', notes: '' },
    { sn: 2, service_name: 'Typing/Binding (Spiral+Ring)', price: 'Contact Us', notes: '' },
  ]},
  { category: 'PRINT AND PHOTOCOPY', items: [
    { sn: 1, service_name: 'Photocopy', price: 'Contact Us', notes: '' },
    { sn: 2, service_name: 'Print', price: 'Contact Us', notes: '' },
  ]}
]

export default async function PricingPage() {
  const supabase = await createServerSupabaseClient()
  
  let groupedData: { category: string; items: PricingItem[] }[] = []
  let hasData = false

  try {
    const { data: dbItems, error } = await supabase
      .from('pricing_items')
      .select('*')
      .eq('is_active', true)
      .order('sort_order', { ascending: true })

    if (!error && dbItems && dbItems.length > 0) {
      hasData = true
      // Extract categories in order of appearance
      const categoryOrder: string[] = []
      dbItems.forEach(item => {
        if (item.category && !categoryOrder.includes(item.category)) {
          categoryOrder.push(item.category)
        }
      })

      groupedData = categoryOrder.map(cat => ({
        category: cat,
        items: dbItems.filter(item => item.category === cat)
      }))
    }
  } catch (err) {
    console.error('Failed to fetch pricing items', err)
  }

  // Fallback to default styling/data if empty
  const displayData = hasData ? groupedData : defaultPricingData

  return (
    <div>
      <Header />
      <div className="inner-banner">
        <div className="container">
          <h1>Pricing</h1>
          <ul className="breadcrumb">
            <li><Link href="/">Home</Link></li>
            <li>Pricing</li>
          </ul>
        </div>
      </div>

      <div className="pricing-area" style={{ padding: '60px 0', background: '#f8f9fa' }}>
        <div className="container">
          <div className="head_white head_center" style={{ marginBottom: 20 }}>
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">OUR</div>
              <h2>PRICE LIST</h2>
            </div>
          </div>
          <p style={{ textAlign: 'center', color: '#666', marginBottom: 50, fontSize: 15, maxWidth: '600px', margin: '0 auto 40px auto', lineHeight: 1.6 }}>
            Our pricing is transparent and highly competitive. Below is the list of our standard rates. For bulk orders or specialized design requests, please reach out to us!
          </p>

          {displayData.map((group: any, gIdx) => (
            <div key={gIdx} style={{ 
              background: '#fff', 
              borderRadius: 12, 
              boxShadow: '0 4px 20px rgba(0,0,0,0.03)', 
              overflow: 'hidden', 
              marginBottom: 40,
              border: '1px solid #eee'
            }}>
              {/* Category Header */}
              <div style={{ 
                background: 'linear-gradient(90deg, #3347B0 0%, #1c2a7f 100%)', 
                padding: '16px 24px', 
                color: '#fff',
                fontSize: 16,
                fontWeight: 700,
                fontFamily: "'Oswald', sans-serif",
                textTransform: 'uppercase',
                letterSpacing: 1
              }}>
                {group.category}
              </div>

              {/* Responsive Table */}
              <div style={{ overflowX: 'auto' }}>
                <table style={{ width: '100%', borderCollapse: 'collapse', minWidth: '600px' }}>
                  <thead>
                    <tr style={{ background: '#fafafa', borderBottom: '1px solid #eee' }}>
                      <th style={{ padding: '15px 24px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600, width: 80 }}>S.N</th>
                      <th style={{ padding: '15px 24px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Services</th>
                      <th style={{ padding: '15px 24px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600, width: 150 }}>Price</th>
                      <th style={{ padding: '15px 24px', textAlign: 'left', fontSize: 13, color: '#888', fontWeight: 600 }}>Notes</th>
                    </tr>
                  </thead>
                  <tbody>
                    {group.items.map((item: any, iIdx: number) => (
                      <tr 
                        key={item.id || iIdx} 
                        style={{ 
                          borderBottom: iIdx === group.items.length - 1 ? 'none' : '1px solid #f2f2f2',
                          transition: 'background 0.2s',
                        }}
                        className="pricing-table-row-hover"
                      >
                        <td style={{ padding: '14px 24px', fontSize: 14, color: '#555', fontWeight: 600 }}>{item.sn || iIdx + 1}</td>
                        <td style={{ padding: '14px 24px', fontSize: 14, color: '#333', fontWeight: 600 }}>{item.service_name}</td>
                        <td style={{ padding: '14px 24px', fontSize: 14, color: '#3347B0', fontWeight: 700 }}>
                          {item.price ? item.price : <span style={{ color: '#888', fontWeight: 500, fontSize: 13 }}>Contact us</span>}
                        </td>
                        <td style={{ padding: '14px 24px', fontSize: 13, color: '#777', fontStyle: 'italic' }}>{item.notes || '-'}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          ))}
        </div>
      </div>
      <Footer />
    </div>
  )
}
