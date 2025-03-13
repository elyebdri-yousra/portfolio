<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Cantarell:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>

<body class="max-w-[1440px] mx-auto min-h-screen flex flex-col">
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4 flex flex-col items-center justify-center flex-grow">
        <h1 class="text-3xl font-bold mb-4">Déconnexion</h1>
        <p class="mb-4">Êtes-vous sûr de vouloir vous déconnecter ?</p>
        <form action="index.php?page=logout_action" method="post">
            <button type="submit" class="bg-[#DB9ECF] text-white p-5  rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8">
                Se déconnecter
            </button>
        </form>
    </main>
    <footer class="mt-auto">
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>