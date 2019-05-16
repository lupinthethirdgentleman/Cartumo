let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .styles(['resources/assets/css/freelancer.min.css'], 'public/css/style.css')
    .styles(['resources/assets/frontend/css/custom.min.css'], 'public/frontend/css/style.css')
    .scripts(['resources/assets/js/jqBootstrapValidation.js',
        'resources/assets/js/contact_me.js',
        'resources/assets/js/freelancer.min.js'
    ], 'public/js/script.js')
    .copy('resources/assets/images', 'public/images');
