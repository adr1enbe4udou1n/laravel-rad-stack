import { defineConfig, Plugin } from 'vite'
import vue from '@vitejs/plugin-vue'
import baseConfig from '../vite.config'

/**
 * Enable full reload for blade file
 */
const laravel = (): Plugin => ({
  name: 'vite:laravel',
  handleHotUpdate({ file, server }) {
    if (file.endsWith('.blade.php')) {
      server.ws.send({
        type: 'full-reload',
        path: '*',
      })
    }
  },
})

// https://vitejs.dev/config/
export default defineConfig({
  ...baseConfig('front', [
    './storage/framework/views/*.php',
    './resources/front/**/*.{blade.php,ts,vue}',
  ]),
  resolve: {
    alias: {
      '@front': __dirname,
    },
  },
  plugins: [laravel()],
  optimizeDeps: {
    include: ['vue', 'alpinejs'],
  },
})
