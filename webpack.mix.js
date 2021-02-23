const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');
    
const tailwindcss = require("tailwindcss")


mix.sass('resources/sass/app.scss','public/css')
    .options({
        processCssUrls:false,
        postCss: [tailwindscss('tailwind.config.js')]
    })
