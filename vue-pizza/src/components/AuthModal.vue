<template>
  <div
      class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center"
      @click.self="$emit('close')"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
      <h2 class="text-xl font-bold mb-4">Регистрация</h2>
      <form @submit.prevent="register">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input
              id="email"
              type="email"
              v-model="email"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
              required
          />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
          <input
              id="password"
              type="password"
              v-model="password"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
              required
          />
        </div>
        <button
            type="submit"
            class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
        >
          Зарегистрироваться
        </button>
      </form>
      <p class="text-sm mt-4">
        Забыли пароль?
        <router-link to="/reset-password" class="text-blue-500 hover:underline">Сбросить пароль</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../stores/auth';

export default {
  setup() {
    const authStore = useAuthStore();
    const email = ref('');
    const password = ref('');

    const register = async () => {
      try {
        const response = await fetch('http://your-backend-url/api/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email, password, phone }),
        });
        if (response.ok) {
          alert('Регистрация успешна!');
        } else {
          alert('Ошибка регистрации!');
        }
      } catch (error) {
        console.error(error);
      }
    };

    return { email, password, register };
  },
};
</script>
