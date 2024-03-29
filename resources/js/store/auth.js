import axios from 'axios'
import router from '@/router'

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        // value keys: id, first_name, last_name, email
        SET_USER(state, value) {
            value.name = value.first_name && value.last_name ? value.name = value.first_name + ' ' + value.last_name : ''
            state.user = value
        }
    },
    actions: {
        login({ commit }, token) {
            window.localStorage.setItem('token', token)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            return axios.get('/api/user').then(({ data }) => {
                commit('SET_USER', data)
                commit('SET_AUTHENTICATED', true)
                router.push({ name: 'dashboard' })
            }).catch(() => {
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        logout({ commit }) {
            window.localStorage.removeItem('token')
            commit('SET_USER', {})
            commit('SET_AUTHENTICATED', false)
        }
    }
}
