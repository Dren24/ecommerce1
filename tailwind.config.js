/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "node_modules/preline/dist/*.js",
  ],
  darkMode: 'class', // Enables dark mode via the 'dark' class
  theme: {
    extend: {
      colors: {
        primary: {
          light: '#60A5FA', // Light blue
          DEFAULT: '#3B82F6', // Blue
          dark: '#1E40AF', // Dark blue
        },
        secondary: {
          light: '#FDE68A',
          DEFAULT: '#FBBF24',
          dark: '#B45309',
        },
      },
      backgroundImage: {
        'hero-gradient': 'linear-gradient(to right, #bfdbfe, #06b6d4)',
      },
    },
  },
  plugins: [],
}
