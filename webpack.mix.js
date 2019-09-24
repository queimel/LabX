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
   .sass('resources/sass/app.scss', 'public/css')
   .scripts([
    'public/js/perfect-scrollbar.jquery.min.js',
    'public/js/waves.js',
    'public/js/sidebarmenu.js',
    'public/js/custom.min.js',
    'public/js/plugins/sparkline/jquery.sparkline.min.js',
    'public/js/plugins/chartist-js/dist/chartist.min.js',
    'public/js/js/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
    'public/js/plugins/d3/d3.min.js',
    'public/js/plugins/c3-master/c3.min.js',
    'public/js/plugins/toast-master/js/jquery.toast.js',
    'public/js/plugins/styleswitcher/jQuery.style.switcher.js'
    ], 'public/js/plugins.js')
    .styles([
        'public/js/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
    ], 'public/css/extra.css');
