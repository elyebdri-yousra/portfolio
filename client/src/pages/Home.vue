<template>
  <div class="bg-surface min-h-screen pt-8">
    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-4 py-12 md:py-20">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-center">
        <!-- Illustration/Avatar -->
        <div class="flex justify-center md:justify-start order-2 md:order-1">
          <div class="relative w-72 h-72">
            <!-- Gradient background -->
            <div class="absolute inset-0 bg-gradient-to-br from-accent via-accent2 to-accent rounded-3xl transform -rotate-6 opacity-100"></div>
            <!-- Avatar container -->
            <div class="absolute inset-0 bg-accent rounded-3xl flex items-center justify-center overflow-hidden">
              <div class="text-center">
                <div class="text-8xl mb-4">👩‍💻</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Text Content -->
        <div class="order-1 md:order-2">
          <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="text-accent">EL YEBDRI</span>
            <span class="block text-primary">Yousra</span>
          </h1>

          <div class="flex items-center gap-6 my-8 pb-6 border-b-4 border-accent border-opacity-40">
            <div class="h-16 w-1 bg-primary"></div>
            <p class="text-4xl text-primary font-bold">2026</p>
          </div>

          <div class="space-y-4 mb-8">
            <p class="text-lg text-primary font-medium">
              Bienvenue sur mon portfolio !
            </p>

            <p class="text-base text-primary leading-relaxed">
              Je suis Yousra EL YEBDRI, étudiante en BUT Métiers du Multimédia et de l'Internet (MMI).
            </p>

            <p class="text-base text-primary leading-relaxed">
              Vous pourrez découvrir mon parcours, mes compétences, mes projets et me contacter
            </p>
          </div>

          <!-- CTA Button -->
          <router-link
            to="/about"
            class="inline-block px-6 py-3 bg-accent text-white rounded font-semibold hover:bg-accent-dark transition-colors">
            En savoir plus
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>
