<template>
    <transition name="fade">
        <div
            v-if="show"
            class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50"
        >
            <div class="bg-white p-6 rounded shadow-md max-w-sm w-full relative">
                <!-- Заголовок (необязательно) -->
                <h2 class="text-xl font-bold mb-2">{{ title }}</h2>

                <!-- Текст сообщения -->
                <p class="mb-4">{{ message }}</p>

                <!-- Кнопка закрытия -->
                <button
                    @click="$emit('close')"
                    class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-700"
                >
                    OK
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: 'Modal',
    props: {
        show: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        },
        message: {
            type: String,
            default: ''
        }
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
