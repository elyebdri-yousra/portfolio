<template>
  <main class="container mx-auto p-4 flex flex-col lg:flex-row items-center justify-center gap-8 h-full max-w-full lg:w-[1200px]">
    <!-- Image -->
    <div class="w-full lg:w-auto flex justify-center">
      <img
        class="w-full max-w-[300px] sm:max-w-sm md:max-w-md lg:h-[600px] lg:w-auto object-cover rounded-2xl"
        src="https://via.placeholder.com/400x600?text=Yousra+El+Yebdri"
        alt="Portrait de Yousra El Yebdri, développeuse web et designer"
        loading="lazy">
    </div>

    <!-- Texte -->
    <section aria-label="Introduction du portfolio de Yousra El Yebdri" class="text-left lg:text-left w-full px-4 sm:px-8">
      <h1 class="text-4xl sm:text-5xl md:text-[69px] font-bold">EL YEBDRI Yousra</h1>

      <div class="flex items-center justify-between gap-4 my-4">
        <hr class="flex-grow border-t border-stone-700">
        <p class="text-3xl sm:text-4xl md:text-5xl text-stone-700 whitespace-nowrap">2026</p>
      </div>

      <p class="text-base sm:text-lg text-gray-800 mb-10">
        Étudiante en BUT Métiers du Multimédia et de l'Internet et développeuse web en alternance, je conçois des interfaces modernes, accessibles et centrées utilisateur. J'aime transformer des besoins en solutions concrètes.
      </p>

      <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
        <router-link
          to="/about"
          class="bg-[#DB9ECF] text-white px-8 py-4 rounded-xl hover:bg-[#c085b7] transition-colors text-base sm:text-lg flex items-center justify-center">
          En savoir plus
        </router-link>
        <router-link
          to="/projet"
          class="border-2 border-[#DB9ECF] text-[#DB9ECF] px-8 py-4 rounded-xl hover:bg-[#DB9ECF] hover:text-white transition-colors text-base sm:text-lg flex items-center justify-center">
          Voir mes projets
        </router-link>
      </div>
    </section>
  </main>
</template>

<script setup>
</script>

<style scoped>
main {
  min-height: 100vh;
}

@media (max-width: 1024px) {
  main {
    flex-direction: column;
  }
}
</style>
