<main class="container mx-auto p-4">
    <h2 class="text-3xl font-bold mt-6 my-8">Formulaire de contact</h2>
    <form action="index.php?page=contact" method="POST" class="bg-white p-4 rounded-lg shadow-md w-[50%]">
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