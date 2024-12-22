<template>
  <div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-4">Регистрация</h2>
    <form @submit.prevent="handleRegister">
      <div class="mb-4">
        <label>Email</label>
        <input v-model="email" type="email" class="border rounded p-2 w-full" required />
      </div>
      <div class="mb-4">
        <label>Пароль</label>
        <input v-model="password" type="password" class="border rounded p-2 w-full" required />
      </div>
      <div class="mb-4">
        <label>Телефон</label>
        <input v-model="phone" type="tel" placeholder="+381-XX-XXXXXXX" class="border rounded p-2 w-full" required />
      </div>
      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Зарегистрироваться</button>
    </form>
  </div>
</template>

<script>
import { useAuthStore } from '../stores/auth';

export default {
  setup() {
    const authStore = useAuthStore();
    const email = ref('');
    const password = ref('');
    const phone = ref('');

    const handleRegister = async () => {
      await authStore.register(email.value, password.value, phone.value);
    };

    return { email, password, phone, handleRegister };
  },
};
</script>
