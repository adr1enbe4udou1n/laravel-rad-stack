import { UserConfigExport, Plugin } from 'vite'
import vue from '@vitejs/plugin-vue'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'
import tailwindConfig from './tailwind.config.js'
import Dotenv from 'dotenv'
import path from 'path'

Dotenv.config()

// https://vitejs.dev/config/
export default (
  entry: string,
  purge: string[] = [],
  alias = {},
  plugins: Plugin[] = []
): UserConfigExport => {
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
            // @ts-ignore
            purge,
          }),
          autoprefixer(),
        ],
      },
    },
    resolve: {
      alias: {
        ...alias,
        '/@': path.resolve(__dirname, '/resources'),
      },
    },
    plugins: [vue(), ...plugins],
  }
}
