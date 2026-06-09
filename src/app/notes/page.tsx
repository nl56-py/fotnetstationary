import type { Metadata } from 'next'
import NotesClient from './NotesClient'

export const metadata: Metadata = {
  title: "Academic Notes & Syllabus - Fonet Stationary Center",
  description: "Browse free study materials, class notes, lecture summaries, and syllabus templates for SEE (Class 10), Class 11, Class 12, Bachelor, and Master levels.",
}

export default function NotesPage() {
  return <NotesClient />
}
