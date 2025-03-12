<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h1 class="text-3xl font-bold">Inscription Evaluateur</h1>
        <?php if (isset($message)): ?>
            <p class="text-green-500"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php?page=create_user" method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required class="border p-2">
            <br>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required class="border p-2">
            <br>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required class="border p-2">
            <br>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required class="border p-2">
            <br>
            <button type="submit" class="bg-blue-500 text-white p-2 mt-2">S'inscrire</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>