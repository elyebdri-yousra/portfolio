<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h1 class="text-3xl font-bold">Accueil</h1>
        <p><?php echo $message; ?></p>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>