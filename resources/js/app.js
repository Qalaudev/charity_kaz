import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import App from './App.vue';
import router from './router';

import ChatApp from './components/design/Chat.vue';
import NewsSection from './components/NewsSection.vue';
import ContactForm from './components/ContactForm.vue';

import en from '../locales/en.json';
import kz from '../locales/kz.json';
import ru from '../locales/ru.json';
import { createI18n } from "vue-i18n";
import axios from "axios";

// 🌐 I18n конфигурациясы
const i18n = createI18n({
    locale: 'kz',
    fallbackLocale: 'en',
    messages: { en, kz, ru }
});

// 🛡️ CSRF
const csrfTokenMeta = document.head.querySelector('meta[name="csrf-token"]');
if (csrfTokenMeta) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfTokenMeta.content;
}

// 🪪 Bearer Token
const authToken = localStorage.getItem('token');
if (authToken) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;
}

window.axios = axios;

// 🧠 Vue қолданбасын бір рет бастау
const app = createApp(App);
const pinia = createPinia()
app.use(router);
app.use(i18n);
app.use(pinia);
app.component('chat-app', ChatApp);
app.component('news-section', NewsSection);
app.component('contact-form', ContactForm);
app.mount('#app');
