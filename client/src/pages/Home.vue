<template>
  <div class="bg-surface min-h-screen">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-28">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
        <!-- Illustration - LEFT -->
        <div class="flex justify-center lg:justify-start order-2 lg:order-1">
          <div class="w-full h-96 lg:h-auto max-w-lg">
            <img :src="portraitImage" alt="Yousra EL YEBDRI" class="w-full h-full object-contain">
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
          <div class="flex flex-col items-start gap-2 mb-12">
            <div class="h-1 w-24 bg-primary"></div>
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
import portraitImage from '../assets/img/PostMe.png';
</script>
