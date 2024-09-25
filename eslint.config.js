// eslint.config.js
import vue from 'eslint-plugin-vue'
import prettier from 'eslint-plugin-prettier'
import vueParser from 'vue-eslint-parser'

export default [
    {
        files: ['resources/**/*.js', 'resources/**/*.vue'],
        languageOptions: {
            parser: vueParser,
            ecmaVersion: 2020,
            sourceType: 'module',
        },
        plugins: {
            vue,
            prettier,
        },
        rules: {
            'vue/multi-word-component-names': 'off',
            'prettier/prettier': 'error',
        },
    },
]
