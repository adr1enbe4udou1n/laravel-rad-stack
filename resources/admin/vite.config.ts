import { defineConfig } from 'vite'
import components from 'vite-plugin-components'
import config from '../vite.config'

// https://vitejs.dev/config/
export default defineConfig(
  config(
    'admin',
    ['./resources/admin/**/*.{blade.php,js,vue}'],
    {
      '@admin': __dirname,
    },
    [
      components({
        dirs: ['admin/components', 'admin/layouts'],
      }),
    ]
  )
)
