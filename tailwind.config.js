module.exports = {
  purge: [],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      justifyContent: ['hover', 'focus'],
    },
  },
  plugins: [
    // require('@nuxtjs/tailwindcss/forms'),
    require('@nuxtjs/tailwindcss')
  ],
}
