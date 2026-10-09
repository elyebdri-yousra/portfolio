<template>
  <div class="projets">
    <h1>Projets</h1>
    <p class="subtitle">Explorez les projets qui jalonnent mon parcours</p>

    <div class="filters">
      <div class="filter-group">
        <label>Type</label>
        <select v-model="selectedType" @change="loadProjets">
          <option value="">-- Tous les types --</option>
          <option v-for="type in types" :key="type.id" :value="type.id">
            {{ type.nom }}
          </option>
        </select>
      </div>

      <div class="filter-group">
        <label>Compétences</label>
        <select v-model="selectedCompetences" multiple @change="loadProjets">
          <option v-for="comp in competences" :key="comp.id" :value="comp.id">
            {{ comp.nom }}
          </option>
        </select>
      </div>

      <button @click="resetFilters" class="btn-secondary">Réinitialiser</button>
    </div>

    <div v-if="loading" class="loading">Chargement...</div>

    <div v-else-if="projets.length === 0" class="empty">
      Aucun projet trouvé
    </div>

    <div v-else class="projets-grid">
      <router-link v-for="projet in projets" :key="projet.id"
                   :to="`/projets/${projet.id}`"
                   class="projet-card">
        <img v-if="projet.images && projet.images[0]"
             :src="`/storage/${projet.images[0]}`"
             :alt="projet.titre"
             @error="$event.target.src = 'https://via.placeholder.com/300x200'">
        <img v-else src="https://via.placeholder.com/300x200" :alt="projet.titre">

        <div class="projet-content">
          <h3>{{ projet.titre }}</h3>

          <div v-if="projet.logiciels && projet.logiciels.length > 0" class="tags">
            <span v-for="logiciel in projet.logiciels" :key="logiciel" class="tag">
              {{ logiciel }}
            </span>
          </div>

          <div v-if="projet.competences && projet.competences.length > 0" class="competences">
            <span v-for="comp in projet.competences" :key="comp" class="comp-tag">
              {{ comp }}
            </span>
          </div>
        </div>
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../utils/api.js';

const projets = ref([]);
const types = ref([]);
const competences = ref([]);
const selectedType = ref('');
const selectedCompetences = ref([]);
const loading = ref(true);

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

<style scoped>
.projets {
  padding: 2rem;
}

h1 {
  color: #d946a6;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.subtitle {
  color: #666;
  font-size: 1.1rem;
  margin-bottom: 2rem;
}

.filters {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.filter-group label {
  font-weight: 500;
  color: #333;
}

.filter-group select {
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
  min-width: 200px;
}

.btn-secondary {
  padding: 0.75rem 1.5rem;
  background: #f0f0f0;
  border: 1px solid #ddd;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s;
  align-self: flex-end;
}

.btn-secondary:hover {
  background: #e0e0e0;
}

.loading, .empty {
  text-align: center;
  padding: 2rem;
  color: #999;
  font-size: 1.1rem;
}

.projets-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
}

.projet-card {
  text-decoration: none;
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

.projet-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.projet-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.projet-content {
  padding: 1rem;
}

.projet-content h3 {
  color: #d946a6;
  margin-bottom: 0.5rem;
  font-size: 1.2rem;
}

.tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
}

.tag {
  background: #f0f0f0;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.85rem;
  color: #333;
}

.competences {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.comp-tag {
  background: #d946a6;
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.85rem;
}

@media (max-width: 768px) {
  .projets-grid {
    grid-template-columns: 1fr;
  }

  h1 {
    font-size: 1.8rem;
  }
}
</style>
