<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attente</title>
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

<body class="text-gray-800  mx-auto min-h-screen flex flex-col">
    <?php include __DIR__ . '/../header.php'; ?>

    <main class="container mx-auto px-6 py-10 flex flex-col">
        <h2 class="text-3xl font-bold text-center text-[#DB9ECF] mb-6">Utilisateurs en attente</h2>

        <?php if (isset($message)) : ?>
            <p class="text-stone-800 p-4 text-center"><?= $message; ?></p>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-[#DB9ECF] text-white">
                    <tr>
                        <th class="p-4 text-left">Nom</th>
                        <th class="p-4 text-left">Prénom</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr class="border-b hover:bg-gray-50 transition duration-200">
                            <td class="p-4"><?= htmlspecialchars($user['nom']); ?></td>
                            <td class="p-4"><?= htmlspecialchars($user['prenom']); ?></td>
                            <td class="p-4"><?= htmlspecialchars($user['email']); ?></td>
                            <td class="p-4">
                                <form action="index.php?page=updateUser" method="post" class="flex space-x-2">
                                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                    <select name="new_role" class="p-4 border rounded-md focus:ring focus:ring-blue-300 ">
                                        <option value="2">Correcteur</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    <button type="submit"
                                        class="bg-[#DB9ECF] hover:bg-[#c085b7] text-white px-4 py-2 rounded-md transition duration-200 ">
                                        Modifier
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="mt-auto">
        <?php include __DIR__ . '/../footer.php';  ?>
    </footer>
</body>

</html>