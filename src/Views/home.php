<main class="container mx-auto p-4 flex flex-col lg:flex-row items-center justify-center gap-8 h-full max-w-full lg:w-[1200px]" role="main">
  <!-- Image -->
  <div class="w-full lg:w-auto flex justify-center">
    <img
      class="w-full max-w-[300px] sm:max-w-sm md:max-w-md lg:h-[600px] lg:w-auto object-cover"
      src="/assets/img/PostMe.png"
      alt="Portrait de Yousra El Yebdri, développeuse web et designer"
      loading="lazy">
  </div>

  <!-- Texte -->
  <section aria-label="Introduction du portfolio de Yousra El Yebdri" class="text-left lg:text-left w-full px-4 sm:px-8">
    <h1 class="text-4xl sm:text-5xl md:text-[69px] font-bold">PORTFOLIO</h1>

    <div class="flex items-center justify-between gap-4 my-4">
      <hr class="flex-grow border-t border-stone-700">
      <p class="text-3xl sm:text-4xl md:text-5xl text-stone-700 whitespace-nowrap">2025</p>
    </div>

    <p class="text-base sm:text-lg text-gray-800 mb-10">
      <?php echo $message; ?>
    </p>

    <div class="flex justify-center lg:justify-start">
      <a
        href="index.php?page=about"
        class="bg-[#DB9ECF] text-white px-8 py-4 rounded-xl hover:bg-[#c085b7] transition-colors w-full sm:w-auto text-base sm:text-lg flex items-center justify-center max-w-xs">
        En savoir plus
      </a>
    </div>
  </section>
</main>