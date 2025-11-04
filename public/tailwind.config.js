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
        'banner': "url('/img/banner.jpg')",
        'pattern': "url('/img/pattern.png')",
        'doscards': "linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.8))",
      },
      animation: {
        'spin-low': 'spin 3s linear infinite',
        'from-Bellow': 'fromBellow 500ms linear',
        'from-right': 'fromRight 300ms linear',
        'bg-banner': 'bgBanner 10s linear',
        'text-banner': 'showBannerText 10s linear',
        'show-card-icon': 'showCardIcon 300ms linear',
        'show-category': 'showCategory 400ms linear',
        'show-card-description': 'showCardDescription 400ms linear',
      },
      keyframes: {
        fromBellow: {
          '0%': { transform: 'translateY(0%)' },
          '50%': { transform: 'translateY(100%)' },
          '100%': { transform: 'translateY(0%)' }
        },
        fromRight: {
          '0%': { transform: 'translateX(100%)' },
          '100%': { transform: 'translateX(0%)' }
        }
      },
      screens: {
        'xs': '480px',
      }
    },
  },
  plugins: [],
}