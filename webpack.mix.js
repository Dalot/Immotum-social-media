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

mix.js('resources/js/app.js', 'public/js')
   .js('public/js/bootstrap.js', 'public/js')
   .js('resources/js/bulma.js', 'public/js')
   .styles([
        'public/css/vendor/login.css',
        'public/css/vendor/project.css',
        'public/css/vendor/dasboard.css'
    ], 'public/css/all.css')
   .sass('resources/sass/_variables.scss', 'public/css')
   .sass('resources/sass/spacing.scss', 'public/css')
    .extract()
    .version();