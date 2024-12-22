import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],
    }),
    actions: {
        addToCart(pizza) {
            const item = this.items.find((item) => item.id === pizza.id);
            if (item) {
                item.quantity++;
            } else {
                this.items.push({ ...pizza, quantity: 1 });
            }
        },
        removeFromCart(id) {
            this.items = this.items.filter((item) => item.id !== id);
        },
    },
});
