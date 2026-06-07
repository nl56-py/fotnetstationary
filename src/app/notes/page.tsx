'use client'
import React, { useState, useEffect } from 'react'
import Header from '@/components/layout/Header'
import Footer from '@/components/layout/Footer'
import { createClient } from '@/lib/supabase/client'

interface NoteItem {
  id: string
  title: string
  subject: string | null
  class_level: string | null
  file_url: string
  description: string | null
  created_at: string
}

const defaultNotes: NoteItem[] = [
  {
    id: 'note1',
    title: 'SEE Computer Science Short Q&A & Definitions',
    subject: 'Computer Science',
    class_level: 'Class 10 (SEE)',
    file_url: '/notes/SEE_Computer_Science_Notes.pdf',
    description: 'Comprehensive short answer questions, technical terms, database queries, and programming tips for SEE Computer Science exams.',
    created_at: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000).toISOString()
  },
  {
    id: 'note2',
    title: 'Grade 11 English Solutions - Comprehensive Grammar Guide',
    subject: 'English',
    class_level: 'Class 11',
    file_url: '/notes/Grade11_English_Grammar_Guide.pdf',
    description: 'Detailed explanations of English grammar chapters, syntax rules, letter writing formats, and literature summaries.',
    created_at: new Date(Date.now() - 12 * 24 * 60 * 60 * 1000).toISOString()
  },
  {
    id: 'note3',
    title: 'Grade 12 Business Studies - Principles of Management Notes',
    subject: 'Business Studies',
    class_level: 'Class 12',
    file_url: '/notes/Grade12_Business_Studies_Chapter1.pdf',
    description: 'Important concepts on Planning, Organizing, Staffing, Directing, and Controlling for HSEB Grade 12 students.',
    created_at: new Date(Date.now() - 18 * 24 * 60 * 60 * 1000).toISOString()
  },
  {
    id: 'note4',
    title: 'BBS 1st Year Business Mathematics Lecture Notes',
    subject: 'Mathematics',
    class_level: 'Bachelor',
    file_url: '/notes/BBS_1st_Year_Business_Math.pdf',
    description: 'Detailed lectures and practice questions covering Matrices, Determinants, Calculus, and Coordinate Geometry.',
    created_at: new Date(Date.now() - 25 * 24 * 60 * 60 * 1000).toISOString()
  },
  {
    id: 'note5',
    title: 'MBA 2nd Semester Strategic Management Cases & Guides',
    subject: 'Business Studies',
    class_level: 'Master',
    file_url: '/notes/MBA_Strategic_Management.pdf',
    description: 'Case study guides, SWOT analyses templates, BCG matrix examples, and Porter Five Forces notes for MBA students.',
    created_at: new Date(Date.now() - 40 * 24 * 60 * 60 * 1000).toISOString()
  }
]

const subjects = ['All', 'Computer Science', 'English', 'Mathematics', 'Nepali', 'Science', 'Business Studies', 'Accountancy', 'Social Studies']
const classLevels = ['All', 'Class 10 (SEE)', 'Class 11', 'Class 12', 'Bachelor', 'Master']

