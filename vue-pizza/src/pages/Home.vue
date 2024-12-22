<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <PizzaCard
        v-for="pizza in pizzas"
        :key="pizza.id"
        :pizza="pizza"
    />
  </div>
</template>

<script>
import PizzaCard from '../components/PizzaCard.vue';

export default {
  components: { PizzaCard },
  data() {
    return {
      pizzas: [
        { id: 1, name: 'Маргарита', description: 'Сыр и томаты', price: 500, image: '/pizza1.png' },
        { id: 2, name: 'Пепперони', description: 'Колбаса и сыр', price: 600, image: '/pizza2.png' },
      ],
    };
  },
};
</script>
