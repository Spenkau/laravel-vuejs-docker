import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';
// import * as Popper from '@popperjs/core'
// import lodash from 'lodash';

// window.Popper = Popper

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'b010246548dbe7d5fc77',
    wsHost: '127.0.0.1' ? '127.0.0.1' : `ws-mt1.pusher.com`,
    wsPort: 6001,
    wssPort: 6001,
    cluster: 'eu' ?? 'eu',
    encrypted: true,
    forceTLS: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss']
});





