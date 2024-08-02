import Echo from 'laravel-echo'

import Pusher from 'pusher-js'
import { http } from './http'
window.Pusher = Pusher

const echo = new Echo({
  broadcaster: 'reverb',
  key: import.meta.env.VITE_REVERB_APP_KEY,
  wsHost: import.meta.env.VITE_REVERB_HOST,
  wsPort: import.meta.env.VITE_REVERB_PORT,
  wssPort: import.meta.env.VITE_REVERB_PORT,
  forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
  enabledTransports: ['ws', 'wss'],
  authorizer: (channel, options) => {
    return {
      authorize: (socketId, callback) => {
        http()
          .post('/broadcasting/auth', {
            socket_id: socketId,
            channel_name: channel.name
          })
          .then((response) => {
            callback(false, response.data)
          })
          .catch((error) => {
            callback(true, error.response)
          })
      }
    }
  },
  // auth: {
  //   headers: {
  //     Authorization: 'Bearer ' + localStorage.getItem('access_token')
  //   }
  // },
  authEndpoint: 'http://localhost:8000/api/broadcasting/auth',
  debug: true
})

export default echo
