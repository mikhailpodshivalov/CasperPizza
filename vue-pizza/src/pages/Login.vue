<template>
  <div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-4">Войти</h2>
    <form @submit.prevent="handleLogin">
      <div class="mb-4">
        <label>Email</label>
        <input v-model="email" type="email" class="border rounded p-2 w-full" required />
      </div>
      <div class="mb-4">
        <label>Пароль</label>
        <input v-model="password" type="password" class="border rounded p-2 w-full" required />
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Войти</button>
    </form>
    <router-link to="/forgot-password" class="text-blue-500 mt-4 block">Забыли пароль?</router-link>
  </div>
</template>

<script>
import { useAuthStore } from '../stores/auth';

export default {
  setup() {
    const authStore = useAuthStore();
    const email = ref('');
    const password = ref('');

    const handleLogin = async () => {
      await authStore.login(email.value, password.value);
    };

    return { email, password, handleLogin };
  },
};
</script>
