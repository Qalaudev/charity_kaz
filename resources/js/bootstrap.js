
// 1. resources/js/bootstrap.js - WebSocket мәселесін шешу
import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// CSRF токен
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Pusher дебуг режимі
Pusher.logToConsole = import.meta.env.DEV;

window.Pusher = Pusher;

// Echo конфигурациясы - WebSocket мәселелерін шешеді
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,

    // WebSocket конфигурациясы
    forceTLS: true,
    encrypted: true,

    // Fallback опциялары
    enabledTransports: ['ws', 'wss'],

    // Timeout настройкалары
    activityTimeout: 120000,
    pongTimeout: 30000,
    unavailableTimeout: 10000,

    // Auth үшін
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {

                console.log(localStorage.getItem('token'))
                axios.post('/broadcasting/auth', {
                    socket_id: socketId,
                    channel_name: channel.name
                }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                })
                    .then(response => {
                        callback(false, response.data);
                    })
                    .catch(error => {
                        console.error('Auth error:', error);
                        callback(true, error);
                    });
            }
        };
    },
});

// Connection event listeners
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('Pusher connected successfully');
});

window.Echo.connector.pusher.connection.bind('disconnected', () => {
    console.log('Pusher disconnected');
});

window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.error('Pusher connection error:', error);
});
