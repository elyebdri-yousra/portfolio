<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Projet - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($projet['titre']); ?></h1>
        <?php if (!empty($projet['urlimg'])): ?>
            <img src="<?php echo htmlspecialchars($projet['urlimg']); ?>" alt="<?php echo htmlspecialchars($projet['titre']); ?>" class="my-4">
        <?php endif; ?>
        <p><?php echo htmlspecialchars($projet['description']); ?></p>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>