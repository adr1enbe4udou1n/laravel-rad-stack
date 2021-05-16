import { UserConfigExport } from 'vite'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'
import tailwindConfig from './tailwind.config.js'
import Dotenv from 'dotenv'

Dotenv.config()

// https://vitejs.dev/config/
export default (entry: string, purge: any = []): UserConfigExport => {
  return {
    base: `${process.env.ASSET_URL || ''}/dist/`,
    root: 'resources',
    publicDir: `${entry}/static`,
    build: {
      outDir: `../public/dist/${entry}`,
      emptyOutDir: true,
      manifest: true,
      rollupOptions: {
        input: `/${entry}/app.ts`,
      },
    },
    css: {
      postcss: {
        plugins: [
          tailwindcss({
            ...tailwindConfig,
            purge,
          }),
          autoprefixer(),
        ],
      },
    },
  }
}
