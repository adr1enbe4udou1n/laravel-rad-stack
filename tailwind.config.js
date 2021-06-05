// eslint-disable-next-line @typescript-eslint/no-var-requires
const defaultTheme = require('tailwindcss/defaultTheme')

const primary = {
  DEFAULT: '#6574CD',
  50: '#FFFFFF',
  100: '#FFFFFF',
  200: '#D9DCF3',
  300: '#B2BAE6',
  400: '#8B97DA',
  500: '#6574CD',
  600: '#3F51C1',
  700: '#32419A',
  800: '#263173',
  900: '#19214D',
}

/** @type {import("tailwindcss/tailwind-config").TailwindConfig } */
module.exports = {
  mode: 'jit',
  theme: {
    fontFamily: {
      sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
    },
    extend: {
      colors: {
        primary,
      },
      borderColor: {
        primary,
      },
      textColor: {
        primary,
      },
    },
  },

  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('tailwind-scrollbar'),
  ],
}
