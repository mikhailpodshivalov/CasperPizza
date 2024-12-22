<template>
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6">Корзина</h1>
        <div v-if="cart.length" class="space-y-4">
            <div
                v-for="(item, index) in cart"
                :key="index"
                class="bg-white rounded-lg shadow-lg p-4 flex justify-between items-center"
            >
                <div>
                    <h2 class="text-lg font-bold">{{ item.name }}</h2>
                    <p>Размер: {{ item.size }}</p>
                    <p>Цена: {{ item.price }} RSD</p>
                </div>
                <button
                    @click="removeFromCart(index)"
                    class="text-red-500 hover:underline"
                >
                    Удалить
                </button>
            </div>
        </div>
        <div v-else>
            <p class="text-gray-600">Ваша корзина пуста.</p>
        </div>
        <button
            v-if="cart.length"
            @click="checkout"
            class="bg-green-300 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 mt-4"
        >
            Оформить заказ
        </button>
    </div>
</template>

<script>
export default {
    props: {
        cart: Array,
    },
    methods: {
        removeFromCart(index) {
            this.$inertia.post('/cart/remove', { index });
        },
        checkout() {
            this.$inertia.post('/cart/checkout').then(() => {
                alert('Ваш заказ успешно оформлен!');
            });
        },
    },
};
</script>
