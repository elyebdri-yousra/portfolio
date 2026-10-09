/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1e293b',
        accent: '#3b82f6',
        'accent-dark': '#1e40af',
        'accent-light': '#60a5fa',
        surface: '#f8fafc',
        'surface-dark': '#e2e8f0',
      },
      fontFamily: {
        sans: ['-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
