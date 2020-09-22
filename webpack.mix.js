const mix = require('laravel-mix')

require('laravel-vue-lang/mix')

let styles = [
        'resources/vendor/css-hamburgers/hamburgers.min.css',
        'resources/vendor/select2/select2.min.css',
        'resources/css/util.css',
        'public/css/app.css'
    ],
    scripts = [
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'resources/vendor/select2/select2.min.js',
        'resources/vendor/tilt/tilt.jquery.min.js',
        'resources/js/app.js'
    ];

mix.sass('resources/sass/app.scss', 'public/css')
    .styles(styles, 'public/css/app.min.css')
    .js(scripts, 'public/js/app.min.js')
    .copy('resources/images', 'public/images')
    .sourceMaps()
    .lang();

