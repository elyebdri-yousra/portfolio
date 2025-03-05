<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Correcteur</title>
</head>
<body>
<?php include 'entete.php' ?>
    <main>
        <section>
            <h1>NOUVEAU CLIENT</h1>
            <p>Veuillez entrer les informations sur le client :</p>

            <form action='insertion.php' method='get'>
                Nom : <input type='text' name='nom' required /><br />
                Prénom : <input type='text' name='prenom' required /><br />
                Email : <input type='email' name='email' required /><br />
                Mot de passe : <input type='password' name='mdp' required /><br />
                <input type='submit' value='Crée mon compte' /><br />
            </form>

            <?php

            ?>
        </section>
    </main>

</body>
</html>