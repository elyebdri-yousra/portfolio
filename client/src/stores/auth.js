import { defineStore } from 'pinia';
import { ref } from 'vue';
import api from '../utils/api.js';

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null);
  const token = ref(localStorage.getItem('token'));
  const isAuthenticated = ref(!!token.value);

  const login = async (email, password) => {
    const { data } = await api.post('/auth/login', { email, password });
    token.value = data.token;
    user.value = data.user;
    localStorage.setItem('token', data.token);
    isAuthenticated.value = true;
    return data;
  };

  const register = async (nom, prenom, email, password) => {
    const { data } = await api.post('/auth/register', {
      nom,
      prenom,
      email,
      password
    });
    return data;
  };

  const logout = async () => {
    token.value = null;
    user.value = null;
    localStorage.removeItem('token');
    isAuthenticated.value = false;
  };

  const checkAuth = async () => {
    if (token.value) {
      try {
        const { data } = await api.get('/auth/me');
        user.value = data.user;
        isAuthenticated.value = true;
      } catch (err) {
        logout();
      }
    }
  };

  return {
    user,
    token,
    isAuthenticated,
    login,
    register,
    logout,
    checkAuth
  };
});
