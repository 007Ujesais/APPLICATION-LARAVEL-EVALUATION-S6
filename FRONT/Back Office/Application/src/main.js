import 'primeicons/primeicons.css'

import { createApp } from 'vue'
import PrimeVue from "primevue/config"
import Theme from './assets/js/theme';
import App from './App.vue'
import router from './router'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:5145/api'

const app = createApp(App)
app.use(router)
app.use(PrimeVue, { 
    ripple: true,
    theme: { 
        preset: Theme,
        options: {
            prefix: 'p',
            darkModeSelector: '.my-app-dark',
        }
    }
})
app.mount('#app')
