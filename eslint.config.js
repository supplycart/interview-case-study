// eslint.config.js
import vue from 'eslint-plugin-vue'
import prettier from 'eslint-plugin-prettier'
import vueParser from 'vue-eslint-parser'
import simpleImportSort from 'eslint-plugin-simple-import-sort'

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
            'simple-import-sort': simpleImportSort,
        },
        rules: {
            'vue/multi-word-component-names': 'off',
            'prettier/prettier': 'error',
            'simple-import-sort/imports': 'error',
            'simple-import-sort/exports': 'error',
        },
    },
]
