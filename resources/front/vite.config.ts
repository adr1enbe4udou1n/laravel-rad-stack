import { defineConfig, Plugin } from 'vite'
import config from '../vite.config'

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
  ...config('front', [
    './storage/framework/views/*.php',
    './resources/front/**/*.{blade.php,js,vue}',
  ]),
  plugins: [laravel()],
})
