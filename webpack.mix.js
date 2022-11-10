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

mix.scripts([
    'public/assets/js/jquery-3.3.1.min.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/moment.min.js',
    'public/assets/js/sweetalert.min.js',
    'public/assets/js/delete.handler.js',
    'public/assets/plugins/js-cookie/js.cookie.js',
    'public/vendor/jsvalidation/js/jsvalidation.js',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
    'public/assets/plugins/croppie/croppie.js',
    'public/assets/bootstrap-fileinput/js/plugins/piexif.js',
    'public/assets/bootstrap-fileinput/js/plugins/sortable.js',
    'public/assets/bootstrap-fileinput/js/fileinput.js',
    'public/assets/bootstrap-fileinput/themes/fas/theme.js',
    'public/assets/bootstrap-fileinput/themes/explorer-fas/theme.js',
    'public/assets/jquery-confirm/js/jquery-confirm.js'
], 'public/assets/js/vendor.js');

mix.styles([
    'public/assets/css/fontawesome-all.min.css',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css',
    'public/assets/plugins/croppie/croppie.css',
    'public/assets/bootstrap-fileinput/css/fileinput.css',
    'public/assets/bootstrap-fileinput/themes/explorer-fas/theme.css',
    'public/assets/jquery-confirm/css/jquery-confirm.css',
], 'public/assets/css/vendor.css');

mix.sass('resources/sass/app.scss', 'public/assets/css');

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();