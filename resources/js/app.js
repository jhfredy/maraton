require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue'
import Post from "./Components/Posts/Post"

const app = createApp({})
app.component('post',Post)
app.mount('#app')
