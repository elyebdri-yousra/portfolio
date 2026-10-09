<template>
  <div class="min-h-screen bg-white flex flex-col">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <router-link to="/" class="flex items-center gap-2 text-2xl font-bold text-primary hover:text-accent transition-colors">
            <span class="text-accent">◆</span>
            <span>Portfolio</span>
          </router-link>

          <!-- Menu principal -->
          <div class="hidden md:flex items-center gap-1">
            <router-link to="/about" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-surface hover:text-accent transition-colors font-medium">
              À propos
            </router-link>
            <router-link to="/projets" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-surface hover:text-accent transition-colors font-medium">
              Projets
            </router-link>
            <router-link to="/veille" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-surface hover:text-accent transition-colors font-medium">
              Veille
            </router-link>
            <router-link to="/contact" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-surface hover:text-accent transition-colors font-medium">
              Contact
            </router-link>
          </div>

          <!-- Auth menu -->
          <div class="flex items-center gap-3">
            <div v-if="!authStore.isAuthenticated" class="flex gap-2">
              <router-link to="/auth" class="px-4 py-2 rounded-lg border border-accent text-accent hover:bg-accent hover:text-white transition-colors font-medium">
                Connexion
              </router-link>
            </div>
            <div v-else class="relative group">
              <button class="px-4 py-2 rounded-lg bg-accent text-white hover:bg-accent-dark transition-colors font-medium flex items-center gap-2">
                {{ authStore.user?.prenom }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
              </button>
              <!-- Submenu -->
              <div class="hidden group-hover:flex absolute right-0 mt-0 w-48 bg-white rounded-lg shadow-lg border border-gray-200 flex-col">
                <router-link to="/admin" class="px-4 py-2 text-gray-700 hover:bg-surface hover:text-accent transition-colors border-b">
                  Admin Dashboard
                </router-link>
                <router-link to="/admin/utilisateurs" class="px-4 py-2 text-gray-700 hover:bg-surface hover:text-accent transition-colors border-b">
                  Gérer utilisateurs
                </router-link>
                <button @click="logout" class="px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors text-left w-full">
                  Déconnexion
                </button>
              </div>
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
    <footer class="bg-primary text-white mt-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
          <div>
            <h3 class="text-lg font-bold mb-4">Portfolio</h3>
            <p class="text-gray-300">Développeuse web passionnée par les technologies modernes et le design user-centric.</p>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Navigation</h3>
            <ul class="space-y-2 text-gray-300">
              <li><router-link to="/about" class="hover:text-accent transition-colors">À propos</router-link></li>
              <li><router-link to="/projets" class="hover:text-accent transition-colors">Projets</router-link></li>
              <li><router-link to="/contact" class="hover:text-accent transition-colors">Contact</router-link></li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-bold mb-4">Contact</h3>
            <p class="text-gray-300 mb-2">Email: yousra.elyebdri@icloud.com</p>
            <p class="text-gray-400 text-sm">© 2026 Yousra EL YEBDRI. All rights reserved.</p>
          </div>
        </div>
        <div class="border-t border-gray-700 pt-8 text-center text-gray-400 text-sm">
          <p>Refactorisé avec Vue 3 + Express.js + PostgreSQL</p>
        </div>
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

