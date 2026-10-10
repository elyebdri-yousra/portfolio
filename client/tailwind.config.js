/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#333333',
        accent: '#e0a8d8',
        'accent-dark': '#d689c8',
        'accent-light': '#e8bce3',
        accent2: '#c98fd8',
        accent3: '#b87fb8',
        surface: '#ede8e3',
        'surface-dark': '#e0dbd6',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        display: ['Braah One', 'sans-serif'],
      },
      fontWeight: {
        light: '300',
      }
    },
  },
  plugins: [],
}
