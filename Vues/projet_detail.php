<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Projet - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-[#F7F5EE]">
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