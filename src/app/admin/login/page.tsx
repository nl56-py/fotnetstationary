'use client'
import { useState } from 'react'
import { createClient } from '@/lib/supabase/client'
import { useRouter } from 'next/navigation'

export default function AdminLogin() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [error, setError] = useState('')
  const [loading, setLoading] = useState(false)
  const router = useRouter()

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault()
    setLoading(true)
    setError('')

    try {
      const supabase = createClient()
      const { error } = await supabase.auth.signInWithPassword({ email, password })
      if (error) {
        setError(error.message)
      } else {
        router.push('/admin')
      }
    } catch {
      setError('An unexpected error occurred')
    } finally {
      setLoading(false)
    }
  }

  return (
    <div style={{
      minHeight: '100vh',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      background: 'linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%)',
      fontFamily: "'Roboto', sans-serif",
    }}>
      <div style={{
        background: 'rgba(255,255,255,0.05)',
        backdropFilter: 'blur(20px)',
        border: '1px solid rgba(255,255,255,0.1)',
        borderRadius: '16px',
        padding: '40px',
        width: '100%',
        maxWidth: '420px',
        boxShadow: '0 25px 50px rgba(0,0,0,0.3)',
      }}>
        <div style={{ textAlign: 'center', marginBottom: '30px' }}>
          <div style={{
            width: '60px', height: '60px', background: 'linear-gradient(135deg, #3347B0, #5b6fd6)',
            borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center',
            margin: '0 auto 15px', fontSize: '24px', color: '#fff',
          }}>
            <i className="fa fa-lock"></i>
          </div>
          <h2 style={{ color: '#fff', fontFamily: "'Oswald', sans-serif", fontSize: '24px', margin: '0 0 5px' }}>
            Admin Panel
          </h2>
          <p style={{ color: 'rgba(255,255,255,0.6)', fontSize: '14px', margin: 0 }}>
            Fonet Stationary Center
          </p>
        </div>

        <form onSubmit={handleLogin}>
          <div style={{ marginBottom: '16px' }}>
            <input
              type="email"
              placeholder="Email Address"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
              style={{
                width: '100%', padding: '14px 16px', background: 'rgba(255,255,255,0.08)',
                border: '1px solid rgba(255,255,255,0.15)', borderRadius: '10px', color: '#fff',
                fontSize: '14px', outline: 'none', boxSizing: 'border-box',
              }}
            />
          </div>
          <div style={{ marginBottom: '20px' }}>
            <input
              type="password"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
              style={{
                width: '100%', padding: '14px 16px', background: 'rgba(255,255,255,0.08)',
                border: '1px solid rgba(255,255,255,0.15)', borderRadius: '10px', color: '#fff',
                fontSize: '14px', outline: 'none', boxSizing: 'border-box',
              }}
            />
          </div>

          {error && (
            <div style={{
              background: 'rgba(220,53,69,0.15)', border: '1px solid rgba(220,53,69,0.3)',
              color: '#ff6b7a', padding: '10px 14px', borderRadius: '8px', marginBottom: '16px', fontSize: '13px',
            }}>
              {error}
            </div>
          )}

          <button
            type="submit"
            disabled={loading}
            style={{
              width: '100%', padding: '14px', background: 'linear-gradient(135deg, #3347B0, #5b6fd6)',
              color: '#fff', border: 'none', borderRadius: '10px', fontSize: '16px',
              fontWeight: 600, cursor: loading ? 'not-allowed' : 'pointer',
              opacity: loading ? 0.7 : 1, fontFamily: "'Oswald', sans-serif",
              textTransform: 'uppercase', letterSpacing: '1px',
              transition: 'all 0.3s ease',
            }}
          >
            {loading ? 'Signing in...' : 'Sign In'}
          </button>
        </form>

        <div style={{ textAlign: 'center', marginTop: '20px' }}>
          <a href="/" style={{ color: 'rgba(255,255,255,0.5)', fontSize: '13px' }}>
            ← Back to Website
          </a>
        </div>
      </div>
    </div>
  )
}
