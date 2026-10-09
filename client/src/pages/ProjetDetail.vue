<template>
  <div v-if="loading" class="loading">Chargement...</div>
  <div v-else-if="projet" class="detail">
    <router-link to="/projets" class="back-link">← Retour aux projets</router-link>

    <div class="detail-header">
      <h1>{{ projet.titre }}</h1>
      <p class="type">{{ projet.type_nom }}</p>
    </div>

    <div class="detail-content">
      <div class="images-section">
        <div v-if="projet.images && projet.images.length > 0" class="images">
          <img v-for="(img, idx) in projet.images" :key="idx"
               :src="`/storage/${img}`"
               :alt="projet.titre"
               @error="$event.target.src = 'https://via.placeholder.com/600x400'">
        </div>
        <img v-else src="https://via.placeholder.com/600x400" :alt="projet.titre" class="single-image">
      </div>

      <div class="description-section">
        <h2>Description</h2>
        <p>{{ projet.description || 'Pas de description disponible.' }}</p>
      </div>

      <div class="info-section">
        <div v-if="projet.logiciels && projet.logiciels.length > 0" class="tech">
          <h3>Technologies</h3>
          <div class="tags">
            <span v-for="tech in projet.logiciels" :key="tech" class="tag">
              {{ tech }}
            </span>
          </div>
        </div>

        <div v-if="projet.competences && projet.competences.length > 0" class="skills">
          <h3>Compétences</h3>
          <div class="competences">
            <span v-for="comp in projet.competences" :key="comp" class="comp-tag">
              {{ comp }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="not-found">
    <p>Projet non trouvé</p>
    <router-link to="/projets">Retour aux projets</router-link>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../utils/api.js';

const route = useRoute();
const projet = ref(null);
const loading = ref(true);

onMounted(async () => {
  try {
    const { data } = await api.get(`/projets/${route.params.id}`);
    projet.value = data;
  } catch (err) {
    console.error('Error loading projet:', err);
  } finally {
    loading.value = false;
  }
});
</script>

<style scoped>
.detail {
  padding: 2rem;
  max-width: 900px;
  margin: 0 auto;
}

.back-link {
  color: #d946a6;
  text-decoration: none;
  font-weight: 500;
  margin-bottom: 1rem;
  display: inline-block;
}

.back-link:hover {
  text-decoration: underline;
}

.detail-header {
  margin-bottom: 2rem;
}

h1 {
  color: #d946a6;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.type {
  color: #999;
  font-size: 1.1rem;
}

.detail-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

.images-section {
  grid-column: 1 / 3;
}

.images {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1rem;
}

.images img, .single-image {
  width: 100%;
  border-radius: 8px;
  max-height: 400px;
  object-fit: cover;
}

.description-section {
  grid-column: 1 / 3;
}

.description-section h2 {
  color: #333;
  margin-bottom: 1rem;
}

.description-section p {
  color: #666;
  line-height: 1.8;
  font-size: 1.05rem;
}

.info-section {
  grid-column: 1 / 3;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

h3 {
  color: #333;
  margin-bottom: 1rem;
  font-size: 1.2rem;
}

.tags, .competences {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.tag {
  background: #f0f0f0;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  color: #333;
  font-size: 0.95rem;
}

.comp-tag {
  background: #d946a6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.95rem;
}

.loading, .not-found {
  text-align: center;
  padding: 3rem 2rem;
  color: #999;
}

.not-found a {
  color: #d946a6;
  text-decoration: none;
  display: inline-block;
  margin-top: 1rem;
}

@media (max-width: 768px) {
  .detail {
    padding: 1rem;
  }

  h1 {
    font-size: 1.8rem;
  }

  .detail-content {
    grid-template-columns: 1fr;
  }

  .images-section, .description-section, .info-section {
    grid-column: 1;
  }

  .info-section {
    grid-template-columns: 1fr;
  }
}
</style>
