let mix = require('laravel-mix');

mix
    .js('front/app.js', 'dist')
    .setPublicPath('web')
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: "ts-loader",
                    exclude: /node_modules/
                }
            ]
        }
    });