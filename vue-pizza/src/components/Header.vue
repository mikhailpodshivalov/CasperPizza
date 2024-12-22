<template>
  <header class="bg-gradient-to-r from-green-600 via-white to-red-600 shadow-lg py-6 fixed top-0 w-full z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
      <div class="flex items-center space-x-6">
        <router-link to="/" class="flex items-center space-x-6">
          <img src="#" alt="Logo" class="w-16 h-16 rounded-lg shadow-md" />
          <h1 class="text-3xl font-bold hover:text-red-600 text-white tracking-wide">Casper Pizza</h1>
        </router-link>
      </div>
      <div class="flex items-center space-x-10">
        <router-link to="/cart" class="relative">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white hover:text-green-300 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5H20M9 16h6m-3 0v3" />
          </svg>
          <div class="absolute top-0 right-0 bg-green-300 text-black text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center transform translate-x-2 -translate-y-2 shadow-lg">
            {{ cart.items.length }}
          </div>
        </router-link>
        <button
            class="bg-white px-5 py-3 rounded-full shadow-lg hover:bg-green-300 transition font-semibold"
            @click="goToLogin"
        >
          Login
        </button>
        <AuthModal v-if="showAuthModal" @close="showAuthModal = false" />
      </div>
    </div>
    <AuthModal v-if="showAuthModal" @close="showAuthModal = false" />
  </header>
</template>

<script>
import { ref } from 'vue';
import AuthModal from './AuthModal.vue';
import { useCartStore } from '../stores/cart';
import { useRouter } from 'vue-router';

export default {
  components: { AuthModal },
  methods: {
    goToLogin() {
      this.$router.push('/login');
    },
  },
  setup() {
    const cartStore = useCartStore();
    const showAuthModal = ref(false);
    const cart = useCartStore();
    const router = useRouter();
    const goToLogin = () => {
      router.push('/login');
    };
    return {
      cartCount: cartStore.items.length,
      showAuthModal,
      cart,
      goToLogin
    };
  },
};
</script>
