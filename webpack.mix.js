const mix = require('laravel-mix');
require('laravel-mix-bundle-analyzer');
const { GenerateSW } = require('workbox-webpack-plugin');



if (!mix.inProduction()) {
    mix.bundleAnalyzer();
}

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

const CompressionPlugin = require('compression-webpack-plugin');
const BrotliPlugin = require('brotli-webpack-plugin'); //brotli

mix.react('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(false, 'source-map')
    .options({
        //uglify: true,
        //minimize: true
    })
    .webpackConfig({
        plugins: [
            new CompressionPlugin({
                filename: '[path][base].gz',
                algorithm: 'gzip',
                test: /\.(js|css|html|svg)$/,
                threshold: 8192,
                minRatio: 0.8
            }),
            new BrotliPlugin({ //brotli plugin
                asset: '[path].br',
                test: /\.(js|css|html|svg)$/,
                threshold: 10240,
                minRatio: 0.8
            }),
            new GenerateSW({
                modifyURLPrefix: {
                    '//': '/',
                },
            }),
        ],
    });
