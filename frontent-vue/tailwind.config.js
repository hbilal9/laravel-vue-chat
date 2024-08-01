/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0f1f9',
          100: '#d6dbf3',
          200: '#bbc1ed',
          300: '#a1a7e7',
          400: '#5b75d6',
          500: '#3d539f',
          600: '#3a4a8c',
          700: '#324077',
          800: '#29365f',
          900: '#1f2d4c'
        },

        black: colors.black,
        white: colors.white,
        secondary: colors.gray,
        tertiary: colors.fuchsia,
        success: '#28a745',
        info: '#17a2b8',
        warning: '#ffc107',
        danger: '#dc3545',
        light: '#f8f9fa',
        dark: '#343a40'
      },

      fontFamily: {
        arial: 'Arial',
        exo2: 'Exo2',
        lato: 'Lato',
        nunito: 'Nunito',
        sofiaSans: 'Sofia Sans',
        poppins: 'Poppins'
      }
    },

    screens: {
      phone: '320px',
      xxsm: '360px',
      xsm: '480px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1536px'
    },
    keyframes: {
      shimmer: {
        '100%' : {transform: 'translateX(100%)'}
      }
    }
  },
  plugins: [],
}