export default function NotesPage() {
  const [items, setItems] = useState<NoteItem[]>([])
  const [loading, setLoading] = useState(true)
  
  // Search & Filter state
  const [searchQuery, setSearchQuery] = useState('')
  const [selectedSubject, setSelectedSubject] = useState('All')
  const [selectedLevel, setSelectedLevel] = useState('All')

  useEffect(() => {
    async function fetchNotes() {
      try {
        const supabase = createClient()
        const { data, error } = await supabase
          .from('notes')
          .select('*')
          .eq('is_active', true)
          .order('sort_order', { ascending: true })
          .order('created_at', { ascending: false })

        if (error) throw error

        if (data && data.length > 0) {
          setItems(data)
        } else {
          setItems(defaultNotes)
        }
      } catch (err) {
        console.error('Error fetching academic notes', err)
        setItems(defaultNotes)
      } finally {
        setLoading(false)
      }
    }
    fetchNotes()
  }, [])

  const filteredNotes = items.filter(note => {
    const matchesSubject = selectedSubject === 'All' || note.subject === selectedSubject
    const matchesLevel = selectedLevel === 'All' || note.class_level === selectedLevel
    const matchesSearch = note.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          (note.description && note.description.toLowerCase().includes(searchQuery.toLowerCase()))

    return matchesSubject && matchesLevel && matchesSearch
  })

  return (
    <div>
      <Header />

      {/* Page Header */}
      <div className="inner-banner">
        <div className="container">
          <h1>Academic & Class Notes</h1>
          <ul className="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Academic Notes</li>
          </ul>
        </div>
      </div>

      <div className="notes-section-area" style={{ padding: '70px 0', background: '#f8f9fa' }}>
        <div className="container">
          <div className="head_white head_center" style={{ marginBottom: 40 }}>
            <div className="title-dot"></div>
            <div className="section-title">
              <div className="sub-title">STUDENT RESOURCES</div>
              <h2>ACADEMIC NOTES & SYLLABUS</h2>
            </div>
          </div>

          <p className="notes-intro-text" style={{ textAlign: 'center', maxWidth: 800, margin: '0 auto 50px auto', fontSize: 16, lineHeight: 1.7, color: '#555' }}>
            Browse and download study materials, class notes, lecture summaries, and exam formats. Use the filters below to sort notes by subject and class levels (Class 10 - Master).
          </p>

          <div className="row">
            {/* Left Column: Filter Sidebar */}
            <div className="col-lg-3 col-md-3 col-sm-12 col-xs-12" style={{ marginBottom: 30 }}>
              <div className="filters-panel" style={{
                background: '#fff',
                padding: 25,
                borderRadius: 12,
                border: '1px solid #eee',
                boxShadow: '0 4px 15px rgba(0,0,0,0.03)'
              }}>
                <h3 style={{ fontFamily: "'Oswald', sans-serif", fontSize: 18, color: '#333', marginBottom: 20, paddingBottom: 10, borderBottom: '1px solid #eee' }}>
                  <i className="fa fa-filter" style={{ marginRight: 8, color: '#3347B0' }}></i> Filters
                </h3>

                {/* Level Filter */}
                <div style={{ marginBottom: 25 }}>
                  <label style={{ display: 'block', fontSize: 13, fontWeight: 600, color: '#555', marginBottom: 10 }}>Academic Level</label>
                  <div style={{ display: 'flex', flexDirection: 'column', gap: 8 }}>
                    {classLevels.map((lvl) => (
                      <button
                        key={lvl}
                        onClick={() => setSelectedLevel(lvl)}
                        style={{
                          textAlign: 'left',
                          padding: '8px 12px',
                          borderRadius: 6,
                          border: 'none',
                          fontSize: 13,
                          cursor: 'pointer',
                          background: selectedLevel === lvl ? '#3347B0' : '#f5f5f5',
                          color: selectedLevel === lvl ? '#fff' : '#444',
                          fontWeight: selectedLevel === lvl ? 600 : 400,
                          transition: 'all 0.2s'
                        }}
                      >
                        {lvl === 'All' ? 'All Levels' : lvl}
                      </button>
                    ))}
                  </div>
                </div>

                {/* Subject Filter */}
                <div>
                  <label style={{ display: 'block', fontSize: 13, fontWeight: 600, color: '#555', marginBottom: 10 }}>Subject</label>
                  <div style={{ display: 'flex', flexDirection: 'column', gap: 8 }}>
                    {subjects.map((sub) => (
                      <button
                        key={sub}
                        onClick={() => setSelectedSubject(sub)}
                        style={{
                          textAlign: 'left',
                          padding: '8px 12px',
                          borderRadius: 6,
                          border: 'none',
                          fontSize: 13,
                          cursor: 'pointer',
                          background: selectedSubject === sub ? '#3347B0' : '#f5f5f5',
                          color: selectedSubject === sub ? '#fff' : '#444',
                          fontWeight: selectedSubject === sub ? 600 : 400,
                          transition: 'all 0.2s'
                        }}
                      >
                        {sub === 'All' ? 'All Subjects' : sub}
                      </button>
                    ))}
                  </div>
                </div>
              </div>
            </div>

            {/* Right Column: Search & Notes Grid */}
            <div className="col-lg-9 col-md-9 col-sm-12 col-xs-12">
              {/* Search Bar */}
              <div className="search-bar-container" style={{
                background: '#fff',
                padding: '15px 20px',
                borderRadius: 12,
                border: '1px solid #eee',
                boxShadow: '0 4px 15px rgba(0,0,0,0.02)',
                marginBottom: 30,
                position: 'relative'
              }}>
                <input
                  type="text"
                  placeholder="Search by topic, keyword, or course title..."
                  value={searchQuery}
                  onChange={e => setSearchQuery(e.target.value)}
                  style={{
                    width: '100%',
                    padding: '12px 40px 12px 15px',
                    borderRadius: 8,
                    border: '1px solid #ddd',
                    fontSize: 14,
                    boxSizing: 'border-box'
                  }}
                />
                <i className="fa fa-search" style={{ position: 'absolute', right: 35, top: '50%', transform: 'translateY(-50%)', color: '#888', fontSize: 16 }}></i>
              </div>

              {loading ? (
                <div style={{ display: 'flex', justifyContent: 'center', padding: '100px 0' }}>
                  <div className="spinner"></div>
                </div>
              ) : (
                <div>
                  {filteredNotes.length === 0 ? (
                    <div style={{ textAlign: 'center', padding: '80px 20px', background: '#fff', borderRadius: 12, border: '1px solid #eee' }}>
                      <i className="fa fa-book" style={{ fontSize: 55, color: '#ccc', marginBottom: 15 }}></i>
                      <h3 style={{ margin: 0, color: '#666', fontSize: 18 }}>No academic notes match your filters.</h3>
                      <p style={{ color: '#888', marginTop: 10 }}>Try adjusting your search keywords or setting filters to &quot;All&quot;.</p>
                    </div>
                  ) : (
                    <div className="row" style={{ display: 'flex', flexWrap: 'wrap', gap: 20 }}>
                      {filteredNotes.map(note => (
                        <div key={note.id} className="col-xs-12" style={{ width: '100%' }}>
                          <div className="note-item-card" style={{
                            background: '#fff',
                            padding: 25,
                            borderRadius: 12,
                            border: '1px solid #eee',
                            boxShadow: '0 4px 15px rgba(0,0,0,0.03)',
                            display: 'flex',
                            flexDirection: 'column',
                            gap: 15,
                            transition: 'transform 0.2s',
                          }}>
                            {/* Card Top Info */}
                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', flexWrap: 'wrap', gap: 10 }}>
                              <div>
                                <div style={{ display: 'flex', gap: 8, marginBottom: 8, flexWrap: 'wrap' }}>
                                  {note.class_level && (
                                    <span style={{ fontSize: 11, fontWeight: 600, background: '#eef1ff', color: '#3347B0', padding: '3px 8px', borderRadius: 4 }}>
                                      {note.class_level}
                                    </span>
                                  )}
                                  {note.subject && (
                                    <span style={{ fontSize: 11, fontWeight: 600, background: '#e1f5fe', color: '#0288d1', padding: '3px 8px', borderRadius: 4 }}>
                                      {note.subject}
                                    </span>
                                  )}
                                </div>
                                <h3 style={{ margin: 0, fontSize: 17, fontWeight: 700, color: '#222' }}>{note.title}</h3>
                              </div>

                              <a
                                href={note.file_url}
                                download
                                target="_blank"
                                rel="noopener noreferrer"
                                style={{
                                  padding: '8px 18px',
                                  background: '#3347B0',
                                  color: '#fff',
                                  border: 'none',
                                  borderRadius: 8,
                                  fontWeight: 600,
                                  fontSize: 13,
                                  display: 'flex',
                                  alignItems: 'center',
                                  gap: 6,
                                  textDecoration: 'none',
                                  transition: 'all 0.3s'
                                }}
                              >
                                <i className="fa fa-download"></i> Get Note (PDF)
                              </a>
                            </div>

                            {/* Description */}
                            <p style={{ margin: 0, fontSize: 14, color: '#555', lineHeight: 1.6 }}>
                              {note.description}
                            </p>

                            {/* Card Footer */}
                            <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: 12, color: '#888', borderTop: '1px solid #f9f9f9', paddingTop: 12 }}>
                              <span>
                                <i className="fa fa-calendar-o" style={{ marginRight: 6 }}></i>
                                Uploaded on: {new Date(note.created_at).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' })}
                              </span>
                              <span>
                                <i className="fa fa-file-text-o" style={{ marginRight: 6 }}></i>
                                Format: PDF
                              </span>
                            </div>
                          </div>
                        </div>
                      ))}
                    </div>
                  )}
                </div>
              )}
            </div>
          </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}
