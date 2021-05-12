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
  .js('resources/front/app.js', 'front.js')
  .js('resources/admin/app.js', 'admin.js')
  .postCss('resources/front/app.css', 'front.css', [
    tailwindcss('./resources/front/tailwind.config.js'),
  ])
  .postCss('resources/admin/app.css', 'admin.css', [
    tailwindcss('./resources/admin/tailwind.config.js'),
  ])
  .setPublicPath('public/build')
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
