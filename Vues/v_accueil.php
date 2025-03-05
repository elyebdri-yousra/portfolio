<?php
// Vérification pour éviter les erreurs si `$users` est vide ou mal défini
if (!isset($users) || !is_array($users) || empty($users)) {
    echo "<p>Aucun utilisateur trouvé.</p>";
    return; // Arrête l'exécution ici si la liste est vide
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <h1>Liste des utilisateurs</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user->getId()) ?></td>
                    <td><?= htmlspecialchars($user->getNom()) ?></td>
                    <td><?= htmlspecialchars($user->getPrenom()) ?></td>
                    <td><?= htmlspecialchars($user->getEmail()) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>