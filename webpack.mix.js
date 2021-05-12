const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
const path = require('path')
const tailwindConfig = require('./tailwind.config.js')

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
    tailwindcss({
      purge: [
        './storage/framework/views/*.php',
        './resources/front/**/*.{blade.php,js,vue}',
      ],
      ...tailwindConfig,
    }),
  ])
  .postCss('resources/admin/app.css', 'admin.css', [
    tailwindcss({
      purge: ['./resources/admin/**/*.{js,vue}'],
      ...tailwindConfig,
    }),
  ])
  .setPublicPath('public/build')
  .alias({
    '@': path.resolve('resources'),
  })
  .browserSync({
    proxy: 'localhost:8000',
    files: ['resources/**/*.blade.php'],
    open: false,
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
