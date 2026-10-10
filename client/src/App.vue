<template>
  <div class="min-h-screen bg-surface flex flex-col">
    <!-- Navbar -->
    <nav class="bg-surface px-4 sm:px-6 lg:px-8 py-4 border-b border-accent border-opacity-30">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <router-link to="/" class="flex items-center gap-3 flex-shrink-0">
          <img :src="logoImage" alt="Yousra EL YEBDRI" class="w-20 h-20 rounded-2xl object-cover">
        </router-link>

        <!-- Menu principal -->
        <div class="hidden md:flex items-center gap-8">
          <router-link to="/about" class="text-primary font-semibold text-sm hover:text-accent transition-colors">À propos</router-link>
          <router-link to="/projets" class="text-primary font-semibold text-sm hover:text-accent transition-colors">Projets</router-link>
          <router-link to="/veille" class="text-primary font-semibold text-sm hover:text-accent transition-colors">Veille technologique</router-link>
          <router-link to="/contact" class="text-primary font-semibold text-sm hover:text-accent transition-colors">Contact</router-link>
        </div>

        <!-- Auth menu -->
        <div class="flex items-center gap-3">
          <div v-if="!authStore.isAuthenticated">
            <router-link to="/auth" class="text-accent font-semibold text-sm hover:text-accent-dark transition-colors">Connexion</router-link>
          </div>
          <div v-else class="relative group">
            <button class="text-accent font-semibold text-sm hover:text-accent-dark transition-colors">{{ authStore.user?.prenom }} ▼</button>
            <div class="hidden group-hover:flex absolute right-0 mt-2 w-48 bg-surface rounded-lg shadow-lg flex-col border-2 border-accent">
              <router-link to="/admin" class="px-4 py-2 text-primary hover:bg-accent hover:text-white transition-colors border-b border-accent border-opacity-20 font-medium">
                Gestion admin
              </router-link>
              <button @click="logout" class="px-4 py-2 text-primary hover:bg-accent hover:text-white text-left w-full transition-colors font-medium">
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
    <footer class="bg-surface border-t border-accent border-opacity-30 mt-20">
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
import logoImage from './assets/img/PostMe.png';

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

