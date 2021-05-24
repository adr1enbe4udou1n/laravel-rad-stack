import { defineConfig } from 'windicss/helpers'
import defaultTheme from 'windicss/defaultTheme'
import formsPlugin from 'windicss/plugin/forms'
import typographyPlugin from 'windicss/plugin/typography'

const primary = {
  100: '#e6e8ff',
  300: '#b2b7ff',
  400: '#7886d7',
  500: '#6574cd',
  600: '#5661b3',
  800: '#2f365f',
  900: '#191e38',
}

export default defineConfig({
  theme: {
    extend: {
      fontFamily: {
        sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary,
      },
      borderColor: {
        primary,
      },
    },
  },
  plugins: [formsPlugin, typographyPlugin],
})
