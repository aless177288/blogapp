const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix.js('resources/js/app.js', 'public/adminlte/js')
   .sass('resources/sass/app.scss', 'public/adminlte/css');

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
]);

if (mix.inProduction()) {
    mix.version();
}
