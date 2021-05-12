const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
const path = require('path')

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

mix
  .vue()
  .js('resources/js/admin.js', 'public/build')
  .js('resources/js/front.js', 'public/build')
  .postCss('resources/css/front.css', 'public/build', [
    tailwindcss('./resources/css/tailwind-front.config.js'),
  ])
  .postCss('resources/css/admin.css', 'public/build', [
    tailwindcss('./resources/css/tailwind-admin.config.js'),
  ])
  .alias({
    '@': path.resolve('resources'),
  })
  .webpackConfig((webpack) => {
    return {
      plugins: [
        new webpack.DefinePlugin({
          __VUE_OPTIONS_API__: true,
          __VUE_PROD_DEVTOOLS__: false,
        }),
      ],
    }
  })

if (mix.inProduction()) {
  mix.version()
}
