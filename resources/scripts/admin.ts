/*
|--------------------------------------------------------------------------
| Main entry point
|--------------------------------------------------------------------------
| Files in the "resources/scripts" directory are considered entrypoints
| by default.
|
| -> https://vitejs.dev
| -> https://github.com/innocenzi/laravel-vite
*/

import '@/css/app.css'

import { createApp } from 'vue'
import App from '@/views/admin/App.vue'

createApp(App).mount('#app')
