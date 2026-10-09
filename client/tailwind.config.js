/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#2d2d2d',
        accent: '#d88fb8',
        'accent-dark': '#c975a5',
        'accent-light': '#e5a8cc',
        accent2: '#b08fc9',
        surface: '#f5f0eb',
        'surface-dark': '#eae5e0',
      },
      fontFamily: {
        sans: ['-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
