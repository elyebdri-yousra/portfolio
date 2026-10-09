<template>
  <div class="min-h-screen">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Text Content -->
        <div>
          <div class="mb-6">
            <span class="inline-block px-4 py-2 bg-blue-100 text-accent rounded-full text-sm font-semibold mb-4">
              👋 Bienvenue
            </span>
          </div>

          <h1 class="text-5xl sm:text-6xl font-bold text-primary mb-4">
            Yousra
            <span class="block text-accent">EL YEBDRI</span>
          </h1>

          <p class="text-xl text-gray-600 mb-4 leading-relaxed">
            Développeuse Web & Étudiante en BUT MMI
          </p>

          <p class="text-lg text-gray-600 mb-8 leading-relaxed">
            Je crée des expériences web modernes, accessibles et performantes. Passionnée par Vue.js, Node.js et le design centrés utilisateur.
          </p>

          <!-- CTA Buttons -->
          <div class="flex flex-col sm:flex-row gap-4">
            <router-link
              to="/about"
              class="inline-flex items-center justify-center px-8 py-4 bg-accent text-white rounded-lg font-semibold hover:bg-accent-dark transition-colors">
              En savoir plus
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </router-link>
            <router-link
              to="/projets"
              class="inline-flex items-center justify-center px-8 py-4 border-2 border-accent text-accent rounded-lg font-semibold hover:bg-accent hover:text-white transition-colors">
              Voir mes projets
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </router-link>
          </div>

          <!-- Stats -->
          <div class="mt-12 grid grid-cols-3 gap-4">
            <div>
              <div class="text-3xl font-bold text-accent">7</div>
              <div class="text-gray-600 text-sm">Projets</div>
            </div>
            <div>
              <div class="text-3xl font-bold text-accent">6</div>
              <div class="text-gray-600 text-sm">Compétences</div>
            </div>
            <div>
              <div class="text-3xl font-bold text-accent">2+</div>
              <div class="text-gray-600 text-sm">Ans d'exp</div>
            </div>
          </div>
        </div>

        <!-- Image -->
        <div class="flex justify-center">
          <div class="relative">
            <div class="absolute inset-0 bg-accent opacity-20 rounded-3xl transform rotate-3 scale-105"></div>
            <img
              src="https://via.placeholder.com/500x600?text=Yousra"
              alt="Yousra EL YEBDRI"
              class="relative rounded-3xl shadow-xl w-full max-w-md object-cover">
          </div>
        </div>
      </div>
    </section>

    <!-- Skills Section -->
    <section class="bg-surface py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-primary mb-12 text-center">Stack Technologique</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <div class="text-3xl mb-3">⚡</div>
            <h3 class="font-semibold text-primary">Frontend</h3>
            <p class="text-gray-600 text-sm mt-2">Vue 3, Tailwind CSS, Vite</p>
          </div>
          <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <div class="text-3xl mb-3">🚀</div>
            <h3 class="font-semibold text-primary">Backend</h3>
            <p class="text-gray-600 text-sm mt-2">Node.js, Express.js, JWT</p>
          </div>
          <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <div class="text-3xl mb-3">💾</div>
            <h3 class="font-semibold text-primary">Database</h3>
            <p class="text-gray-600 text-sm mt-2">PostgreSQL, SQL</p>
          </div>
          <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <div class="text-3xl mb-3">🐳</div>
            <h3 class="font-semibold text-primary">Infra</h3>
            <p class="text-gray-600 text-sm mt-2">Docker, Git, Linux</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Projects -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <h2 class="text-3xl font-bold text-primary mb-4">Projets en vedette</h2>
      <p class="text-gray-600 mb-12">Décourez quelques projets récents qui mettent en avant mes compétences</p>

      <router-link
        to="/projets"
        class="inline-flex items-center text-accent font-semibold hover:text-accent-dark transition-colors">
        Voir tous les projets
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
      </router-link>
    </section>
  </div>
</template>

<script setup>
</script>
