<?php
require '../vendor/autoload.php';
require '../config/bdd.php';
require '../src/Modeles/PdoPortfolio.php';
require '../src/Controller/UserController.php';

$userController = new UserController(); // Créer une instance du contrôleur
$utilisateurs = $userController->donneListe(); // Appeler la fonction

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="donneListe">
        <?php foreach ($utilisateurs as $user): ?>
            <li><?= htmlspecialchars($user['nom']); ?> - <?= htmlspecialchars($user['email']); ?></li>
        <?php endforeach; ?>
    </section>
</body>

</html>