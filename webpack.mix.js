const mix = require('laravel-mix');
mix
    .styles([
        // 'public/adminpanel/assets/plugins/global/plugins.bundle.css',
        'public/adminpanel/assets/plugins/custom/prismjs/prismjs.bundle.css',
        'public/adminpanel/assets/css/style.bundle.css',
        'public/adminpanel/assets/plugins/custom/datatables/datatables.bundle.css',
        'public/adminpanel/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
        'public/adminpanel/assets/css/themes/layout/header/base/light.css',
        'public/adminpanel/assets/css/themes/layout/header/menu/light.css',
        'public/adminpanel/assets/css/themes/layout/brand/light.css',
        'public/adminpanel/assets/css/themes/layout/aside/light.css',
    ], 'public/adminpanel/compiled.css')
    .styles([
        // 'public/adminpanel/assets/plugins/global/plugins.bundle.css',
        'public/adminpanel/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css',
        'public/adminpanel/assets/css/style.bundle.rtl.css',
        'public/adminpanel/assets/plugins/custom/datatables/datatables.bundle.css',
        'public/adminpanel/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css',
        'public/adminpanel/assets/css/themes/layout/header/base/light.rtl.css',
        'public/adminpanel/assets/css/themes/layout/header/menu/light.rtl.css',
        'public/adminpanel/assets/css/themes/layout/brand/light.rtl.css',
        'public/adminpanel/assets/css/themes/layout/aside/light.rtl.css',
    ], 'public/adminpanel/compiled.rtl.css')

    .scripts([
        'public/adminpanel/assets/plugins/global/plugins.bundle.js',
        'public/adminpanel/assets/plugins/custom/prismjs/prismjs.bundle.js',
        'public/adminpanel/assets/js/scripts.bundle.js',
        'public/adminpanel/assets/plugins/custom/datatables/datatables.bundle.js',
    ], 'public/adminpanel/compiled.js')

    .styles([
        'public/enduser/css/bootstrap.min.css',
        'public/enduser/css/main.css',
    ], 'public/enduser/css/compiled.css')

    .scripts([
        'public/enduser/js/jquery-3.5.1.min.js',
        'public/enduser/js/popper.min.js',
        'public/enduser/js/bootstrap.min.js',
        'public/enduser/js/main.js',
        'public/enduser/js/all.min.js',
    ], 'public/enduser/js/compiled.js')

    .options({
        processCssUrls: false,
    })
    .version()
    .sourceMaps()
    ;

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.css$\.scss$/i,
                use: ['style-loader', 'css-loader'],
            },
        ],
    },
});
// mix.browserSync('local.healsys');
