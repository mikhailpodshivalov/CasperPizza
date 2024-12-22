<template>
  <div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-4">Сброс пароля</h2>
    <form @submit.prevent="resetPassword">
      <div class="mb-4">
        <label>Новый пароль</label>
        <input v-model="password" type="password" class="border rounded p-2 w-full" required />
      </div>
      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Сбросить пароль</button>
    </form>
  </div>
</template>

<script>
import { useRoute } from 'vue-router';

export default {
  setup() {
    const route = useRoute();
    const password = ref('');
    const email = route.query.email;
    const token = route.query.token;

    const resetPassword = async () => {
      await fetch('http://your-laravel-url/api/reset-password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, token, password: password.value, password_confirmation: password.value }),
      });
      alert('Пароль успешно сброшен.');
    };

    return { password, resetPassword };
  },
};
</script>
