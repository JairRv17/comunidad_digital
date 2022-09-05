import './bootstrap';

import { createApp } from "vue"

const app = createApp({});

import example from './components/example.vue';
import HomeLogin from './components/login/HomeLogin.vue';


app.component('example', example);
app.component('home-login', HomeLogin);

app.mount('#app');
