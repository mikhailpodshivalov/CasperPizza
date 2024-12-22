import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null, // Текущий пользователь
    }),
    actions: {
        async login(email, password) {
            try {
                const response = await fetch('http://your-laravel-url/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({ email, password }),
                });
                if (response.ok) {
                    this.fetchUser();
                } else {
                    const error = await response.json();
                    throw new Error(error.message || 'Ошибка авторизации');
                }
            } catch (err) {
                console.error(err.message);
            }
        },
        async logout() {
            await fetch('http://your-laravel-url/api/logout', {
                method: 'POST',
                credentials: 'include',
            });
            this.user = null;
        },
        async register(email, password, phone) {
            try {
                const response = await fetch('http://your-laravel-url/api/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password, phone }),
                });
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || 'Ошибка регистрации');
                }
                console.log('Регистрация успешна');
            } catch (err) {
                console.error(err.message);
            }
        },
        async fetchUser() {
            try {
                const response = await fetch('http://your-laravel-url/api/user', {
                    credentials: 'include',
                });
                if (response.ok) {
                    this.user = await response.json();
                } else {
                    this.user = null;
                }
            } catch (err) {
                console.error('Ошибка получения данных пользователя:', err);
            }
        },
    },
});
