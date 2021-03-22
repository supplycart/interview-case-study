module.exports = {
  purge: { content: ['./public/**/*.html', './src/**/*.vue'] },
  darkMode: false, // or 'media' or 'class'
  theme: {
    maxWidth: {
      "login": "300px",
      "productBox": "500px",
      "cartBox": "700px"
    },
    minWidth: {
      "productBox": "390px"
    },
    width:{
      "productBox": "390px"
    },
    height: {
      "productBox": "250px"
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
