<template>
  <div class="bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl transition">
    <img src="https://via.placeholder.com/300" :alt="pizza.name" class="w-full rounded-2xl mb-4" />
    <h2 class="text-lg font-bold mb-2">{{ pizza.name }}</h2>
    <p class="text-gray-600 mb-4">{{ pizza.description }}</p>
    <div class="flex justify-between items-center mb-4">
      <div class="text-xl font-bold text-gray-800">
        <span>{{ currentPrice }}</span> RSD
      </div>
      <div class="flex items-center">
        <span class="text-sm font-medium text-gray-700">30 см</span>
        <label class="relative inline-flex items-center mx-3 cursor-pointer">
          <input
              type="checkbox"
              class="sr-only size-toggle"
              v-model="isLargeSize"
          />
          <div
              class="w-14 h-8 bg-gray-300 rounded-full peer dark:bg-gray-700 peer-checked:bg-yellow-500 transition-colors"
          ></div>
          <span
              class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full peer-checked:translate-x-6 transform transition"
          ></span>
        </label>
        <span class="text-sm font-medium text-gray-700">50 см</span>
      </div>
    </div>
    <button
        class="w-full bg-green-300 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 add-to-cart"
        @click="addToCart"
    >
      Добавить в корзину
    </button>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import { useCartStore } from '../stores/cart';

export default {
  props: {
    pizza: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const cartStore = useCartStore();
    const isLargeSize = ref(false);

    const currentPrice = computed(() =>
        isLargeSize.value ? props.pizza.priceLarge : props.pizza.priceSmall
    );

    const addToCart = () => {
      cartStore.addToCart({
        ...props.pizza,
        price: currentPrice.value,
        size: isLargeSize.value ? '50 см' : '30 см',
      });
    };

    return { isLargeSize, currentPrice, addToCart };
  },
};
</script>
