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
  max-width: 1000px;
  margin: 0 auto;
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: #d946a6;
  text-decoration: none;
  font-weight: 600;
  margin-bottom: 2rem;
  padding: 0.75rem 1rem;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.back-link:hover {
  background: rgba(217, 70, 166, 0.1);
}

.detail-header {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 2px solid #e5e5e5;
}

h1 {
  color: #d946a6;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
  line-height: 1.2;
}

.type {
  color: #999;
  font-size: 1.1rem;
  font-weight: 500;
}

.detail-content {
  display: grid;
  grid-template-columns: 1fr;
  gap: 3rem;
}

.images-section {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.images {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  padding: 1.5rem;
}

.images img, .single-image {
  width: 100%;
  border-radius: 6px;
  max-height: 400px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.images img:hover, .single-image:hover {
  transform: scale(1.03);
}

.description-section {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.description-section h2 {
  color: #d946a6;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  font-weight: 700;
}

.description-section p {
  color: #666;
  line-height: 1.8;
  font-size: 1.05rem;
  word-break: break-word;
}

.info-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

.tech, .skills {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.tech {
  border-left: 4px solid #d946a6;
}

.skills {
  border-left: 4px solid #d946a6;
}

h3 {
  color: #1a1a1a;
  margin-bottom: 1.5rem;
  font-size: 1.2rem;
  font-weight: 600;
}

.tags, .competences {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.tag {
  background: #f9f9f9;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  color: #333;
  font-size: 0.9rem;
  font-weight: 500;
  border: 1px solid #e5e5e5;
  transition: all 0.3s ease;
}

.tag:hover {
  background: #f0f0f0;
  border-color: #d946a6;
}

.comp-tag {
  background: #d946a6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.comp-tag:hover {
  background: #c0209d;
}

.loading, .not-found {
  text-align: center;
  padding: 4rem 2rem;
  color: #999;
  font-size: 1.1rem;
}

.not-found a {
  color: #d946a6;
  text-decoration: none;
  display: inline-block;
  margin-top: 1.5rem;
  padding: 0.75rem 1.5rem;
  background: #f9f9f9;
  border-radius: 6px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.not-found a:hover {
  background: #d946a6;
  color: white;
}

@media (max-width: 768px) {
  .detail {
    padding: 1.5rem 1rem;
  }

  h1 {
    font-size: 1.8rem;
  }

  .detail-content {
    grid-template-columns: 1fr;
  }

  .info-section {
    grid-template-columns: 1fr;
  }

  .images {
    grid-template-columns: 1fr;
  }

  .back-link {
    width: 100%;
    justify-content: center;
  }
}
</style>
