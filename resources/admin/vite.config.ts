import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import components from 'vite-plugin-components'
import baseConfig from '../vite.config'
import windicss from 'vite-plugin-windicss'

// https://vitejs.dev/config/
export default defineConfig({
  ...baseConfig('admin'),
  cacheDir: '../node_modules/.vite/admin',
  resolve: {
    alias: {
      '@admin': __dirname,
    },
  },
  plugins: [
    vue(),
    components({
      dirs: ['admin/components', 'admin/layouts'],
    }),
    windicss({
      scan: {
        dirs: ['.'],
        fileExtensions: ['blade.php', 'vue', 'ts'],
      },
    }),
  ],
  optimizeDeps: {
    include: [
      'vue',
      '@inertiajs/inertia',
      '@inertiajs/inertia-vue3',
      '@inertiajs/progress',
      'ziggy-js',
      'matice',
      '@vueuse/core',
      'heroicons-vue3/solid',
      'heroicons-vue3/outline',
    ],
  },
})
