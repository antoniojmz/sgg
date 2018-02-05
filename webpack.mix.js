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
	'public/theme/bower_components/jquery/js/jquery.js', 
	'public/theme/bower_components/jquery-ui/js/jquery-ui.js', 
	'public/theme/bower_components/popper.js/js/popper.js', 
	'public/theme/bower_components/bootstrap/js/bootstrap.js', 
	'public/theme/assets/plugins/waves/js/waves.js', 
	'public/theme/bower_components/jquery-slimscroll/js/jquery.slimscroll.js',
	'public/theme/assets/plugins/jquery.nicescroll/js/jquery.nicescroll.js', 
	'public/theme/bower_components/classie/js/classie.js', 
	'public/theme/assets/plugins/notification/js/bootstrap-growl.js', 
	'public/theme/assets/pages/contact-detail.js', 
	'public/theme/assets/js/main.js', 
	'public/theme/assets/pages/elements.js', 
	'public/theme/assets/js/menu-horizontal.js', 
	'public/theme/bower_components/select2/js/select2.full.js', 
	'public/theme/bower_components/datatables.net/js/jquery.dataTables.js', 
	'public/theme/bower_components/datatables.net-buttons/js/dataTables.buttons.js',
	'public/theme/assets/plugins/data-table/js/jszip.js', 
	'public/theme/assets/plugins/data-table/js/pdfmake.js', 
	'public/theme/assets/plugins/data-table/js/vfs_fonts.js', 
	'public/theme/bower_components/datatables.net-buttons/js/buttons.print.js', 
	'public/theme/bower_components/datatables.net-buttons/js/buttons.html5.js', 
	'public/theme/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.js', 
	'public/theme/bower_components/datatables.net-responsive/js/dataTables.responsive.js', 
	'public/theme/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.js', 
	'public/plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.js', 
	'public/plugins/validator/formValidation.js', 
	'public/plugins/validator/fvbootstrap.js', 
	'public/plugins/validator/es_ES.js', 
	], 'public/js/core/core.js')
.styles([
	'public/plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.css',
	'public/plugins/validator/formValidation.css',
	'public/css/app/app.css',
	], 'public/css/core/core.css');
