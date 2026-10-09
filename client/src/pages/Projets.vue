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
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  color: #d946a6;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
}

.subtitle {
  color: #666;
  font-size: 1.1rem;
  margin-bottom: 3rem;
  font-weight: 500;
}

.filters {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  margin-bottom: 3rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
  align-items: flex-end;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  flex: 1;
  min-width: 200px;
}

.filter-group label {
  font-weight: 600;
  color: #1a1a1a;
  font-size: 0.95rem;
}

.filter-group select {
  padding: 0.75rem;
  border: 1px solid #e5e5e5;
  border-radius: 6px;
  font-size: 0.95rem;
  background: white;
  color: #1a1a1a;
  cursor: pointer;
  transition: all 0.3s ease;
}

.filter-group select:hover {
  border-color: #d946a6;
}

.filter-group select:focus {
  outline: none;
  border-color: #d946a6;
  box-shadow: 0 0 0 3px rgba(217, 70, 166, 0.1);
}

.btn-secondary {
  padding: 0.75rem 1.5rem;
  background: #f9f9f9;
  border: 1px solid #e5e5e5;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  color: #1a1a1a;
}

.btn-secondary:hover {
  background: #d946a6;
  color: white;
  border-color: #d946a6;
}

.loading, .empty {
  text-align: center;
  padding: 3rem 2rem;
  color: #999;
  font-size: 1.05rem;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.projets-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 2rem;
}

.projet-card {
  text-decoration: none;
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.projet-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.projet-card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.projet-card:hover img {
  transform: scale(1.05);
}

.projet-content {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.projet-content h3 {
  color: #d946a6;
  margin-bottom: 1rem;
  font-size: 1.25rem;
  font-weight: 600;
  line-height: 1.3;
}

.tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.tag {
  background: #f0f0f0;
  padding: 0.35rem 0.85rem;
  border-radius: 20px;
  font-size: 0.8rem;
  color: #333;
  font-weight: 500;
}

.competences {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: auto;
}

.comp-tag {
  background: #d946a6;
  color: white;
  padding: 0.35rem 0.85rem;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
}

@media (max-width: 768px) {
  .projets {
    padding: 1.5rem 1rem;
  }

  .projets-grid {
    grid-template-columns: 1fr;
  }

  h1 {
    font-size: 1.8rem;
  }

  .filters {
    flex-direction: column;
    align-items: stretch;
  }

  .filter-group {
    min-width: 100%;
  }

  .btn-secondary {
    width: 100%;
  }
}
</style>
