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
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  position: relative;
}

.auth::before {
  content: '';
  position: absolute;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(217, 70, 166, 0.08) 0%, transparent 70%);
  border-radius: 50%;
  top: -150px;
  left: -150px;
  z-index: 0;
  pointer-events: none;
}

.auth-container {
  background: white;
  padding: 3rem 2rem;
  border-radius: 12px;
  max-width: 500px;
  width: 100%;
  box-shadow: 0 8px 24px rgba(0,0,0,0.12);
  position: relative;
  z-index: 1;
}

.tabs {
  display: flex;
  gap: 0;
  margin-bottom: 2.5rem;
  border-bottom: 2px solid #e5e5e5;
}

.tabs button {
  background: none;
  border: none;
  padding: 1rem 0;
  margin-right: 1.5rem;
  cursor: pointer;
  color: #999;
  font-weight: 600;
  border-bottom: 3px solid transparent;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.tabs button:hover {
  color: #d946a6;
}

.tabs button.active {
  color: #d946a6;
  border-bottom-color: #d946a6;
}

.form-section h2 {
  color: #d946a6;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  font-weight: 700;
}

form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

input {
  padding: 0.85rem 1rem;
  border: 1px solid #e5e5e5;
  border-radius: 6px;
  font-size: 0.95rem;
  background: #f9f9f9;
  transition: all 0.3s ease;
}

input::placeholder {
  color: #ccc;
}

input:hover {
  border-color: #d946a6;
  background: white;
}

input:focus {
  outline: none;
  border-color: #d946a6;
  background: white;
  box-shadow: 0 0 0 3px rgba(217, 70, 166, 0.1);
}

.btn {
  padding: 0.95rem;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 0.5rem;
}

.btn-primary {
  background: #d946a6;
  color: white;
  box-shadow: 0 4px 12px rgba(217, 70, 166, 0.3);
}

.btn-primary:hover {
  background: #c0209d;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(217, 70, 166, 0.4);
}

.btn-primary:active {
  transform: translateY(0);
}

@media (max-width: 768px) {
  .auth {
    padding: 1.5rem 1rem;
  }

  .auth-container {
    padding: 2rem 1.5rem;
  }

  .form-section h2 {
    font-size: 1.25rem;
  }

  .tabs button {
    margin-right: 1rem;
    padding: 0.75rem 0;
  }
}
</style>
