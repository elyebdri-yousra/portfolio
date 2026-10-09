<template>
  <div class="min-h-screen bg-surface py-12 px-4">
    <div class="max-w-6xl mx-auto">
      <!-- Hero Section -->
      <div class="mb-16">
        <h1 class="text-4xl font-bold text-primary mb-2">À propos de moi</h1>
        <p class="text-xl text-primary">Développeuse Web & Étudiante en MMI</p>
      </div>

      <!-- Parcours Section -->
      <section class="mb-16">
        <h2 class="text-3xl font-bold text-primary mb-8">Mon parcours professionnel</h2>
        <div class="space-y-6">
          <div
            v-for="(exp, index) in parcours"
            :key="index"
            class="bg-white rounded-lg shadow-md p-6 border-l-4 border-accent"
          >
            <div class="flex justify-between items-start mb-3">
              <div>
                <h3 class="text-xl font-semibold text-primary">{{ exp.poste }}</h3>
                <p class="text-sm text-primary">{{ exp.entreprise }}</p>
              </div>
              <span class="text-sm font-medium text-primary whitespace-nowrap ml-4">{{ exp.periode }}</span>
            </div>
            <p class="text-primary whitespace-pre-wrap text-sm leading-relaxed">{{ exp.missions }}</p>
          </div>
        </div>
      </section>

      <!-- Formations Section -->
      <section class="mb-16">
        <h2 class="text-3xl font-bold text-primary mb-8">Formations</h2>
        <div class="space-y-6">
          <div
            v-for="(formation, index) in formations"
            :key="index"
            class="bg-white rounded-lg shadow-md p-6 border-l-4 border-accent2"
          >
            <h3 class="text-xl font-semibold text-primary mb-2">{{ formation.titre }}</h3>
            <p class="text-sm text-primary mb-3 font-medium">{{ formation.etablissement }}</p>
            <p class="text-primary whitespace-pre-wrap text-sm leading-relaxed">{{ formation.contenu }}</p>
          </div>
        </div>
      </section>

      <!-- Compétences Section -->
      <section class="mb-16">
        <h2 class="text-3xl font-bold text-primary mb-8">Compétences</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="(comp, index) in competences"
            :key="index"
            class="bg-white rounded-lg shadow-md p-6 border-t-4 border-accent3"
          >
            <h3 class="text-lg font-semibold text-primary mb-3">{{ comp.categorie }}</h3>
            <p class="text-primary text-sm leading-relaxed">{{ comp.details }}</p>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="bg-accent text-white rounded-lg shadow-lg p-12 text-center">
        <h2 class="text-3xl font-bold mb-4">Envie de collaborer ?</h2>
        <p class="text-white mb-8 text-lg max-w-2xl mx-auto opacity-95">
          N'hésitez pas à me contacter pour discuter de vos projets ou pour toute opportunité de collaboration.
        </p>
        <a
          href="mailto:yousra.elyebdri@icloud.com"
          class="inline-block bg-white text-accent font-semibold py-3 px-8 rounded-lg hover:bg-accent-light transition-colors"
        >
          Me contacter
        </a>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const parcours = ref([]);
const formations = ref([]);
const competences = ref([]);

onMounted(async () => {
  try {
    const [parcoursRes, formationsRes, competencesRes] = await Promise.all([
      fetch('http://localhost:3000/api/about/parcours'),
      fetch('http://localhost:3000/api/about/formations'),
      fetch('http://localhost:3000/api/about/competences')
    ]);

    parcours.value = await parcoursRes.json();
    formations.value = await formationsRes.json();
    competences.value = await competencesRes.json();
  } catch (error) {
    console.error('Error loading about data:', error);
  }
});
</script>
