/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./storage/framework/views/*.php",
  ],
  theme: {
    extend: {
      colors: {
        azulClaro: '#66a6ff',
        azulObscuro: '#1e3a8a',
      },
      backgroundImage: {
        'pattern': "url('/img/pattern.png')",
      },
      animation: {
        'spin-low': 'spin 3s linear infinite',
      },
      screens: {
        'xs': '480px',
      }
    },
  },
  plugins: [],
}