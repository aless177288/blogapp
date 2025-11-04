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

// AdminLTE assets (si los necesitas)
mix.js('resources/js/app.js', 'public/adminlte/js')
   .sass('resources/sass/app.scss', 'public/adminlte/css')
   .sourceMaps();

// Tailwind CSS assets (tu nuevo CSS)
mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
]);

// Assets adicionales si los necesitas
// mix.js('resources/js/custom.js', 'public/adminlte/js')
//    .copy('node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js', 'public/adminlte/js')
//    .copy('node_modules/jquery-datetimepicker/jquery.datetimepicker.css', 'public/adminlte/css');