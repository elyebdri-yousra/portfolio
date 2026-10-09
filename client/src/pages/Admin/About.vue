<template>
  <div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-6xl mx-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Gestion de l'À propos</h1>
        <router-link to="/admin" class="text-blue-600 hover:underline">← Retour</router-link>
      </div>

      <!-- Tabs -->
      <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button
          v-for="tab in ['parcours', 'formations', 'competences']"
          :key="tab"
          @click="activeTab = tab"
          :class="[
            'px-4 py-2 font-medium text-sm uppercase tracking-wide',
            activeTab === tab
              ? 'border-b-2 border-blue-600 text-blue-600'
              : 'text-gray-600 hover:text-gray-900'
          ]">
          {{ tab === 'parcours' ? 'Parcours' : tab === 'formations' ? 'Formations' : 'Compétences' }}
        </button>
      </div>

      <!-- Parcours Section -->
      <section v-if="activeTab === 'parcours'" class="space-y-6">
        <button @click="addParcours" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
          + Ajouter une expérience
        </button>

        <div v-for="(item, index) in parcours" :key="item.id" class="bg-white rounded-lg shadow p-6 space-y-4">
          <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold">{{ item.poste }}</h3>
            <button @click="deleteParcours(index)" class="text-red-600 hover:text-red-700">
              Supprimer
            </button>
          </div>

          <input
            v-model="item.poste"
            type="text"
            placeholder="Poste"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg">

          <input
            v-model="item.entreprise"
            type="text"
            placeholder="Entreprise"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg">

          <input
            v-model="item.periode"
            type="text"
            placeholder="Période"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg">

          <textarea
            v-model="item.missions"
            placeholder="Missions"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>

          <button @click="saveParcours(index)" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Enregistrer
          </button>
        </div>
      </section>

      <!-- Formations Section -->
      <section v-if="activeTab === 'formations'" class="space-y-6">
        <button @click="addFormation" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
          + Ajouter une formation
        </button>

        <div v-for="(item, index) in formations" :key="item.id" class="bg-white rounded-lg shadow p-6 space-y-4">
          <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold">{{ item.titre }}</h3>
            <button @click="deleteFormation(index)" class="text-red-600 hover:text-red-700">
              Supprimer
            </button>
          </div>

          <input
            v-model="item.titre"
            type="text"
            placeholder="Titre"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg">

          <input
            v-model="item.etablissement"
            type="text"
            placeholder="Établissement"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg">

          <textarea
            v-model="item.contenu"
            placeholder="Contenu"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>

          <button @click="saveFormation(index)" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Enregistrer
          </button>
        </div>
      </section>

      <!-- Compétences Section -->
      <section v-if="activeTab === 'competences'" class="space-y-6">
        <button @click="addCompetence" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
          + Ajouter une compétence
        </button>

        <div v-for="(item, index) in competences" :key="item.id" class="bg-white rounded-lg shadow p-6 space-y-4">
          <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold">{{ item.categorie }}</h3>
            <button @click="deleteCompetence(index)" class="text-red-600 hover:text-red-700">
              Supprimer
            </button>
          </div>

          <input
            v-model="item.categorie"
            type="text"
            placeholder="Catégorie"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg">

          <textarea
            v-model="item.details"
            placeholder="Détails"
            rows="3"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>

          <button @click="saveCompetence(index)" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Enregistrer
          </button>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const activeTab = ref('parcours');
const parcours = ref([]);
const formations = ref([]);
const competences = ref([]);

const API_URL = 'http://localhost:3000/api/about';

const getToken = () => localStorage.getItem('token');

const loadData = async () => {
  try {
    const [parcoursRes, formationsRes, competencesRes] = await Promise.all([
      fetch(`${API_URL}/parcours`),
      fetch(`${API_URL}/formations`),
      fetch(`${API_URL}/competences`)
    ]);

    parcours.value = await parcoursRes.json();
    formations.value = await formationsRes.json();
    competences.value = await competencesRes.json();
  } catch (error) {
    console.error('Error loading data:', error);
  }
};

const addParcours = () => {
  parcours.value.push({
    poste: '',
    entreprise: '',
    periode: '',
    missions: ''
  });
};

const saveParcours = async (index) => {
  const item = parcours.value[index];
  try {
    const method = item.id ? 'PUT' : 'POST';
    const url = item.id ? `${API_URL}/parcours/${item.id}` : `${API_URL}/parcours`;

    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${getToken()}`
      },
      body: JSON.stringify(item)
    });

    if (response.ok) {
      const saved = await response.json();
      parcours.value[index] = saved;
    }
  } catch (error) {
    console.error('Error saving:', error);
  }
};

const deleteParcours = async (index) => {
  const item = parcours.value[index];
  if (item.id && confirm('Êtes-vous sûr ?')) {
    try {
      await fetch(`${API_URL}/parcours/${item.id}`, {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${getToken()}`
        }
      });
      parcours.value.splice(index, 1);
    } catch (error) {
      console.error('Error deleting:', error);
    }
  }
};

const addFormation = () => {
  formations.value.push({
    titre: '',
    etablissement: '',
    contenu: ''
  });
};

const saveFormation = async (index) => {
  const item = formations.value[index];
  try {
    const method = item.id ? 'PUT' : 'POST';
    const url = item.id ? `${API_URL}/formations/${item.id}` : `${API_URL}/formations`;

    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${getToken()}`
      },
      body: JSON.stringify(item)
    });

    if (response.ok) {
      const saved = await response.json();
      formations.value[index] = saved;
    }
  } catch (error) {
    console.error('Error saving:', error);
  }
};

const deleteFormation = async (index) => {
  const item = formations.value[index];
  if (item.id && confirm('Êtes-vous sûr ?')) {
    try {
      await fetch(`${API_URL}/formations/${item.id}`, {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${getToken()}`
        }
      });
      formations.value.splice(index, 1);
    } catch (error) {
      console.error('Error deleting:', error);
    }
  }
};

const addCompetence = () => {
  competences.value.push({
    categorie: '',
    details: ''
  });
};

const saveCompetence = async (index) => {
  const item = competences.value[index];
  try {
    const method = item.id ? 'PUT' : 'POST';
    const url = item.id ? `${API_URL}/competences/${item.id}` : `${API_URL}/competences`;

    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${getToken()}`
      },
      body: JSON.stringify(item)
    });

    if (response.ok) {
      const saved = await response.json();
      competences.value[index] = saved;
    }
  } catch (error) {
    console.error('Error saving:', error);
  }
};

const deleteCompetence = async (index) => {
  const item = competences.value[index];
  if (item.id && confirm('Êtes-vous sûr ?')) {
    try {
      await fetch(`${API_URL}/competences/${item.id}`, {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${getToken()}`
        }
      });
      competences.value.splice(index, 1);
    } catch (error) {
      console.error('Error deleting:', error);
    }
  }
};

onMounted(loadData);
</script>
