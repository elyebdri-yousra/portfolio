<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h1 class="text-3xl font-bold">Liste des Projets</h1>
        <?php if (!empty($projets)) : ?>
            <ul>
                <?php foreach ($projets as $projet) : ?>
                    <li class="border p-2 my-2">
                        <h2 class="text-2xl"><?php echo htmlspecialchars($projet['titre']); ?></h2>
                        <p><?php echo htmlspecialchars($projet['description']); ?></p>
                        <a href="index.php?page=projet_show&id=<?php echo $projet['id']; ?>" class="text-blue-500">Voir le projet</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucun projet disponible.</p>
        <?php endif; ?>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>