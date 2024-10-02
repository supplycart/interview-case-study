import vue from 'eslint-plugin-vue'
import prettier from 'eslint-plugin-prettier'
import vueParser from 'vue-eslint-parser'
import simpleImportSort from 'eslint-plugin-simple-import-sort'
import unusedImports from 'eslint-plugin-unused-imports'

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
            'unused-imports': unusedImports,
        },
        rules: {
            'vue/multi-word-component-names': 'off',
            'prettier/prettier': 'error',
            'simple-import-sort/imports': 'error',
            'simple-import-sort/exports': 'error',
            'unused-imports/no-unused-imports': 'error',
            'unused-imports/no-unused-vars': [
                'warn',
                {
                    vars: 'all',
                    varsIgnorePattern: '^_',
                    args: 'after-used',
                    argsIgnorePattern: '^_',
                },
            ],
        },
    },
]
