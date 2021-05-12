import { defineConfig } from 'laravel-vite'
import vue from '@vitejs/plugin-vue'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'

export default defineConfig({
  css: {
    postcss: {
      plugins: [
        tailwindcss('./resources/css/front/tailwind.config.js'),
        autoprefixer(),
      ],
    },
  },
}).withPlugin(vue)
