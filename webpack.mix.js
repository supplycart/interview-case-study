const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const fs = require('fs');
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

 /* source : https://stackoverflow.com/a/52733704/3126835 */
let getFiles = function (dir) {
  // get all 'files' in this directory
  // filter directories
  return fs.readdirSync(dir).filter(file => {
      return fs.statSync(`${dir}/${file}`).isFile();
  });
};

getFiles('resources/js').forEach(function (filepath) {
  mix.js('resources/js/' + filepath, 'js');
});

mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
      });