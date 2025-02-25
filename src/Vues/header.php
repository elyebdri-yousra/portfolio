<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EL YEBDRI Yousra</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?action=login">Connexion</a></li>
                <?php else: ?>
                    <li><a href="index.php?action=logout">Déconnexion</a></li>
                <?php endif; ?>
                <li><a href="index.php?action=register">inscription</a></li>
            </ul>
        </nav>
    </header>
    <main>