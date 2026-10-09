<header class="bg-[#F7F5EE] text-stone-700 text-xl" style="font-family: 'Cantarell', sans-serif;">
  <nav class="container mx-auto flex items-center justify-between flex-wrap w-full">
    
    <div class="flex items-center space-x-10">
      <a href="index.php?page=home" class="font-bold hidden md:inline">
        <img
          class="w-full max-w-[100px] object-cover"
          src="/assets/img/PostMe.png"
          alt="Portrait de Yousra El Yebdri, développeuse web et designer"
          loading="lazy">
      </a>
      <a href="index.php?page=about" class="font-bold hidden md:inline">À propos</a>
      <a href="index.php?page=projet" class="font-bold hidden md:inline">Projets</a>
      <a href="index.php?page=veille" class="font-bold hidden md:inline">Veille technologique</a>
      <a href="mailto:yousra.elyebdri@icloud.com" class="font-bold hidden md:inline">Contact</a>
    </div>

    <!-- Bloc droit -->
    <div class="flex items-center space-x-6">
      
      <?php if (isset($_SESSION['user']['idRole']) && $_SESSION['user']['idRole'] == 1): ?>
        <a href="index.php?page=manageUsers" class="font-bold text-[#DB9ECF] hidden md:inline">
          Gérer les utilisateurs
        </a>
      <?php endif; ?>

      <button id="menu-toggle" class="md:hidden text-3xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </nav>

  <!-- Menu mobile -->
  <div id="menu-mobile" class="md:hidden hidden flex-col space-y-4 px-6 mt-4 bg-[#F7F5EE] shadow-md rounded-md">
    <a href="index.php?page=home" class="block font-bold">Accueil</a>
    <a href="index.php?page=about" class="block font-bold">À propos</a>
    <a href="index.php?page=projet" class="block font-bold">Projets</a>
    <a href="index.php?page=veille" class="block font-bold">Veille technologique</a>
    <a href="mailto:yousra.elyebdri@icloud.com" class="block font-bold">Contact</a>

    <?php if (isset($_SESSION['user']['idRole']) && $_SESSION['user']['idRole'] == 1): ?>
      <a href="index.php?page=manageUsers" class="block font-bold text-[#DB9ECF]">
        Gérer les utilisateurs
      </a>
    <?php endif; ?>
  </div>
</header>
