import { defineConfig } from 'windicss/helpers'
import formsPlugin from 'windicss/plugin/forms'
import typographyPlugin from 'windicss/plugin/typography'

const primary = {
  '50': '#FFFFFF',
  '100': '#FFEDEC',
  '200': '#FFBDB9',
  '300': '#FF8D86',
  '400': '#FF5D53',
  '500': '#FF2D20',
  '600': '#EC0E00',
  '700': '#B90B00',
  '800': '#860800',
  '900': '#530500',
}

export default defineConfig({
  theme: {
    extend: {
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
