module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      zIndex: {
        'back': '-99999999'
      }
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
