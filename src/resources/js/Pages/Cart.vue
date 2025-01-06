<template>
    <div class="container mx-auto px-4 py-10 relative">
        <!-- Иконка возврата на главную страницу -->
        <button
            @click="$inertia.get('/')"
            class="absolute top-4 right-4 bg-yellow-100 text-orange-700 p-3 rounded-full shadow-lg hover:bg-yellow-200 transition"
            title="Povratak na početnu stranicu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <h1 class="text-3xl font-bold mb-6 text-orange-800">Korpa</h1>
        <div v-if="cart.length" class="space-y-4">
            <div
                v-for="(item, index) in cart"
                :key="index"
                class="bg-yellow-50 rounded-lg shadow-lg p-4 flex justify-between items-center"
            >
                <div class="relative w-full flex items-center justify-center">
                    <!-- Левая часть: имя, размер, цена -->
                    <div class="flex-1">
                        <h2 class="text-lg font-bold text-orange-800">{{ item.name }}</h2>
                        <p class="text-orange-600">Veličina: {{ item.size }}</p>
                        <p class="text-orange-600">Cena: {{ item.price }} RSD</p>
                    </div>

                    <!-- Центр: изображение -->
                    <div class="flex justify-center">
                        <img :src="item.image" :alt="item.name" class="w-20 rounded-2xl" v-if="item.image">
                    </div>

                    <!-- Правая часть: значок корзины -->
                    <div>
                        <button
                            @click="removeFromCart(index)"
                            class="flex justify-content-end pl-10 text-red-500 hover:text-red-700 transition p-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-1 14H6L5 7m5 0V5a2 2 0 112-0v2m0 0h4m-4 0h-4m6 0V5a2 2 0 10-4 0v2" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <p class="text-gray-600">Vaša korpa je prazna.</p>
        </div>

        <!-- Строка с итоговой суммой -->
        <div v-if="cart.length" class="text-xl font-semibold mt-6 text-orange-800">
            Ukupno: {{ totalPrice }} RSD
        </div>

        <!-- Поля для ввода -->
        <div v-if="cart.length" class="mt-4 space-y-4">
            <!-- Поле email -->
            <div>
                <label for="email" class="block text-sm font-medium text-orange-700">Email</label>
                <input
                    id="email"
                    type="email"
                    v-model="email"
                    placeholder="Unesite vašu email adresu"
                    class="mt-1 block w-full border border-orange-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    required
                />
                <p v-if="emailError" class="text-red-500 text-sm mt-1">{{ emailError }}</p>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-orange-700">Telefon</label>
                <div class="mt-1 flex items-center">
                    <!-- Зафиксированная часть -->
                    <span class="px-3 inline-flex items-center bg-yellow-100 border border-r-0 border-orange-300 rounded-l-md text-orange-600">
                        +381
                    </span>
                    <!-- Поле для ввода оставшейся части -->
                    <input
                        id="phone"
                        type="text"
                        v-model="phone"
                        placeholder="** *** ** **"
                        maxlength="9"
                        class="flex-1 block w-full border border-orange-300 rounded-r-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required
                    />
                </div>
                <p v-if="phoneError" class="text-red-500 text-sm mt-1">{{ phoneError }}</p>
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-orange-700">
                    Adresa isporuke (porudžbine se primaju samo u gradu Subotica)
                </label>
                <textarea
                    id="address"
                    v-model="address"
                    placeholder="Unesite adresu za isporuku"
                    class="mt-1 block w-full border border-orange-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    required
                ></textarea>
                <p v-if="addressError" class="text-red-500 text-sm mt-1">{{ addressError }}</p>
            </div>
            <!-- Поле комментария -->
            <div>
                <label for="comment" class="block text-sm font-medium text-orange-700">Komentar uz porudžbinu</label>
                <textarea
                    id="comment"
                    v-model="comment"
                    placeholder="Dodajte napomene za vašu porudžbinu (opciono)"
                    class="mt-1 block w-full border border-orange-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                ></textarea>
            </div>
        </div>

        <!-- Модальное окно -->
        <Modal
            :show="showModal"
            :title="modalTitle"
            :message="modalMessage"
            @close="handleModalClose"
        />

        <button
            v-if="cart.length"
            @click="checkout"
            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-700 mt-4"
        >
            Naručite
        </button>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import Modal from '@/Components/Modal.vue'; // путь к вашему компоненту модалки

export default {
    components: {
        Modal,
    },
    data() {
        return {
            cart: [],
            email: '',
            emailError: null,
            phone: '',
            phoneError: null,
            address: '',
            addressError: null,
            comment: '',
            // Для модалки
            showModal: false,
            modalTitle: '',
            modalMessage: '',
        };
    },
    computed: {
        totalPrice() {
            return this.cart.reduce((sum, item) => sum + Number(item.price), 0).toFixed(2);
        },
    },
    methods: {
        loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                this.cart = JSON.parse(savedCart);
            }
        },
        saveCart() {
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.saveCart();
        },
        handleModalClose() {
            // Закрываем модалку
            this.showModal = false;
        },
        showMyModal(title, message) {
            this.modalTitle = title;
            this.modalMessage = message;
            this.showModal = true;
        },
        async checkout() {
            this.emailError = null;
            this.phoneError = null;
            this.addressError = null;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.email)) {
                this.emailError = 'Molimo unesite validnu email adresu.';
            }
            if (!this.phone) {
                this.phoneError = 'Molimo unesite broj telefona.';
            }
            if (!this.address) {
                this.addressError = 'Molimo unesite adresu za isporuku.';
            }
            if (this.emailError || this.phoneError || this.addressError) {
                return;
            }

            const orderData = {
                items: this.cart,
                email: this.email,
                phone: this.phone,
                address: this.address,
                comment: this.comment || '',
            };

            Inertia.post('/orders', orderData, {
                onSuccess: () => {
                    // Вместо alert
                    this.showMyModal(
                        'Uspeh',
                        'Vaša porudžbina je uspešno poslata!'
                    );
                    this.cart = [];
                    this.saveCart();
                },
                onError: (errors) => {
                    // Вместо alert
                    console.error('Greška pri slanju porudžbine:', errors);
                    this.showMyModal(
                        'Greška',
                        'Došlo je do greške pri slanju porudžbine. Molimo pokušajte ponovo.'
                    );
                },
            });
        },
    },
    mounted() {
        this.loadCart();
    },
};
</script>
