<main class="flex-grow flex items-center justify-center">
    <div class="container mx-auto p-6 flex flex-col md:flex-row gap-10">
        <!-- Formulaire de Connexion -->
        <div class="w-full md:w-1/2">
            <h2 class="text-3xl font-bold text-center mb-4 text-[#DB9ECF]">Connexion</h2>
            <section class="border border-gray-200 bg-white shadow-lg p-8 rounded-xl">
                <?php if (isset($errorConnexion)): ?>
                    <p class="text-red-500 mb-4"><?php echo $errorConnexion; ?></p>
                <?php endif; ?>
                <form action="index.php?page=authenticate" method="post" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email :</label>
                        <input type="email" name="email" id="email" required class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full rounded focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
                    </div>
                    <div>
                        <label for="mdp" class="block text-sm font-medium mb-1">Mot de passe :</label>
                        <input type="password" name="mdp" id="mdp" required class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full rounded focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
                    </div>
                    <button type="submit" class="bg-[#DB9ECF] text-white p-3 mt-2 rounded-xl w-[40%] hover:bg-[#c085b7] transition-colors mx-auto block">
                        Se connecter
                    </button>
                </form>
                <!-- <p class="mt-4 text-center text-sm">Pas encore inscrit ? <a href="index.php?page=register" class="text-blue-500 hover:underline">Inscription</a></p> -->
            </section>
        </div>

        <!-- Formulaire d'Inscription -->
        <div class="w-full md:w-1/2">
            <h2 class="text-3xl font-bold text-center mb-4 text-[#DB9ECF]">Inscription Évaluateur</h2>
            <section class="border border-gray-200 bg-white shadow-lg p-8 rounded-xl">
                <?php if (isset($message)): ?>
                    <p class="text-green-500 mb-4"><?php echo $message; ?></p>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <p class="text-red-500 mb-4"><?php echo $error; ?></p>
                <?php endif; ?>
                <form action="index.php?page=create_user" method="post" class="space-y-6">
                    <div class="flex gap-x-4">
                        <div class="w-1/2">
                            <label for="nom" class="block text-sm font-medium mb-1">Nom :</label>
                            <input type="text" name="nom" id="nom" required class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
                        </div>
                        <div class="w-1/2">
                            <label for="prenom" class="block text-sm font-medium mb-1">Prénom :</label>
                            <input type="text" name="prenom" id="prenom" required class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
                        </div>
                    </div>
                    <div>
                        <label for="email_reg" class="block text-sm font-medium mb-1">Email :</label>
                        <input type="email" name="email" id="email_reg" required class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full rounded focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
                    </div>
                    <div>
                        <label for="mdp_reg" class="block text-sm font-medium mb-1">Mot de passe :</label>
                        <input type="password" name="mdp" id="mdp_reg" required class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full rounded focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
                    </div>
                    <button type="submit" class="bg-[#DB9ECF] text-white p-3 mt-2 w-[50%] rounded-xl hover:bg-[#c085b7] transition-colors mx-auto block">
                        Demande d’inscription
                    </button>
                </form>
            </section>
        </div>
    </div>
</main>