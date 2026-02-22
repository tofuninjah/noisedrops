/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}'],
  theme: {
    extend: {
      colors: {
        surface: {
          DEFAULT: '#0f1117',
          subtle: '#161b24',
          muted: '#1c2230',
        },
        ink: {
          DEFAULT: '#e2e8f0',
          muted: '#94a3b8',
          faint: '#475569',
        },
        accent: '#4a7fa5',
      },
      fontFamily: {
        sans: [
          'Inter',
          'system-ui',
          '-apple-system',
          'BlinkMacSystemFont',
          'Segoe UI',
          'sans-serif',
        ],
      },
      borderRadius: {
        xl: '1rem',
        '2xl': '1.25rem',
      },
      maxWidth: {
        container: '72rem',
      },
    },
  },
  plugins: [],
};
