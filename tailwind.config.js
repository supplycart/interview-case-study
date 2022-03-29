const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: ['./resources/**/*.{vue, blade.php}'],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}
