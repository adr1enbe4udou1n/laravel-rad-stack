console.log(process.env)

module.exports = {
  purge: ['../../views/front/**/*.{blade.php,vue}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
