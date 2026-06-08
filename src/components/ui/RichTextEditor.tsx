'use client'
import { useEffect } from 'react'
import { useEditor, EditorContent } from '@tiptap/react'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import Image from '@tiptap/extension-image'
import Placeholder from '@tiptap/extension-placeholder'

interface RichTextEditorProps {
  content: string
  onChange: (content: string) => void
  minHeight?: number
  placeholder?: string
}

export default function RichTextEditor({ content, onChange, minHeight = 300, placeholder }: RichTextEditorProps) {
  const editor = useEditor({
    extensions: [
      StarterKit,
      Link.configure({ openOnClick: false }),
      Image,
      Placeholder.configure({
        placeholder: placeholder || 'Write content...',
      }),
    ],
    content,
    immediatelyRender: false,
    onUpdate: ({ editor }) => {
      onChange(editor.getHTML())
    },
  })

  useEffect(() => {
    if (editor && content !== editor.getHTML()) {
      editor.commands.setContent(content)
    }
  }, [content, editor])

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
          onClick={() => editor.chain().focus().toggleOrderedList().run()}
          style={{
            background: editor.isActive('orderedList') ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontSize: 13
          }}
        >
          1.
        </button>
        <button
          type="button"
          onClick={() => {
            const previousUrl = editor.getAttributes('link').href
            const url = window.prompt('URL', previousUrl)

            if (url === null) return
            if (url === '') {
              editor.chain().focus().extendMarkRange('link').unsetLink().run()
              return
            }

            editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run()
          }}
          style={{
            background: editor.isActive('link') ? '#e0e0e0' : 'none',
            border: '1px solid #ddd', borderRadius: 4, padding: '4px 10px', cursor: 'pointer', fontSize: 13
          }}
        >
          Link
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
        style={{ padding: '16px', minHeight, outline: 'none', cursor: 'text' }}
        className="prose max-w-none"
      />
    </div>
  )
}
