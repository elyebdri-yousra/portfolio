<template>
  <div class="auth">
    <div class="auth-container">
      <div class="tabs">
        <button @click="activeTab = 'login'" :class="{ active: activeTab === 'login' }">Connexion</button>
        <button @click="activeTab = 'register'" :class="{ active: activeTab === 'register' }">Inscription</button>
      </div>

      <form v-if="activeTab === 'login'" @submit.prevent="handleLogin" class="form-section">
        <h2>Connexion</h2>
        <input v-model="loginForm.email" type="email" placeholder="Email" required>
        <input v-model="loginForm.password" type="password" placeholder="Mot de passe" required>
        <button type="submit" class="btn btn-primary">Se connecter</button>
      </form>

      <form v-else @submit.prevent="handleRegister" class="form-section">
        <h2>Inscription</h2>
        <input v-model="registerForm.nom" type="text" placeholder="Nom" required>
        <input v-model="registerForm.prenom" type="text" placeholder="Prénom" required>
        <input v-model="registerForm.email" type="email" placeholder="Email" required>
        <input v-model="registerForm.password" type="password" placeholder="Mot de passe" required>
        <button type="submit" class="btn btn-primary">Demande d'inscription</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth.js';

const router = useRouter();
const authStore = useAuthStore();

const activeTab = ref('login');
const loginForm = ref({ email: '', password: '' });
const registerForm = ref({ nom: '', prenom: '', email: '', password: '' });

const handleLogin = async () => {
  try {
    await authStore.login(loginForm.value.email, loginForm.value.password);
    router.push('/');
  } catch (err) {
    alert('Erreur de connexion');
  }
};

const handleRegister = async () => {
  try {
    await authStore.register(
      registerForm.value.nom,
      registerForm.value.prenom,
      registerForm.value.email,
      registerForm.value.password
    );
    alert('Inscription réussie ! En attente de validation.');
    activeTab.value = 'login';
  } catch (err) {
    alert('Erreur lors de l\'inscription');
  }
};
</script>

<style scoped>
.auth {
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.auth-container {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  max-width: 500px;
  width: 100%;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.tabs {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
  border-bottom: 2px solid #eee;
}

.tabs button {
  background: none;
  border: none;
  padding: 1rem;
  cursor: pointer;
  color: #999;
  font-weight: 500;
  border-bottom: 2px solid transparent;
}

.tabs button.active {
  color: #d946a6;
  border-bottom-color: #d946a6;
}

.form-section h2 {
  color: #d946a6;
  margin-bottom: 1.5rem;
}

form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

input {
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
}

input:focus {
  outline: none;
  border-color: #d946a6;
}

.btn {
  padding: 0.75rem;
  border: none;
  border-radius: 4px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s;
}

.btn-primary {
  background: #d946a6;
  color: white;
}

.btn-primary:hover {
  background: #c0209d;
}
</style>
