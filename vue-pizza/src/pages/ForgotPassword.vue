<template>
  <div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-4">Сброс пароля</h2>
    <form @submit.prevent="requestReset">
      <div class="mb-4">
        <label>Email</label>
        <input v-model="email" type="email" class="border rounded p-2 w-full" required />
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Отправить запрос</button>
    </form>
  </div>
</template>

<script>
export default {
  setup() {
    const email = ref('');

    const requestReset = async () => {
      await fetch('http://your-laravel-url/api/forgot-password', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email.value }),
      });
      alert('Письмо со сбросом пароля отправлено.');
    };

    return { email, requestReset };
  },
};
</script>
