const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/adminlte/js')
    .sass('resources/sass/app.scss', 'public/adminlte/css')
    .sourceMaps();

   //  const mix = require('laravel-mix');

   //  mix.js('resources/js/custom.js', 'public/adminlte/js')
   //      .js('resources/js/app.js', 'public/adminlte/js');
   //     // .sass('resources/sass/custom.scss', 'public/adminlte/css')
   //     // .copy('node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js', 'public/adminlte/js')
   //     // .copy('node_modules/jquery-datetimepicker/jquery.datetimepicker.css', 'public/adminlte/css');
    