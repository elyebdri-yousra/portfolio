/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue}",
  ],
  theme: {
    extend: {
      colors: {
        stone: {
          400: '#a8a29e',
          500: '#78716b',
          600: '#57534e',
          700: '#44403c',
        }
      },
      fontFamily: {
        cantarell: ['Cantarell', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
