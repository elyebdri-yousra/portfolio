<header class="bg-gray-800 text-white p-4">
    <nav class="container mx-auto flex justify-between">
        <a href="index.php?page=home" class="font-bold">Accueil</a>
        <a href="index.php?page=projet" class="font-bold">Projets</a>
        <?php 
            session_start();
            if(isset($_SESSION['user'])) {
                echo '<a href="index.php?page=logout" class="font-bold">Déconnexion</a>';
            } else {
                echo '<a href="index.php?page=login" class="font-bold">Connexion</a>';
            }
        ?>
    </nav>
</header>