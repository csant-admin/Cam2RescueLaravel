import './assets/main.css'
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(fas);

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.component('font-awesome-icon', FontAwesomeIcon)


app.use(router)

app.mount('#app')
