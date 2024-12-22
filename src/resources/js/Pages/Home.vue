<template>
    <div class="mt-20">
        <!-- Header -->
        <header class="bg-blue-50 shadow-lg py-6 fixed top-0 left-0 w-full z-50">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex items-center space-x-6">
                    <img src="https://via.placeholder.com/80" alt="Logo" class="w-16 h-16 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-gray-800 tracking-wide">Casper Pizza</h1>
                </div>
                <div class="flex items-center space-x-10">
                    <div class="flex items-center space-x-6">
                        <button @click="$inertia.get('/cart')" class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-700 hover:text-blue-500 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5H20M9 16h6m-3 0v3" />
                            </svg>
                            <div
                                id="cart-count"
                                class="absolute top-0 right-0 bg-blue-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center transform translate-x-2 -translate-y-2 shadow-lg"
                            >
                                {{ cartCount }}
                            </div>
                        </button>
                    </div>
                    <button class="bg-blue-100 text-blue-700 px-5 py-3 rounded-full shadow-lg hover:bg-blue-200 transition font-semibold">
                        Login
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-10">
            <section class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <div v-for="pizza in pizzas" :key="pizza.id" class="bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl transition">
                    <img :src="pizza.image" :alt="pizza.name" class="w-full rounded-2xl mb-4" v-if="pizza.image">
                    <h2 class="text-lg font-bold text-gray-700 mb-2">{{ pizza.name }}</h2>
                    <p class="text-gray-500 mb-4">{{ pizza.description }}</p>

                    <div class="mb-4">
                        <label v-for="(size, index) in pizza.sizes" :key="size.size" class="inline-flex items-center space-x-2">
                            <input
                                type="radio"
                                :name="'size-' + pizza.id"
                                :value="index"
                                v-model="selectedSize[pizza.id]"
                                class="hidden"
                            />
                            <div
                                :class="{
            'bg-blue-200 text-blue-800': selectedSize[pizza.id] === index,
            'bg-gray-100 text-gray-700': selectedSize[pizza.id] !== index
          }"
                                class="px-4 py-2 rounded-lg cursor-pointer transition"
                            >
                                {{ size.size }} - {{ size.price }} RSD
                            </div>
                        </label>
                    </div>

                    <button
                        class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                        @click="addToCart(pizza.id, selectedSize[pizza.id])"
                    >
                        Add to Cart
                    </button>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-50 text-gray-600 py-8">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex items-center space-x-6">
                    <img src="https://via.placeholder.com/100" alt="Footer Logo" class="w-20 h-20">
                    <p class="text-lg">Pizza Delivery © 2024</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    props: {
        pizzas: Array,
    },
    data() {
        return {
            selectedSize: {}, // Tracks selected size for each pizza
        };
    },
    methods: {
        addToCart(pizzaId, sizeIndex) {
            const pizza = this.pizzas.find((p) => p.id === pizzaId);
            const selectedSize = pizza.sizes[sizeIndex];
            if (selectedSize) {
                this.$inertia.post('/cart/add', {
                    pizzaId,
                    size: selectedSize.size,
                    price: selectedSize.price,
                });
            }
        },
    },
};
</script>
