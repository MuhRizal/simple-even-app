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

//handling font-awesome path in example.com/applicationName
mix.setPublicPath('public/');
mix.setResourceRoot('../');

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');

mix.combine([
	 'public/js/app.js',
	 'node_modules/pdfmake/build/pdfmake.js',
     'node_modules/pdfmake/build/vfs_fonts.js',
     'node_modules/datatables.net-buttons/js/buttons.html5.js',
     'node_modules/datatables.net-buttons/js/buttons.print.js',
     'node_modules/jquery-confirm/js/jquery-confirm.js',
     'node_modules/nicescroll/dist/jquery.nicescroll.js',
     'node_modules/moment/moment.js',
     'node_modules/bootstrap-daterangepicker/daterangepicker.js',
	 'node_modules/select2/dist/js/select2.js',
	 'node_modules/sweetalert2/dist/sweetalert2.all.js',
     'public/stisla-master/assets/js/stisla.js',
     'public/stisla-master/assets/js/custom.js',
     'public/stisla-master/assets/js/scripts.js'
 ], 'public/js/all.js').version();

 mix.combine([
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/jquery-ui-dist/jquery-ui.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'node_modules/jquery-confirm/js/jquery-confirm.js',
      'node_modules/nicescroll/dist/jquery.nicescroll.js',
      'node_modules/moment/moment.js',
      'node_modules/@fortawesome/fontawesome-free/js/all.js',
      'node_modules/bootstrap-daterangepicker/daterangepicker.js'
  ], 'public/js/base.js').version();

//combine all css files
mix.combine([
     'public/css/app.css',
     'public/stisla-master/assets/css/components.css',
	   'node_modules/sweetalert2/dist/sweetalert2.css',
     'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.css',
     'public/stisla-master/assets/css/style.css',
 ], 'public/css/all.css').version();

mix.combine([
    'node_modules/jquery-ui-dist/jquery-ui.min.css',
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/jquery-confirm/css/jquery-confirm.css',
    'node_modules/@fortawesome/fontawesome-free/css/all.css',
    'node_modules/bootstrap-daterangepicker/daterangepicker.css',
    'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.css',
    'public/stisla-master/assets/css/components.css',
    'public/stisla-master/assets/css/style.css',
], 'public/css/base.css').version();
