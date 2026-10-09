<template>
  <div class="app">
    <nav class="navbar">
      <div class="nav-container">
        <router-link to="/" class="logo">
          <span>Portfolio</span>
        </router-link>
        <ul class="nav-menu">
          <li><router-link to="/about">À propos</router-link></li>
          <li><router-link to="/projets">Projets</router-link></li>
          <li><router-link to="/veille">Veille</router-link></li>
          <li><a href="mailto:yousra.elyebdri@icloud.com">Contact</a></li>
          <li v-if="!authStore.isAuthenticated">
            <router-link to="/auth">Connexion</router-link>
          </li>
          <li v-else class="admin-menu">
            <span>{{ authStore.user?.prenom }}</span>
            <ul class="submenu">
              <li><router-link to="/admin/utilisateurs">Gérer utilisateurs</router-link></li>
              <li><a href="#" @click.prevent="logout">Déconnexion</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <main class="main-content">
      <router-view />
    </main>

    <footer class="footer">
      <p>&copy; EL YEBDRI Yousra - 2026</p>
    </footer>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from './stores/auth.js';

const router = useRouter();
const authStore = useAuthStore();

onMounted(() => {
  authStore.checkAuth();
});

const logout = async () => {
  await authStore.logout();
  router.push('/');
};
</script>

<style scoped>
.app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.navbar {
  background: white;
  padding: 1rem 0;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  position: sticky;
  top: 0;
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  font-size: 1.5rem;
  font-weight: bold;
  color: #d946a6;
  text-decoration: none;
}

.nav-menu {
  display: flex;
  list-style: none;
  gap: 2rem;
  align-items: center;
}

.nav-menu a {
  color: #333;
  text-decoration: none;
  transition: color 0.3s;
}

.nav-menu a:hover {
  color: #d946a6;
}

.admin-menu {
  position: relative;
}

.submenu {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background: white;
  border: 1px solid #eee;
  border-radius: 4px;
  padding: 0.5rem 0;
  flex-direction: column;
  gap: 0;
}

.admin-menu:hover .submenu {
  display: flex;
}

.submenu li {
  padding: 0.5rem 1rem;
}

.main-content {
  flex: 1;
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
  width: 100%;
}

.footer {
  background: #f5f5f5;
  text-align: center;
  padding: 2rem;
  color: #666;
  border-top: 1px solid #eee;
}
</style>
