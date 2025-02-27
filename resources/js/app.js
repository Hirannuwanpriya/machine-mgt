import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from "pinia";
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import routes from './router/routes';
import { useAuthStore } from './auth';


const app = createApp(App);
const pinia = createPinia();
const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    if (to.name !== 'login' && !authStore.isAuthenticated) {
        next({ name: 'login' });
    } else {
        next();
    }
});

app.use(pinia);
app.use(router);

app.mount('#app');
