<template>
  <div class="bg-surface min-h-screen">
    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-4 py-16">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Illustration/Avatar -->
        <div class="flex justify-center">
          <div class="w-64 h-64 bg-gradient-to-br from-accent to-accent2 rounded-3xl flex items-center justify-center relative">
            <div class="w-56 h-56 bg-pink-200 rounded-3xl flex items-center justify-center">
              <div class="text-6xl">👩‍💻</div>
            </div>
          </div>
        </div>

        <!-- Text Content -->
        <div>
          <h1 class="text-5xl md:text-6xl font-bold mb-2">
            <span class="text-accent">EL YEBDRI</span>
            <span class="block text-primary">Yousra</span>
          </h1>

          <div class="flex items-center gap-4 my-6 pb-6 border-b-2 border-accent border-opacity-30">
            <div class="w-1 h-12 bg-primary"></div>
            <p class="text-2xl text-primary font-medium">2026</p>
          </div>

          <p class="text-lg text-primary mb-4 leading-relaxed">
            Bienvenue sur mon portfolio !
          </p>

          <p class="text-base text-primary mb-8 leading-relaxed">
            Je suis Yousra EL YEBDRI, étudiante en BUT Métiers du Multimédia et de l'Internet (MMI).
          </p>

          <p class="text-base text-primary mb-8 leading-relaxed">
            Vous pourrez découvrir mon parcours, mes compétences, mes projets et me contacter
          </p>

          <!-- CTA Button -->
          <router-link
            to="/about"
            class="inline-block px-8 py-3 bg-accent text-white rounded-lg font-semibold hover:bg-accent-dark transition-colors">
            En savoir plus
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>
