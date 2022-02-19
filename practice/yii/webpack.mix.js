let mix = require('laravel-mix');
const config = {
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                loader: "ts-loader",
                exclude: /node_modules/
            }
        ]
    }
};

mix
    .js('front/app.js', 'dist')
    .js('front/transformer/index.js', 'dist/transformer/index.js')
    .js('front/fetch/index.js', 'dist/fetch/index.js')
    .setPublicPath('web')
    .webpackConfig(config);
