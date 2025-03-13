<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets - Mon Portfolio</title>
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

<body class=" mx-auto min-h-screen flex flex-col">
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4">
        <h1 class="text-5xl font-bold my-6">Portfolio de Formation</h1>
        <div class="flex items-center gap-4 mb-20">
            <p class="text-lg w-1/2">
                Explorez les projets qui jalonnent mon parcours, principalement réalisés dans le cadre de mon BUT MMI, mais aussi issus d’autres formations et expériences, reflétant mon évolution et ma polyvalence dans le domaine du multimédia et du digital.
            </p>
            <p class="text-center w-1/2"">↙ Cliquez ici pour découvrir le projet et son explication !</p>
        </div>

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

        <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) : ?>
            <h2 class="text-3xl font-bold mt-6 my-8">Ajouter un projet</h2>
            <form action="index.php?page=projet_add" method="POST" class="bg-white p-4 rounded-lg shadow-md w-[50%]">
                <label class="block mt-2">Titre du projet :</label>
                <input type="text" name="titre" required class="w-full p-2 border rounded">

                <label class="block mt-2">Description :</label>
                <textarea name="description" required class="w-full p-2 border rounded"></textarea>

                <label class="block mt-2">Année de création (BUT) :</label>
                <input type="number" name="annee_but" required class="w-full p-2 border rounded">

                <label class="block mt-2">Date d'ajout :</label>
                <input type="date" name="date" required class="w-full p-2 border rounded">

                <label class="block mt-2">Apprentissage critique :</label>
                <input type="text" name="apprentissage" class="w-full p-2 border rounded">

                <label class="block mt-2">Compétence associée :</label>
                <input type="text" name="competence" class="w-full p-2 border rounded">

                <label class="block mt-2">Type de projet :</label>
                <select name="type" required class="w-full p-2 border rounded">
                    <option value="infographie">Infographie</option>
                    <option value="vidéo">Production audio visuelle</option>
                    <option value="programme">Développement</option>
                    <option value="texte">Communication</option>
                </select>

                <label class="block mt-2">Argumentaire :</label>
                <textarea name="argumentaire" required class="w-full p-2 border rounded"></textarea>

                <button type="submit" class="bg-[#DB9ECF] text-white p-5 w-full rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8">Ajouter</button>
            </form>
        <?php else : ?>
            <p> </p>
        <?php endif; ?>
    </main>
    <footer class="mt-auto">
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>