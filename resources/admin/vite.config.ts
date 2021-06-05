import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import components from 'vite-plugin-components'
import baseConfig from '../vite.config'

// https://vitejs.dev/config/
export default defineConfig({
  ...baseConfig('admin', ['./resources/admin/**/*.{blade.php,ts,vue}']),
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
  ],
  optimizeDeps: {
    entries: ['admin/app.ts'],
    include: [
      'vue',
      'lodash',
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
