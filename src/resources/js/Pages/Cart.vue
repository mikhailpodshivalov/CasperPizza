<template>
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6">Корзина</h1>
        <div v-if="cart.length" class="space-y-4">
            <div
                v-for="(item, index) in cart"
                :key="index"
                class="bg-white rounded-lg shadow-lg p-4 flex justify-between items-center"
            >
                <div class="relative w-full flex items-center">
                    <!-- Левая часть: имя, размер, цена -->
                    <div class="flex-1">
                        <h2 class="text-lg font-bold">{{ item.name }}</h2>
                        <p>Размер: {{ item.size }}</p>
                        <p>Цена: {{ item.price }} RSD</p>
                    </div>

                    <!-- Центр: изображение -->
                    <div class="absolute left-1/2 transform -translate-x-1/2">
                        <img :src="item.image" :alt="item.name" class="w-20 rounded-2xl" v-if="item.image">
                    </div>

                    <!-- Правая часть: значок корзины -->
                    <div>
                        <button
                            @click="removeFromCart(index)"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 text-red-500 hover:text-red-700 transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-1 14H6L5 7m5 0V5a2 2 0 112-0v2m0 0h4m-4 0h-4m6 0V5a2 2 0 10-4 0v2" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <div v-else>
            <p class="text-gray-600">Ваша корзина пуста.</p>
        </div>

        <!-- Строка с итоговой суммой -->
        <div v-if="cart.length" class="text-xl font-semibold mt-6">
            Итого: {{ totalPrice }} RSD
        </div>

        <!-- Поля для ввода -->
        <div v-if="cart.length" class="mt-4 space-y-4">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                <div class="mt-1 flex items-center">
                    <!-- Зафиксированная часть -->
                    <span class="px-3 inline-flex items-center bg-gray-100 border border-r-0 border-gray-300 rounded-l-md text-gray-500">
            +381
        </span>
                    <!-- Поле для ввода оставшейся части -->
                    <input
                        id="phone"
                        type="text"
                        v-model="phone"
                        placeholder="** *** ** **"
                        class="flex-1 block w-full border border-gray-300 rounded-r-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required
                    />
                </div>
                <p v-if="phoneError" class="text-red-500 text-sm mt-1">{{ phoneError }}</p>
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Адрес доставки (заказы принимаются только по городу Суботица)</label>
                <textarea
                    id="address"
                    v-model="address"
                    placeholder="Введите адрес доставки"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required
                ></textarea>
                <p v-if="addressError" class="text-red-500 text-sm mt-1">{{ addressError }}</p>
            </div>
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
    data() {
        return {
            cart: [], // Локальная корзина
            phone: '',
            address: '',
        };
    },
    computed: {
        totalPrice() {
            // Считаем итоговую сумму
            return this.cart.reduce((sum, item) => sum + Number(item.price), 0).toFixed(2);
        },
    },
    methods: {
        loadCart() {
            // Загружаем корзину из localStorage
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                this.cart = JSON.parse(savedCart);
            }
        },
        saveCart() {
            // Сохраняем корзину в localStorage
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        removeFromCart(index) {
            // Удаляем элемент из корзины
            this.cart.splice(index, 1);
            this.saveCart(); // Сохраняем изменения
        },
        checkout() {
            if (!this.phone || !this.address) {
                alert('Пожалуйста, заполните все поля.');
                return;
            }
            // Отправляем заказ на сервер
            alert('Ваш заказ успешно отправлен!');
            // Очистка корзины
            this.cart = [];
            this.saveCart();
        },
    },
    mounted() {
        this.loadCart(); // Загружаем корзину при загрузке страницы
    },
};
</script>
