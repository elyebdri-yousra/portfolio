import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/auth.js';

// Pages
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Projets from '../pages/Projets.vue';
import ProjetDetail from '../pages/ProjetDetail.vue';
import Veille from '../pages/Veille.vue';
import Auth from '../pages/Auth.vue';
import AdminUtilisateurs from '../pages/Admin/Utilisateurs.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/about', component: About },
  { path: '/projets', component: Projets },
  { path: '/projets/:id', component: ProjetDetail },
  { path: '/veille', component: Veille },
  { path: '/auth', component: Auth },
  {
    path: '/admin/utilisateurs',
    component: AdminUtilisateurs,
    meta: { requiresAuth: true, requiresAdmin: true }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

let authCheckInitialized = false;

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();

  if (!authCheckInitialized) {
    await authStore.checkAuth();
    authCheckInitialized = true;
  }

  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next('/auth');
  } else if (to.meta.requiresAdmin && authStore.user?.id_role !== 1) {
    next('/');
  } else {
    next();
  }
});

export default router;
