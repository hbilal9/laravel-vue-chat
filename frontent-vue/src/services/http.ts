import axios from 'axios'

export function http() {
  const token = localStorage.getItem('token') || ''
  return axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
      'Content-Type': 'application/json',
      Authorization: token ? `Bearer ${token}` : ''
    }
  })
}
