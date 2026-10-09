<template>
  <div class="bg-surface min-h-screen">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-28">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
        <!-- Illustration - LEFT -->
        <div class="flex justify-center lg:justify-start order-2 lg:order-1">
          <div class="relative w-80 h-80 lg:w-96 lg:h-96">
            <!-- Outer gradient shape -->
            <div class="absolute inset-0 bg-gradient-to-br from-accent via-accent2 to-accent3 rounded-4xl transform rotate-12"></div>
            <!-- Inner avatar area -->
            <div class="absolute inset-4 bg-white rounded-3xl flex items-center justify-center shadow-2xl">
              <div class="text-center">
                <div class="text-9xl">👩‍💻</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Text Content - RIGHT -->
        <div class="order-1 lg:order-2">
          <!-- Title -->
          <h1 class="text-5xl lg:text-6xl font-bold mb-6">
            <span class="text-accent block">EL YEBDRI</span>
            <span class="text-primary">Yousra</span>
          </h1>

          <!-- Separator with year -->
          <div class="flex items-center gap-6 mb-12 pb-6">
            <div class="h-20 w-1 bg-primary"></div>
            <p class="text-5xl lg:text-6xl text-primary font-bold">2026</p>
          </div>

          <!-- Main text -->
          <div class="space-y-6 mb-12">
            <p class="text-xl text-primary font-semibold">
              Bienvenue sur mon portfolio !
            </p>

            <p class="text-lg text-primary leading-relaxed">
              Je suis Yousra EL YEBDRI, étudiante en BUT Métiers du Multimédia et de l'Internet (MMI).
            </p>

            <p class="text-lg text-primary leading-relaxed">
              Vous pourrez découvrir mon parcours, mes compétences, mes projets et me contacter
            </p>
          </div>

          <!-- CTA Button -->
          <router-link
            to="/about"
            class="inline-block px-8 py-4 bg-accent text-white rounded-lg font-bold text-lg hover:bg-accent-dark transition-all duration-300 shadow-lg hover:shadow-xl">
            En savoir plus
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>
