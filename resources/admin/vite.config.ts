import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import components from 'vite-plugin-components'
import baseConfig from '../vite.config'

// https://vitejs.dev/config/
export default defineConfig({
  ...baseConfig('admin', ['./resources/admin/**/*.{blade.php,ts,vue}']),
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
  ],
})
