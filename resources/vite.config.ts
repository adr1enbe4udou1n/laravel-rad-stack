import { UserConfigExport } from 'vite'
import Dotenv from 'dotenv'

Dotenv.config()

// https://vitejs.dev/config/
export default (entry: string): UserConfigExport => {
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
  }
}
