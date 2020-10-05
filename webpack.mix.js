const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');


//-- Site JS
mix.js('resources/js/app.js', 'public/js');

//-- Site CSS
mix.sass('resources/sass/app.scss', 'public/css')
.options({
	processCssUrls: false,
	postCss: [ 
		require('postcss-import'),
		tailwindcss('./tailwind.config.js') 
	],
});