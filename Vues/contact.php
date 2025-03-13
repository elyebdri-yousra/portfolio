<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact me</title>
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

<body class="bg-[#F7F5EE] max-w-[1440px] mx-auto min-h-screen flex flex-col">
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h2 class="text-3xl font-bold mt-6 my-8">Formulaire de contact</h2>
        <form action="index.php?page=contact" method="GET" class="bg-white p-4 rounded-lg shadow-md w-[50%]">
            <label class="block mt-2">Nom :</label>
            <input type="text" name="nom" required class="w-full p-2 border rounded">

            <label class="block mt-2">Prénom :</label>
            <input type="text" name="prenom" required class="w-full p-2 border rounded"></input>

            <label class="block mt-2">E-mail :</label>
            <input type="email" name="email" required class="w-full p-2 border rounded">

            <label class="block mt-2">Sujet :</label>
            <textarea name="Sujet" required class="w-full p-2 border rounded"></textarea>

            <button type="submit" class="bg-[#DB9ECF] text-white p-5 w-full rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8">Envoyer</button>
        </form>

    </main>

    <footer class="mt-auto">
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>