module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      zIndex: {
        'back': '-99999999'
      },
      borderColor: {
        'top-only': 'black transparent transparent transparent',
        'right-only': 'transparent black transparent transparent',
        'bottom-only': 'transparent transparent black transparent',
        'left-only': 'transparent transparent transparent black',
        'spin': 'black black black transparent'
      }
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
