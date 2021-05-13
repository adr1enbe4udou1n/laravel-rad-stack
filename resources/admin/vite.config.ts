import { defineConfig } from 'vite'
import config from '../vite.config'

// https://vitejs.dev/config/
export default defineConfig(
  config('admin', ['./resources/admin/**/*.{blade.php,js,vue}'])
)
