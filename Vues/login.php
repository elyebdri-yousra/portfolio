<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h1 class="text-3xl font-bold">Connexion</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php?page=authenticate" method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required class="border p-2">
            <br>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required class="border p-2">
            <br>
            <button type="submit" class="bg-blue-500 text-white p-2 mt-2">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="index.php?page=register" class="text-blue-500">Inscription</a></p>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>