<template>
  <div class="min-h-screen bg-surface flex flex-col">
    <!-- Navbar -->
    <nav class="bg-surface border-b border-accent border-opacity-20 px-4 sm:px-6 lg:px-8 py-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <router-link to="/" class="flex items-center gap-3">
          <div class="w-12 h-12 bg-accent rounded-full flex items-center justify-center text-white font-bold text-lg">Y</div>
        </router-link>

        <!-- Menu principal -->
        <div class="hidden md:flex items-center gap-6">
          <router-link to="/about" class="text-primary font-medium hover:text-accent transition-colors">À propos</router-link>
          <router-link to="/projets" class="text-primary font-medium hover:text-accent transition-colors">Projets</router-link>
          <router-link to="/veille" class="text-primary font-medium hover:text-accent transition-colors">Veille technologique</router-link>
          <router-link to="/contact" class="text-primary font-medium hover:text-accent transition-colors">Contact</router-link>
        </div>

        <!-- Auth menu -->
        <div class="flex items-center gap-3">
          <div v-if="!authStore.isAuthenticated">
            <router-link to="/auth" class="text-accent font-medium hover:text-accent-dark transition-colors">Connexion</router-link>
          </div>
          <div v-else class="relative group">
            <button class="text-accent font-medium hover:text-accent-dark transition-colors">{{ authStore.user?.prenom }} ▼</button>
            <div class="hidden group-hover:flex absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg flex-col border border-accent border-opacity-20">
              <router-link to="/admin" class="px-4 py-2 text-primary hover:bg-surface hover:text-accent transition-colors border-b">
                Gestion admin
              </router-link>
              <button @click="logout" class="px-4 py-2 text-primary hover:text-accent text-left w-full transition-colors">
                Déconnexion
              </button>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main content -->
    <main class="flex-1 w-full">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="bg-surface border-t border-accent border-opacity-20 mt-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-primary text-sm">
        <p>© EL YEBDRI Yousra – 2026</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from './stores/auth.js';

const router = useRouter();
const authStore = useAuthStore();

onMounted(async () => {
  await authStore.checkAuth();
});

const logout = async () => {
  await authStore.logout();
  router.push('/');
};
</script>

