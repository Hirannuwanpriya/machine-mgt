// resources/js/stores/auth.js
import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('user-token') || null,
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        setToken(token) {
            this.token = token;
            localStorage.setItem('user-token', token);
        },
        clearToken() {
            this.token = null;
            localStorage.removeItem('user-token');
        },
        logout() {
            this.clearToken();
            //redirect to login
            this.router.push({ name: 'login' });
        },
    },
});
