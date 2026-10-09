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
          <li><router-link to="/contact">Contact</router-link></li>
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

onMounted(async () => {
  await authStore.checkAuth();
});

const logout = async () => {
  await authStore.logout();
  router.push('/');
};
</script>

<style>
:root {
  --primary: #d946a6;
  --primary-dark: #c0209d;
  --primary-light: #e562b8;
  --text-dark: #1a1a1a;
  --text-light: #666;
  --border-color: #e5e5e5;
  --bg-light: #f9f9f9;
  --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
  --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
  --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  color: var(--text-dark);
  background: white;
}

a {
  color: var(--primary);
  text-decoration: none;
}

a:hover {
  color: var(--primary-dark);
}
</style>

<style scoped>
.app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background: white;
}

.navbar {
  background: white;
  padding: 0.75rem 0;
  box-shadow: var(--shadow-md);
  position: sticky;
  top: 0;
  z-index: 100;
  border-bottom: 1px solid var(--border-color);
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
  font-size: 1.35rem;
  font-weight: 700;
  color: var(--primary);
  text-decoration: none;
  letter-spacing: -0.5px;
  transition: color 0.3s ease;
}

.logo:hover {
  color: var(--primary-dark);
}

.nav-menu {
  display: flex;
  list-style: none;
  gap: 1rem;
  align-items: center;
  margin: 0;
}

.nav-menu li {
  position: relative;
}

.nav-menu a {
  color: var(--text-dark);
  text-decoration: none;
  font-weight: 500;
  padding: 0.5rem 0.75rem;
  transition: all 0.3s ease;
  border-radius: 4px;
}

.nav-menu a:hover {
  color: var(--primary);
  background: rgba(217, 70, 166, 0.05);
}

.nav-menu .router-link-active {
  color: var(--primary);
}

.admin-menu {
  position: relative;
}

.admin-menu > span {
  color: var(--text-dark);
  font-weight: 500;
  padding: 0.5rem 0.75rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.admin-menu:hover > span {
  color: var(--primary);
  background: rgba(217, 70, 166, 0.05);
}

.submenu {
  display: none;
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  background: white;
  border: 1px solid var(--border-color);
  border-radius: 6px;
  padding: 0.5rem 0;
  flex-direction: column;
  gap: 0;
  box-shadow: var(--shadow-lg);
  min-width: 180px;
}

.admin-menu:hover .submenu {
  display: flex;
}

.submenu li {
  padding: 0;
}

.submenu a {
  display: block;
  padding: 0.75rem 1rem;
  color: var(--text-dark);
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
}

.submenu a:hover {
  background: var(--bg-light);
  color: var(--primary);
  padding-left: 1.25rem;
}

.main-content {
  flex: 1;
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
  width: 100%;
}

.footer {
  background: var(--bg-light);
  text-align: center;
  padding: 3rem 1rem;
  color: var(--text-light);
  border-top: 1px solid var(--border-color);
  margin-top: 3rem;
}

.footer p {
  font-size: 0.95rem;
  font-weight: 500;
}

@media (max-width: 768px) {
  .logo {
    font-size: 1.25rem;
  }

  .nav-menu {
    gap: 0.5rem;
  }

  .nav-menu a {
    padding: 0.5rem 0.5rem;
    font-size: 0.95rem;
  }

  .main-content {
    padding: 1.5rem 1rem;
  }

  .footer {
    padding: 2rem 1rem;
  }

  .submenu {
    right: -50%;
  }
}
</style>
