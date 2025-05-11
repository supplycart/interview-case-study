<template>
  <div id="app-container" class="flex flex-col min-h-screen bg-gray-100">
    <Navbar />
    <main class="flex-grow container mx-auto px-4 py-8">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </main>
    <footer class="bg-gray-800 text-white text-center p-4">
      &copy; {{ new Date().getFullYear() }} My E-commerce Store
    </footer>
  </div>
</template>

<script>
import Navbar from '@/components/Layout/Navbar.vue';
import { useAuthStore } from '@/stores/authStore';
import { onMounted } from 'vue'; // For Composition API style in Options API for setup logic

export default {
  name: 'App',
  components: {
    Navbar,
  },
  setup() { // Use setup for early initialization if needed with Options API
    const authStore = useAuthStore();
    onMounted(() => {
      if (!authStore.user && authStore.token) {
        authStore.initializeAuth();
      }
    });
  }
};
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
