<template>
    <div class="mt-20">
        <!-- Header -->
        <header class="bg-yellow-50 shadow-lg py-6 fixed top-0 left-0 w-full z-50">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex items-center space-x-6">
                    <img src="../../images/logo.png" alt="Logo" class="w-16 h-16 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-orange-800 tracking-wide">Casper Pizza</h1>
                </div>
                <div class="flex items-center space-x-10">
                    <div class="flex items-center space-x-6">
                        <button @click="$inertia.get('/cart')" class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-500 hover:text-orange-700 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5H20M9 16h6m-3 0v3" />
                            </svg>
                            <div
                                id="cart-count"
                                class="absolute top-0 right-0 bg-orange-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center transform translate-x-2 -translate-y-2 shadow-lg"
                            >
                                {{ cartCount }}
                            </div>
                        </button>
                    </div>
<!--                    <button class="bg-orange-500 text-white px-5 py-3 rounded-full shadow-lg hover:bg-orange-700 transition font-semibold">-->
<!--                        Login-->
<!--                    </button>-->
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-10">
            <section class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <div v-for="pizza in pizzas" :key="pizza.id" class="bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl transition">
                    <img :src="pizza.image" :alt="pizza.name" class="w-full rounded-2xl mb-4" v-if="pizza.image">
                    <h2 class="text-lg font-bold text-orange-700 mb-2">{{ pizza.name }}</h2>
                    <p class="text-gray-500 mb-4 break-words">{{ pizza.description }}</p>

                    <div class="mb-4 flex justify-center">
                        <label
                            class="inline-flex items-center space-x-2 rounded-3xl"
                            v-for="(size, index) in pizza.sizes"
                            :key="size.size"
                        >
                            <input
                                type="radio"
                                :name="'size-' + pizza.id"
                                :value="index"
                                v-model="selectedSize[pizza.id]"
                                @change="toggleSelection(pizza.id, index)"
                                class="hidden"
                            />
                            <div
                                class="flex px-1 flex-nowrap items-center justify-center space-x-2 cursor-pointer rounded-md"
                                :class="{
                                  'bg-yellow-200 text-orange-800': selectedSize[pizza.id] === index,
                                  'bg-gray-100 text-gray-700': selectedSize[pizza.id] !== index
                                }"
                            >
                                <span class="text-sm">{{ size.size }} - </span>
                                <span class="text-sm">{{ size.price }} RSD</span>
                            </div>
                        </label>
                    </div>

                    <button
                        class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition"
                        @click="addToCart(pizza.id, selectedSize[pizza.id])"
                    >
                        Add to Cart
                    </button>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-yellow-50 text-gray-600 py-8">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex items-center space-x-6">
                    <img src="../../images/logo.png" alt="Footer Logo" class="w-20 h-20">
                    <p class="text-lg">Casper Pizza © 2024</p>
                </div>
                <div class="text-right space-y-2">
                    <a href="tel:+381621009949" class="block text-lg text-gray-600 hover:text-gray-800">
                        +381 062 100 99 49
                    </a>
                    <a href="https://www.google.com/maps/place/CASPER+PIZZA/@46.0880482,19.6679821,17z/data=!4m15!1m8!3m7!1s0x4743612b29794d47:0x586d868899d0fb19!2z0JHQtdC-0LPRgNCw0LTRgdC60Lgg0L_Rg9GCIDY1LCDQodGD0LHQvtGC0LjRhtCwIDI0MDAw!3b1!8m2!3d46.0880482!4d19.6679821!16s%2Fg%2F11gdypbnlg!3m5!1s0x474361ddc908b4a7:0xf5646f49c639dca6!8m2!3d46.0880979!4d19.6678364!16s%2Fg%2F11q4k84b8l?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D"
                       target="_blank"
                       class="block text-lg text-gray-600 hover:text-gray-800">
                        Beogradski put 65, Subotica
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    props: {
        pizzas: {
            type: Array,
            required: true,
            default: () => [],
        },
    },
    data() {
        return {
            selectedSize: this.pizzas.reduce((acc, pizza) => {
                acc[pizza.id] = null;
                return acc;
            }, {}),
            cart: [],
        };
    },
    computed: {
        cartCount() {
            // Количество товаров в корзине
            return this.cart.length;
        },
    },
    methods: {
        loadCart() {
            // Загружаем корзину из localStorage, если она есть
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                this.cart = JSON.parse(savedCart);
            }
        },
        saveCart() {
            // Сохраняем корзину в localStorage
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        toggleSelection(pizzaId, index) {
            // Снимаем выделение, если тот же размер выбран повторно
            // if (this.selectedSize[pizzaId] === index) {
            //     this.$set(this.selectedSize, pizzaId, null);
            // }
        },
        addToCart(pizzaId, sizeIndex) {
            const pizza = this.pizzas.find((p) => p.id === pizzaId);
            if (!pizza || !Array.isArray(pizza.sizes)) {
                alert('Ошибка: некорректные данные пиццы.');
                return;
            }
            const selectedSize = pizza.sizes[sizeIndex];
            if (!selectedSize) {
                alert('Выберите корректный размер пиццы!');
                return;
            }
            // Добавляем пиццу в локальную корзину
            this.cart.push({
                pizza_id: pizza.id,
                name: pizza.name,
                image: pizza.image,
                size: selectedSize.size,
                price: selectedSize.price,
            });
            this.saveCart(); // Сохраняем обновления
            // Сбрасываем выделение после добавления
            // this.$set(this.selectedSize, pizzaId, null);
        }
    },
    mounted() {
        this.loadCart(); // Загружаем корзину при загрузке страницы
    },
};
</script>
