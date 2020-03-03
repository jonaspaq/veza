const mix = require('laravel-mix');


/// Bundle analyzer, checks what makes your files large
// require('laravel-mix-bundle-analyzer');
// mix.bundleAnalyzer();

// For PurgeCss
// require('laravel-mix-purgecss');

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
    output:{
        chunkFilename:'js/components/[name].js',
    },
    watchOptions: {
        ignored: '/node_modules/'
    }
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
    // .purgeCss() // Remove unused css
    // .browserSync('localhost:8000');
