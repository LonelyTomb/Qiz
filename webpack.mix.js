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

mix.webpackConfig({
    resolve: {
        alias: {
            jquery: "jquery/src/jquery"
        },
        modules: [
            "node_modules"
        ]
    }
});

mix.js('node_modules/jquery/dist/jquery.js', 'public/js')
    .js('node_modules/flipclock/compiled/flipclock.js', 'public/js')
    .js('node_modules/materialize-css/dist/js/materialize.js', 'public/js')
    .js('resources/assets/js/app.js', 'public/js')
    .js('node_modules/tags-input/tags-input.js', 'public/js')
    .sass('node_modules/mdi/scss/materialdesignicons.scss', 'public/css')
    .sass('node_modules/materialize-css/sass/materialize.scss', 'public/css')
    .styles(['node_modules/flipclock/compiled/flipclock.css'], 'public/css/flipclock.css')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles(['node_modules/tags-input/tags-input.css'], 'public/css/tags-input.css')
    .autoload({
        'jquery': ['jQuery', '$'],
        'tags-input':['tagsinput','tagsInput']
    })
;
