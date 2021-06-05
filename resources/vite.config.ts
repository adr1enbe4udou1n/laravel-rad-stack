import { UserConfigExport } from 'vite'

import tailwindcss from 'tailwindcss'
import tailwindConfig from '../tailwind.config'
import nested from 'postcss-nested'

import Dotenv from 'dotenv'

Dotenv.config()

// https://vitejs.dev/config/
export default (entry: string, purge: any = []): UserConfigExport => {
  return {
    base: `${process.env.ASSET_URL || ''}/dist/`,
    root: `resources/${entry}`,
    publicDir: `${entry}/static`,
    build: {
      outDir: `../../public/dist/${entry}`,
      emptyOutDir: true,
      manifest: true,
      rollupOptions: {
        input: '/app.ts',
      },
    },
    css: {
      postcss: {
        plugins: [
          tailwindcss({
            ...tailwindConfig,
            purge,
          }),
        ],
      },
    },
  }
}
