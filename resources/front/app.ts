import './app.css'

import { createApp } from 'vue'
import HelloWorld from './components/HelloWorld.vue'

createApp({
  components: {
    HelloWorld,
  },
  data() {
    return {
      message: 'You loaded this page on ' + new Date().toLocaleString(),
    }
  },
}).mount('#app')