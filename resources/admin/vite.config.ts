import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import components from 'vite-plugin-components'
import baseConfig from '../vite.config'
import windicss from 'vite-plugin-windicss'

// https://vitejs.dev/config/
export default defineConfig({
  ...baseConfig('admin'),
  cacheDir: '../../node_modules/.vite/admin',
  resolve: {
    alias: {
      '@admin': __dirname,
    },
  },
  plugins: [
    vue(),
    components({
      dirs: ['components', 'layouts'],
      globalComponentsDeclaration: true,
    }),
    windicss({
      config: '../../windi.config.ts',
      scan: {
        dirs: ['.'],
        fileExtensions: ['blade.php', 'vue', 'ts'],
      },
    }),
  ],
  optimizeDeps: {
    entries: ['admin/app.ts'],
    include: [
      'clockwork-browser/metrics',
      'clockwork-browser/toolbar',
      'vue',
      '@inertiajs/inertia',
      '@inertiajs/inertia-vue3',
      '@inertiajs/progress',
      'ziggy-js',
      'matice',
      'date-fns',
      'qs',
      'lodash/pick',
      '@vueuse/core',
      '@vueuse/shared',
      '@heroicons/vue/solid',
      '@heroicons/vue/outline',
    ],
  },
})
