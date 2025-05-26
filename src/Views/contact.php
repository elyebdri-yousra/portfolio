<main class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mt-6 my-8">Formulaire de contact</h1>

    <form id="contactForm" action="index.php?page=contact" method="POST" class="bg-white p-4 rounded-lg shadow-md w-[50%]" aria-label="Formulaire de contact">

        <fieldset class="mb-6">
            <legend class="font-semibold text-lg mb-4">Informations personnelles</legend>

            <label for="nom" class="block mt-2">Nom :</label>
            <input type="text" id="nom" name="nom" required autocomplete="family-name" placeholder="Votre nom" class="w-full p-2 border rounded">

            <label for="prenom" class="block mt-2">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required autocomplete="given-name" placeholder="Votre prénom" class="w-full p-2 border rounded">

            <label for="email" class="block mt-2">E-mail :</label>
            <input type="email" id="email" name="email" required autocomplete="email" placeholder="votre@email.com" class="w-full p-2 border rounded">
        </fieldset>

        <fieldset class="mb-6">
            <legend class="font-semibold text-lg mb-4">Sujet :</legend>
            <textarea id="sujet" name="Sujet" required placeholder="Votre message..." rows="5" class="w-full p-2 border rounded"></textarea>
        </fieldset>

        <button type="submit" class="bg-[#DB9ECF] text-white p-5 w-full rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8">
            Envoyer
        </button>
    </form>

    <!-- Modale de confirmation -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl text-center">
            <h2 class="text-xl font-bold mb-4 text-[#DB9ECF]">Message envoyé !</h2>
            <p class="mb-4">Merci pour votre message. Nous vous répondrons dans les plus brefs délais.</p>
            <button onclick="closeModal()" class="bg-[#DB9ECF] text-white px-4 py-2 rounded hover:bg-[#c085b7]">Fermer</button>
        </div>
    </div>
</main>

<script>
    const form = document.getElementById('contactForm');
    const modal = document.getElementById('confirmationModal');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Empêche l'envoi réel

        // Simule une réussite immédiate (tu peux l'enlever si tu fais un envoi réel)
        modal.classList.remove('hidden');
    });

    function closeModal() {
        modal.classList.add('hidden');
        form.reset();
    }
</script>