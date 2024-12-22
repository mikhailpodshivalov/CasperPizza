<template>
  <div>
    <Header />
    <main class="container mx-auto py-6">
      <slot />
    </main>
  </div>
</template>

<script>
import Header from '../Header.vue';

export default {
  components: { Header },
};
</script>
