// stores/user.js
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null,
    }),

    getters: {
        // Қазіргі қолданушы
        getCurrentUser: (state) => state.user,

        // Қолданушының аты-жөні
        userFullName: (state) => {
            if (!state.user) return ''
            return `${state.user.first_name || ''} ${state.user.last_name || ''}`.trim()
        },

        // Аватар (немесе default сурет)
        userAvatar: (state) => {
            return state.user?.avatar || '/images/default-avatar.png'
        },

        // Белгілі бір рольге ие ме?
        hasRole: (state) => (role) => {
            return state.user?.roles?.some(r => r.name === role) || false
        }
    },

    actions: {
        // Қолданушыны орнату
        setUser(userData) {
            this.user = userData
        },

        // Қолданушыны өшіру (logout кезінде)
        clearUser() {
            this.user = null
        },

        // Қолданушыны серверден алу
        async fetchUser() {
            try {
                const response = await fetch('/api/user', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })

                const data = await response.json()

                if (!response.ok) {
                    throw new Error(data.message || 'Failed to fetch user')
                }

                this.setUser(data.user)
                return { success: true, data }
            } catch (error) {
                console.error('Fetch user error:', error)
                return { success: false, error: error.message }
            }
        }
    }
})
