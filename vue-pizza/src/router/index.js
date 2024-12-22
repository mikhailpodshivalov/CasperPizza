import { createRouter, createWebHistory } from 'vue-router';
import Home from '../pages/Home.vue';
import Cart from '../components/Cart.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import ResetPassword from '../pages/ResetPassword.vue';
import ForgotPassword from '../pages/ForgotPassword.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/cart', component: Cart },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/forgot-password', component: ForgotPassword },
    { path: '/reset-password', component: ResetPassword },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
