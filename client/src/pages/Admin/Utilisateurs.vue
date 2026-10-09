<template>
  <div class="admin">
    <h1>Gérer les utilisateurs</h1>

    <div class="sections">
      <section class="pending-section">
        <h2>En attente de validation ({{ pending.length }})</h2>
        <div v-if="loading" class="loading">Chargement...</div>
        <div v-else-if="pending.length === 0" class="empty">Aucun utilisateur en attente</div>
        <table v-else class="users-table">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in pending" :key="user.id">
              <td>{{ user.prenom }} {{ user.nom }}</td>
              <td>{{ user.email }}</td>
              <td>{{ formatDate(user.created_at) }}</td>
              <td class="actions">
                <button @click="approveUser(user.id)" class="btn-success">Approuver</button>
                <button @click="rejectUser(user.id)" class="btn-danger">Refuser</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <section class="users-section">
        <h2>Tous les utilisateurs ({{ users.length }})</h2>
        <table v-if="users.length > 0" class="users-table">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Rôle</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.prenom }} {{ user.nom }}</td>
              <td>{{ user.email }}</td>
              <td>
                <select @change="(e) => updateRole(user.id, e.target.value)"
                        :value="user.id_role"
                        class="role-select">
                  <option value="1">Admin</option>
                  <option value="2">Évaluateur</option>
                  <option value="3">En attente</option>
                  <option value="4">Refusé</option>
                </select>
              </td>
              <td class="actions">
                <button @click="deleteUser(user.id)" class="btn-danger" v-if="user.id !== authStore.user?.id">
                  Supprimer
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../../stores/auth.js';
import api from '../../utils/api.js';

const authStore = useAuthStore();
const pending = ref([]);
const users = ref([]);
const loading = ref(true);

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('fr-FR');
};

const loadUsers = async () => {
  try {
    loading.value = true;
    const [usersRes, pendingRes] = await Promise.all([
      api.get('/users'),
      api.get('/users/pending')
    ]);
    users.value = usersRes.data;
    pending.value = pendingRes.data;
  } catch (err) {
    console.error('Error loading users:', err);
    alert('Erreur lors du chargement des utilisateurs');
  } finally {
    loading.value = false;
  }
};

const approveUser = async (userId) => {
  try {
    await api.put(`/users/${userId}/role`, { roleId: 2 });
    await loadUsers();
    alert('Utilisateur approuvé');
  } catch (err) {
    alert('Erreur lors de l\'approbation');
  }
};

const rejectUser = async (userId) => {
  try {
    await api.put(`/users/${userId}/role`, { roleId: 4 });
    await loadUsers();
    alert('Utilisateur rejeté');
  } catch (err) {
    alert('Erreur lors du rejet');
  }
};

const updateRole = async (userId, roleId) => {
  try {
    await api.put(`/users/${userId}/role`, { roleId: parseInt(roleId) });
    await loadUsers();
  } catch (err) {
    alert('Erreur lors de la mise à jour du rôle');
  }
};

const deleteUser = async (userId) => {
  if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) return;

  try {
    await api.delete(`/users/${userId}`);
    await loadUsers();
    alert('Utilisateur supprimé');
  } catch (err) {
    alert('Erreur lors de la suppression');
  }
};

onMounted(loadUsers);
</script>

<style scoped>
.admin {
  padding: 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  color: #d946a6;
  font-size: 2rem;
  margin-bottom: 2rem;
}

h2 {
  color: #333;
  font-size: 1.3rem;
  margin-bottom: 1rem;
}

.sections {
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

section {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.loading, .empty {
  text-align: center;
  padding: 2rem;
  color: #999;
}

.users-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.95rem;
}

.users-table th {
  background: #f5f5f5;
  padding: 1rem;
  text-align: left;
  font-weight: 600;
  color: #333;
  border-bottom: 2px solid #ddd;
}

.users-table td {
  padding: 1rem;
  border-bottom: 1px solid #eee;
}

.users-table tr:hover {
  background: #f9f9f9;
}

.role-select {
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.95rem;
}

.actions {
  display: flex;
  gap: 0.5rem;
}

button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 500;
  transition: all 0.3s;
  font-size: 0.85rem;
}

.btn-success {
  background: #4ade80;
  color: white;
}

.btn-success:hover {
  background: #22c55e;
}

.btn-danger {
  background: #f87171;
  color: white;
}

.btn-danger:hover {
  background: #ef4444;
}

@media (max-width: 768px) {
  .admin {
    padding: 1rem;
  }

  .users-table {
    font-size: 0.8rem;
  }

  .users-table th, .users-table td {
    padding: 0.5rem;
  }

  button {
    padding: 0.3rem 0.7rem;
    font-size: 0.75rem;
  }
}
</style>
