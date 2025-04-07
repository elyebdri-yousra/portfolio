<?php
// Démarrer la session dès le début si elle n'est pas encore active
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>


<header class="bg-[#F7F5EE] text-stone-700 text-xl p-6" style="font-family: 'Cantarell', sans-serif;">
  <nav class="container mx-auto flex justify-between items-center">
    <!-- Navigation principale -->
    <div class="flex space-x-10">
      <a href="index.php?page=home" class="font-bold">Accueil</a>
      <a href="index.php?page=about" class="font-bold">À propos</a>
      <a href="index.php?page=projet" class="font-bold">Projets</a>
      <a href="index.php?page=contact" class="font-bold">Contact</a>
    </div>

    <!-- Icône de connexion/déconnexion -->
    <div class="flex space-x-10">
      <!-- Afficher "Gérer les utilisateurs" uniquement pour l'admin -->
      <?php if (isset($_SESSION['user']['idRole']) && $_SESSION['user']['idRole'] == 1): ?>
        <a href="index.php?page=manageUsers" class="font-bold text-[#DB9ECF]">Gérer les utilisateurs</a>
      <?php endif; ?>
      <?php if (isset($_SESSION['user'])): ?>
        <!-- Utilisateur connecté : icône rose pour accéder au profil -->
        <a href="index.php?page=logout" class="font-bold">
          <i class="fa-solid fa-circle-user text-[#DB9ECF] text-3xl"></i>
        </a>
      <?php else: ?>
        <!-- Utilisateur non connecté : icône noire pour la connexion -->
        <a href="index.php?page=auth" class="font-bold">
          <i class="fa-solid fa-user text-stone-700 text-3xl"></i>
        </a>
      <?php endif; ?>
    </div>
  </nav>
</header>