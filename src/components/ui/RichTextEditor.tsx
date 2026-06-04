'use client'
import { useEditor, EditorContent } from '@tiptap/react'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import Image from '@tiptap/extension-image'

interface RichTextEditorProps {
  content: string
  onChange: (content: string) => void
}

export default function RichTextEditor({ content, onChange }: RichTextEditorProps) {
  const editor = useEditor({
    extensions: [
      StarterKit,
      Link.configure({ openOnClick: false }),
      Image,
    ],
    content,
    onUpdate: ({ editor }) => {
      onChange(editor.getHTML())
    },
  })

  if (!editor) {
    return null
  }

  return (
    <div style={{ border: '1px solid #e0e0e0', borderRadius: 8, overflow: 'hidden', background: '#fff' }}>
      <div style={{ background: '#f8f9fa', padding: '8px 12px', borderBottom: '1px solid #e0e0e0', display: 'flex', gap: 5, flexWrap: 'wrap' }}>
        <button
          type="button"
          onClick={() => editor.chain().focus().toggleBold().run()}
          style={{
            background: editor.isActive('bold') ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontWeight: 700
          }}
        >
          B
        </button>
        <button
          type="button"
          onClick={() => editor.chain().focus().toggleItalic().run()}
          style={{
            background: editor.isActive('italic') ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontStyle: 'italic'
          }}
        >
          I
        </button>
        <button
          type="button"
          onClick={() => editor.chain().focus().toggleHeading({ level: 2 }).run()}
          style={{
            background: editor.isActive('heading', { level: 2 }) ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontSize: 13, fontWeight: 600
          }}
        >
          H2
        </button>
        <button
          type="button"
          onClick={() => editor.chain().focus().toggleHeading({ level: 3 }).run()}
          style={{
            background: editor.isActive('heading', { level: 3 }) ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontSize: 13, fontWeight: 600
          }}
        >
          H3
        </button>
        <button
          type="button"
          onClick={() => editor.chain().focus().toggleBulletList().run()}
          style={{
            background: editor.isActive('bulletList') ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontSize: 13
          }}
        >
          List
        </button>
        <button
          type="button"
          onClick={() => {
            const url = window.prompt('URL')
            if (url) {
              editor.chain().focus().setImage({ src: url }).run()
            }
          }}
          style={{
            background: 'none', border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontSize: 13
          }}
        >
          Img
        </button>
      </div>
      <EditorContent 
        editor={editor} 
        style={{ padding: '16px', minHeight: '300px', outline: 'none', cursor: 'text' }}
        className="prose max-w-none"
      />
    </div>
  )
}
