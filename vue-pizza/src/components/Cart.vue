<template>
  <div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Корзина</h2>
    <div v-if="cart.items.length > 0">
      <table class="w-full mb-4">
        <thead>
        <tr class="text-left bg-gray-200">
          <th class="p-2">Название</th>
          <th class="p-2">Размер</th>
          <th class="p-2">Количество</th>
          <th class="p-2">Цена</th>
          <th class="p-2">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in cart.items" :key="item.id" class="border-t">
          <td class="p-2">{{ item.name }}</td>
          <td class="p-2">{{ item.size }}</td>
          <td class="p-2">{{ item.quantity }}</td>
          <td class="p-2">{{ item.price * item.quantity }} RSD</td>
          <td class="p-2">
            <button @click="removeItem(item.id)" class="text-red-500">Удалить</button>
          </td>
        </tr>
        </tbody>
      </table>
      <div class="mb-4">
        <label for="address" class="block text-sm font-medium text-gray-700">Адрес доставки</label>
        <input
            id="address"
            v-model="address"
            type="text"
            class="mt-1 block w-full border rounded-md shadow-sm"
        />
      </div>
      <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
        <input
            id="phone"
            v-model="phone"
            type="tel"
            placeholder="+381-XX-XXXXXXX"
            class="mt-1 block w-full border rounded-md shadow-sm"
        />
      </div>
      <button @click="checkout" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        Оформить заказ
      </button>
    </div>
    <p v-else class="text-gray-500">Корзина пуста.</p>
  </div>
</template>

<script>
import OrderSuccessModal from './OrderSuccessModal.vue';
import { useCartStore } from '../stores/cart';

export default {
  components: { OrderSuccessModal },
  setup() {
    const cart = useCartStore();
    const address = ref('');
    const phone = ref('');
    const showSuccessModal = ref(false);

    const checkout = async () => {
      if (!address.value || !phone.value) {
        alert('Пожалуйста, заполните все поля!');
        return;
      }
      await fetch('http://your-backend-url/api/orders', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          items: cart.items,
          address: address.value,
          phone: phone.value,
        }),
      });
      showSuccessModal.value = true;
      cart.items = [];
    };

    return { cart, address, phone, checkout, showSuccessModal };
  },
};
</script>
