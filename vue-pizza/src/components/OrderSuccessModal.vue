<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" @click.self="closeModal">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
      <h2 class="text-2xl font-bold mb-4 text-green-600">Заказ успешно оформлен!</h2>
      <p class="text-gray-700">Ваш заказ принят. Мы скоро свяжемся с вами для подтверждения.</p>
      <button
          class="mt-6 w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
          @click="closeModal"
      >
        Закрыть
      </button>
    </div>
  </div>
</template>

<script>
export default {
  emits: ['close'],
  methods: {
    closeModal() {
      this.$emit('close');
    },
  },
};
</script>
