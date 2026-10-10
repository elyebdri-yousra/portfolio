<template>
  <div class="min-h-screen bg-surface">
    <!-- Header -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="flex justify-between items-start">
        <div>
          <h1 class="text-5xl font-bold text-primary mb-4">Projets</h1>
          <p class="text-xl text-primary">Explorez les projets qui jalonnent mon parcours professionnel et académique</p>
        </div>
        <!-- Add Project Button for Admin -->
        <button v-if="authStore.user?.role === 'admin'" @click="showAddModal = true" class="px-6 py-3 bg-accent text-white rounded-lg font-semibold hover:bg-accent-dark transition-colors">
          + Ajouter
        </button>
      </div>
    </section>

    <!-- Filters -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
      <div class="bg-white rounded-lg p-6 shadow-sm border border-accent border-opacity-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Type Filter -->
          <div>
            <label class="block text-sm font-semibold text-primary mb-2">Type de projet</label>
            <select v-model="selectedType" @change="loadProjets" class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent text-primary">
              <option value="">Tous les types</option>
              <option v-for="type in types" :key="type.id" :value="type.id">
                {{ type.nom }}
              </option>
            </select>
          </div>

          <!-- Competences Filter -->
          <div>
            <label class="block text-sm font-semibold text-primary mb-2">Compétences</label>
            <select v-model="selectedCompetences" multiple @change="loadProjets" class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent text-primary">
              <option v-for="comp in competences" :key="comp.id" :value="comp.id">
                {{ comp.nom }}
              </option>
            </select>
          </div>

          <!-- Reset Button -->
          <div class="flex items-end">
            <button @click="resetFilters" class="w-full px-4 py-2 bg-accent text-white rounded-lg font-semibold hover:bg-accent-dark transition-colors">
              Réinitialiser
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
      <div v-if="loading" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-accent"></div>
        <p class="text-primary mt-4">Chargement des projets...</p>
      </div>

      <div v-else-if="projets.length === 0" class="text-center py-12">
        <p class="text-xl text-primary">Aucun projet trouvé avec ces critères</p>
      </div>

      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="projet in projets" :key="projet.id" class="group bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 border-t-4 border-accent relative">
          <!-- Delete Button for Admin -->
          <button v-if="authStore.user?.role === 'admin'" @click="deleteProjet(projet.id)" class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600 transition-colors z-10">
            Supprimer
          </button>

          <router-link :to="`/projets/${projet.id}`" class="block">
            <!-- Image -->
            <div class="relative h-48 bg-surface overflow-hidden">
              <img v-if="projet.images && projet.images[0]"
                   :src="`/storage/${projet.images[0]}`"
                   :alt="projet.titre"
                   @error="$event.target.src = 'https://via.placeholder.com/300x200'"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <img v-else src="https://via.placeholder.com/300x200" :alt="projet.titre"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>

            <!-- Content -->
            <div class="p-6">
              <h3 class="text-xl font-bold text-primary mb-3 group-hover:text-accent transition-colors">{{ projet.titre }}</h3>

              <!-- Technologies -->
              <div v-if="projet.logiciels && projet.logiciels.length > 0" class="mb-3">
                <div class="flex flex-wrap gap-2">
                  <span v-for="logiciel in projet.logiciels.slice(0, 3)" :key="logiciel" class="text-xs bg-accent bg-opacity-10 text-accent px-2 py-1 rounded">
                    {{ logiciel }}
                  </span>
                  <span v-if="projet.logiciels.length > 3" class="text-xs text-primary">
                    +{{ projet.logiciels.length - 3 }}
                  </span>
                </div>
              </div>

              <!-- Skills -->
              <div v-if="projet.competences && projet.competences.length > 0" class="flex flex-wrap gap-2">
                <span v-for="comp in projet.competences.slice(0, 2)" :key="comp" class="text-xs bg-accent text-white px-2 py-1 rounded">
                  {{ comp }}
                </span>
                <span v-if="projet.competences.length > 2" class="text-xs text-primary">
                  +{{ projet.competences.length - 2 }}
                </span>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </section>

    <!-- Add Project Modal -->
    <div v-if="showAddModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-primary mb-6">Ajouter un projet</h2>

        <div class="space-y-4 mb-6">
          <input v-model="newProjet.titre" type="text" placeholder="Titre du projet" class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg text-primary">
          <textarea v-model="newProjet.description" placeholder="Description" class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg text-primary" rows="3"></textarea>
          <input v-model="newProjet.lien" type="text" placeholder="Lien (optionnel)" class="w-full px-4 py-2 border border-primary border-opacity-30 rounded-lg text-primary">
        </div>

        <div class="flex gap-3">
          <button @click="addProjet" class="flex-1 px-4 py-2 bg-accent text-white rounded-lg font-semibold hover:bg-accent-dark transition-colors">
            Créer
          </button>
          <button @click="showAddModal = false" class="flex-1 px-4 py-2 bg-gray-200 text-primary rounded-lg font-semibold hover:bg-gray-300 transition-colors">
            Annuler
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../stores/auth.js';
import api from '../utils/api.js';

const authStore = useAuthStore();
const projets = ref([]);
const types = ref([]);
const competences = ref([]);
const selectedType = ref('');
const selectedCompetences = ref([]);
const loading = ref(true);
const showAddModal = ref(false);
const newProjet = ref({ titre: '', description: '', lien: '' });

const loadProjets = async () => {
  loading.value = true;
  try {
    const params = new URLSearchParams();
    if (selectedType.value) params.append('typeId', selectedType.value);
    if (selectedCompetences.value.length > 0) {
      params.append('competenceIds', selectedCompetences.value.join(','));
    }

    const { data } = await api.get(`/projets?${params}`);
    projets.value = data;
  } catch (err) {
    console.error('Error loading projets:', err);
  } finally {
    loading.value = false;
  }
};

const addProjet = async () => {
  if (!newProjet.value.titre || !newProjet.value.description) {
    alert('Veuillez remplir le titre et la description');
    return;
  }

  try {
    await api.post('/projets', {
      titre: newProjet.value.titre,
      description: newProjet.value.description,
      lien: newProjet.value.lien || null
    });

    newProjet.value = { titre: '', description: '', lien: '' };
    showAddModal.value = false;
    await loadProjets();
  } catch (err) {
    console.error('Error creating projet:', err);
    alert('Erreur lors de la création du projet');
  }
};

const deleteProjet = async (id) => {
  if (!confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) return;

  try {
    await api.delete(`/projets/${id}`);
    await loadProjets();
  } catch (err) {
    console.error('Error deleting projet:', err);
    alert('Erreur lors de la suppression du projet');
  }
};

const resetFilters = () => {
  selectedType.value = '';
  selectedCompetences.value = [];
  loadProjets();
};

onMounted(async () => {
  try {
    const [typesRes, competencesRes] = await Promise.all([
      api.get('/projets/types'),
      api.get('/projets/competences')
    ]);
    types.value = typesRes.data;
    competences.value = competencesRes.data;
    await loadProjets();
  } catch (err) {
    console.error('Error loading filters:', err);
  }
});
</script>
