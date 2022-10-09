const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

let adminStyles = [
    "public/admin/app-assets/vendors/css/vendors.min.css",
    "public/admin/app-assets/vendors/css/forms/select/select2.min.css",
    "public/admin/app-assets/css/bootstrap.css",
    "public/admin/app-assets/css/bootstrap-extended.css",
    "public/admin/app-assets/css/colors.css",
    "public/admin/app-assets/css/components.css",
    "public/admin/app-assets/css/themes/dark-layout.css",
    "public/admin/app-assets/css/themes/semi-dark-layout.css",
    "public/admin/app-assets/vendors/css/extensions/toastr.min.css",
    "public/admin/app-assets/vendors/css/extensions/sweetalert2.min.css",
    "public/admin/app-assets/css/core/menu/menu-types/vertical-menu.css",
    "public/admin/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css",
    "public/admin/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css",
    "public/admin/app-assets/css/pages/app-invoice.css",
    "public/admin/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css",
    "public/admin/app-assets/css/all.min.css",
    "public/admin/assets/css/style.css",
];

let adminScript = [
    "public/admin/app-assets/vendors/js/vendors.min.js",
    // "public/admin/app-assets/js/scripts/charts/chart-chartjs.js",
    "public/admin/app-assets/vendors/js/editors/quill/katex.min.js",
    "public/admin/app-assets/js/core/app-menu.js",
    "public/admin/app-assets/vendors/js/forms/select/select2.full.min.js",
    "public/admin/app-assets/js/scripts/forms/form-select2.js",
    "public/admin/app-assets/js/core/app.js",
    "public/admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js",
    "public/admin/app-assets/vendors/js/charts/chart.min.js",
    "public/admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js",
    "public/admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js",
    "public/admin/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js",
    "public/admin/app-assets/js/all.min.js",
    "public/admin/app-assets/js/scripts/components/components-modals.js",
    "public/admin/app-assets/js/scripts/components/components-tooltips.js",
    "public/admin/app-assets/js/scripts/components/components-dropdowns.js",
];

mix.scripts(adminScript, 'public/js/admin.js')
    .styles(adminStyles, 'public/css/admin.css').version();


