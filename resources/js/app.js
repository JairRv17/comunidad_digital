import './bootstrap';

import { createApp } from "vue"

const app = createApp({});

import example from './components/example.vue';
import Register from './components/users/Register.vue';

app.component('example', example);
app.component('register',Register);

app.mount('#app');
