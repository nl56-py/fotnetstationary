'use client'
import { useEffect, useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import type { PricingItem } from '@/lib/types'

export default function AdminPricing() {
  const [items, setItems] = useState<PricingItem[]>([])
  const [loading, setLoading] = useState(true)
  const [editingId, setEditingId] = useState<string | null>(null)
  const [editingItem, setEditingItem] = useState<Partial<PricingItem> | null>(null)
  
  const [showAdd, setShowAdd] = useState(false)
  const [newItem, setNewItem] = useState({ sn: 1, service_name: '', category: 'PRINT AND PHOTOCOPY', price: '', notes: '' })

  const supabase = createClient()
  const categories = ['STATIONARY', 'PRINT AND PHOTOCOPY', 'OTHERS']

  const fetchItems = async () => {
    const { data } = await supabase.from('pricing_items').select('*').order('sort_order')
    setItems(data || [])
    setLoading(false)
  }

  useEffect(() => { fetchItems() }, [])

  const startEditing = (item: PricingItem) => {
    setEditingId(item.id)
    setEditingItem({ ...item })
  }

  const cancelEditing = () => {
    setEditingId(null)
    setEditingItem(null)
  }

  const saveEdit = async (id: string) => {
    if (!editingItem) return
    if (!editingItem.service_name) return alert('Service name is required')

    const { error } = await supabase
      .from('pricing_items')
      .update({
        sn: editingItem.sn,
        service_name: editingItem.service_name,
        category: editingItem.category,
        price: editingItem.price,
        notes: editingItem.notes,
        updated_at: new Date().toISOString()
      })
      .eq('id', id)

    if (error) {
      alert('Error updating: ' + error.message)
    } else {
      setItems(items.map(i => i.id === id ? (editingItem as PricingItem) : i))
      setEditingId(null)
      setEditingItem(null)
      fetchItems()
    }
  }

  const addItem = async () => {
    if (!newItem.service_name) return alert('Service Name is required')
    
    const { error } = await supabase.from('pricing_items').insert({
      ...newItem,
      sort_order: items.length + 1
    })

    if (error) {
      alert('Error adding item: ' + error.message)
    } else {
      setNewItem({ sn: 1, service_name: '', category: 'PRINT AND PHOTOCOPY', price: '', notes: '' })
      setShowAdd(false)
      fetchItems()
    }
  }

  const deleteItem = async (id: string) => {
    if (confirm('Delete this pricing item?')) {
      const { error } = await supabase.from('pricing_items').delete().eq('id', id)
      if (error) alert('Error: ' + error.message)
      else fetchItems()
    }
  }

  if (loading) return <div className="loading-spinner"><div className="spinner"></div></div>

  const grouped = categories.map(cat => ({
    category: cat,
    items: items.filter(i => i.category === cat),
  }))

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: 20 }}>
        <p style={{ color: '#666', margin: 0, fontSize: 14 }}>Manage pricing for services displayed on the public pricing page.</p>
        {!showAdd && (
          <button onClick={() => setShowAdd(true)}
            style={{ padding: '10px 20px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600, display: 'flex', alignItems: 'center', gap: 8 }}>
            <i className="fa fa-plus"></i>Add Item
          </button>
        )}
      </div>

      {showAdd && (
        <div style={{ background: '#fff', borderRadius: 12, padding: 25, marginBottom: 25, boxShadow: '0 4px 20px rgba(0,0,0,0.05)' }}>
          <h4 style={{ margin: '0 0 20px 0', fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#3347B0' }}>Add Pricing Item</h4>
          <div style={{ display: 'grid', gridTemplateColumns: '80px 2fr 1.5fr 1fr 2fr', gap: 12, marginBottom: 15 }}>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>S.N</label>
              <input type="number" placeholder="S.N" value={newItem.sn} onChange={e => setNewItem({ ...newItem, sn: parseInt(e.target.value) || 1 })}
                style={{ padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13 }} />
            </div>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Service Name</label>
              <input placeholder="e.g. Printing (Both Side)" value={newItem.service_name} onChange={e => setNewItem({ ...newItem, service_name: e.target.value })}
                style={{ padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13 }} />
            </div>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Category</label>
              <select value={newItem.category} onChange={e => setNewItem({ ...newItem, category: e.target.value })}
                style={{ padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13, height: '37px' }}>
                {categories.map(c => <option key={c} value={c}>{c}</option>)}
              </select>
            </div>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Price</label>
              <input placeholder="e.g. Rs. 10 / page" value={newItem.price} onChange={e => setNewItem({ ...newItem, price: e.target.value })}
                style={{ padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13 }} />
            </div>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
              <label style={{ fontSize: 12, color: '#666', fontWeight: 600 }}>Notes / Detail</label>
              <input placeholder="e.g. Price for bulk quantity" value={newItem.notes} onChange={e => setNewItem({ ...newItem, notes: e.target.value })}
                style={{ padding: 10, border: '1px solid #e0e0e0', borderRadius: 6, fontSize: 13 }} />
            </div>
          </div>
          <div style={{ display: 'flex', gap: 10 }}>
            <button onClick={addItem} style={{ padding: '10px 25px', background: '#3347B0', color: '#fff', border: 'none', borderRadius: 8, cursor: 'pointer', fontWeight: 600 }}>Save</button>
            <button onClick={() => setShowAdd(false)} style={{ padding: '10px 25px', background: '#e0e0e0', color: '#333', border: 'none', borderRadius: 8, cursor: 'pointer' }}>Cancel</button>
          </div>
        </div>
      )}

      {grouped.map(group => (
        <div key={group.category} style={{ background: '#fff', borderRadius: 12, overflow: 'hidden', boxShadow: '0 2px 12px rgba(0,0,0,0.04)', marginBottom: 25, border: '1px solid #f0f0f0' }}>
          <div style={{ background: '#eef1ff', padding: '15px 20px', fontWeight: 700, color: '#3347B0', fontFamily: "'Oswald', sans-serif", fontSize: 16 }}>
            {group.category} ({group.items.length} items)
          </div>
          <table style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr style={{ borderBottom: '1px solid #e0e0e0', background: '#fafafa' }}>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 12, color: '#666', fontWeight: 600, width: 80 }}>S.N</th>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 12, color: '#666', fontWeight: 600 }}>Service</th>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 12, color: '#666', fontWeight: 600, width: 180 }}>Price</th>
                <th style={{ padding: '12px 20px', textAlign: 'left', fontSize: 12, color: '#666', fontWeight: 600 }}>Notes</th>
                <th style={{ padding: '12px 20px', textAlign: 'right', fontSize: 12, color: '#666', fontWeight: 600, width: 120 }}>Actions</th>
              </tr>
            </thead>
            <tbody>
              {group.items.map(item => (
                <tr key={item.id} style={{ borderBottom: '1px solid #f5f5f5', background: editingId === item.id ? '#fcfdff' : 'transparent' }}>
                  {editingId === item.id && editingItem ? (
                    <>
                      <td style={{ padding: '10px 20px' }}>
                        <input type="number" value={editingItem.sn || ''} onChange={e => setEditingItem({ ...editingItem, sn: parseInt(e.target.value) || 0 })}
                          style={{ padding: 6, border: '1px solid #3347B0', borderRadius: 4, width: '100%', fontSize: 13 }} />
                      </td>
                      <td style={{ padding: '10px 20px' }}>
                        <input value={editingItem.service_name || ''} onChange={e => setEditingItem({ ...editingItem, service_name: e.target.value })}
                          style={{ padding: 6, border: '1px solid #3347B0', borderRadius: 4, width: '100%', fontSize: 13 }} />
                      </td>
                      <td style={{ padding: '10px 20px' }}>
                        <input value={editingItem.price || ''} onChange={e => setEditingItem({ ...editingItem, price: e.target.value })}
                          style={{ padding: 6, border: '1px solid #3347B0', borderRadius: 4, width: '100%', fontSize: 13 }} />
                      </td>
                      <td style={{ padding: '10px 20px' }}>
                        <input value={editingItem.notes || ''} onChange={e => setEditingItem({ ...editingItem, notes: e.target.value })}
                          style={{ padding: 6, border: '1px solid #3347B0', borderRadius: 4, width: '100%', fontSize: 13 }} />
                      </td>
                      <td style={{ padding: '10px 20px', textAlign: 'right', display: 'flex', gap: 6, justifyContent: 'flex-end', alignItems: 'center', height: '100%' }}>
                        <button onClick={() => saveEdit(item.id)} style={{ padding: '5px 10px', background: '#2ecc71', color: '#fff', border: 'none', borderRadius: 4, cursor: 'pointer', fontSize: 12 }}>
                          Save
                        </button>
                        <button onClick={cancelEditing} style={{ padding: '5px 10px', background: '#95a5a6', color: '#fff', border: 'none', borderRadius: 4, cursor: 'pointer', fontSize: 12 }}>
                          Cancel
                        </button>
                      </td>
                    </>
                  ) : (
                    <>
                      <td style={{ padding: '12px 20px', fontSize: 14, color: '#333' }}>{item.sn}</td>
                      <td style={{ padding: '12px 20px', fontSize: 14, fontWeight: 600, color: '#333' }}>{item.service_name}</td>
                      <td style={{ padding: '12px 20px', fontSize: 14, color: '#3347B0', fontWeight: 600 }}>{item.price || <span style={{ color: '#aaa', fontStyle: 'italic', fontWeight: 400 }}>Contact us</span>}</td>
                      <td style={{ padding: '12px 20px', fontSize: 13, color: '#888' }}>{item.notes || '-'}</td>
                      <td style={{ padding: '12px 20px', textAlign: 'right' }}>
                        <button onClick={() => startEditing(item)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#3347B0', fontSize: 14, marginRight: 12 }} title="Edit">
                          <i className="fa fa-pencil"></i>
                        </button>
                        <button onClick={() => deleteItem(item.id)} style={{ background: 'none', border: 'none', cursor: 'pointer', color: '#e74c3c', fontSize: 14 }} title="Delete">
                          <i className="fa fa-trash"></i>
                        </button>
                      </td>
                    </>
                  )}
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      ))}
    </div>
  )
}
