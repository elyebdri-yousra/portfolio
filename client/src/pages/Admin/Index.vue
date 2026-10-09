<template>
  <div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-6xl mx-auto">
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Panneau d'administration</h1>
        <p class="text-gray-600">Gérez votre portfolio et vos contenus</p>
      </div>

      <!-- Admin Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- About Section -->
        <router-link
          to="/admin/about"
          class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow cursor-pointer">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h2 class="text-xl font-bold text-gray-900">À propos</h2>
              <p class="text-gray-600 text-sm">Gérer les sections About</p>
            </div>
            <span class="text-3xl">📋</span>
          </div>
          <p class="text-gray-700 text-sm">
            Modifiez vos expériences professionnelles, formations et compétences
          </p>
        </router-link>

        <!-- Utilisateurs Section -->
        <router-link
          to="/admin/utilisateurs"
          class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow cursor-pointer">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Utilisateurs</h2>
              <p class="text-gray-600 text-sm">Gérer les accès</p>
            </div>
            <span class="text-3xl">👥</span>
          </div>
          <p class="text-gray-700 text-sm">
            Validez les inscriptions et gérez les rôles des utilisateurs
          </p>
        </router-link>

        <!-- Projets Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 opacity-50 cursor-not-allowed">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Projets</h2>
              <p class="text-gray-600 text-sm">Bientôt disponible</p>
            </div>
            <span class="text-3xl">🚀</span>
          </div>
          <p class="text-gray-700 text-sm">
            Ajoutez, modifiez ou supprimez vos projets
          </p>
        </div>

        <!-- Paramètres Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 opacity-50 cursor-not-allowed">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Paramètres</h2>
              <p class="text-gray-600 text-sm">Bientôt disponible</p>
            </div>
            <span class="text-3xl">⚙️</span>
          </div>
          <p class="text-gray-700 text-sm">
            Configurez les paramètres de votre portfolio
          </p>
        </div>

        <!-- Veille Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 opacity-50 cursor-not-allowed">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Veille</h2>
              <p class="text-gray-600 text-sm">Bientôt disponible</p>
            </div>
            <span class="text-3xl">📰</span>
          </div>
          <p class="text-gray-700 text-sm">
            Gérez vos sources de veille technologique
          </p>
        </div>

        <!-- Analytics Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 opacity-50 cursor-not-allowed">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Analytiques</h2>
              <p class="text-gray-600 text-sm">Bientôt disponible</p>
            </div>
            <span class="text-3xl">📊</span>
          </div>
          <p class="text-gray-700 text-sm">
            Consultez les statistiques de votre portfolio
          </p>
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Statistiques rapides</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="text-center p-4 bg-blue-50 rounded-lg">
            <div class="text-3xl font-bold text-blue-600">7</div>
            <div class="text-sm text-gray-600">Projets</div>
          </div>
          <div class="text-center p-4 bg-green-50 rounded-lg">
            <div class="text-3xl font-bold text-green-600">6</div>
            <div class="text-sm text-gray-600">Compétences</div>
          </div>
          <div class="text-center p-4 bg-purple-50 rounded-lg">
            <div class="text-3xl font-bold text-purple-600">2</div>
            <div class="text-sm text-gray-600">Formations</div>
          </div>
          <div class="text-center p-4 bg-orange-50 rounded-lg">
            <div class="text-3xl font-bold text-orange-600">2</div>
            <div class="text-sm text-gray-600">Expériences</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
