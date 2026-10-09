<template>
  <div class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-6xl mx-auto">
      <!-- Hero Section -->
      <div class="mb-16">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">À propos de moi</h1>
        <p class="text-xl text-gray-600">Développeuse Web & Étudiante en MMI</p>
      </div>

      <!-- Parcours Section -->
      <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Mon parcours professionnel</h2>
        <div class="space-y-6">
          <div
            v-for="(exp, index) in parcours"
            :key="index"
            class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500"
          >
            <div class="flex justify-between items-start mb-3">
              <div>
                <h3 class="text-xl font-semibold text-gray-900">{{ exp.poste }}</h3>
                <p class="text-sm text-gray-600">{{ exp.entreprise }}</p>
              </div>
              <span class="text-sm font-medium text-gray-500 whitespace-nowrap ml-4">{{ exp.periode }}</span>
            </div>
            <p class="text-gray-700 whitespace-pre-wrap text-sm leading-relaxed">{{ exp.missions }}</p>
          </div>
        </div>
      </section>

      <!-- Formations Section -->
      <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Formations</h2>
        <div class="space-y-6">
          <div
            v-for="(formation, index) in formations"
            :key="index"
            class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500"
          >
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ formation.titre }}</h3>
            <p class="text-sm text-gray-600 mb-3 font-medium">{{ formation.etablissement }}</p>
            <p class="text-gray-700 whitespace-pre-wrap text-sm leading-relaxed">{{ formation.contenu }}</p>
          </div>
        </div>
      </section>

      <!-- Compétences Section -->
      <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Compétences</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="(comp, index) in competences"
            :key="index"
            class="bg-white rounded-lg shadow-md p-6 border-t-4 border-purple-500"
          >
            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ comp.categorie }}</h3>
            <p class="text-gray-700 text-sm leading-relaxed">{{ comp.details }}</p>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="bg-blue-600 text-white rounded-lg shadow-lg p-12 text-center">
        <h2 class="text-3xl font-bold mb-4">Envie de collaborer ?</h2>
        <p class="text-blue-100 mb-8 text-lg max-w-2xl mx-auto">
          N'hésitez pas à me contacter pour discuter de vos projets ou pour toute opportunité de collaboration.
        </p>
        <a
          href="mailto:yousra.elyebdri@icloud.com"
          class="inline-block bg-white text-blue-600 font-semibold py-3 px-8 rounded-lg hover:bg-blue-50 transition-colors"
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
