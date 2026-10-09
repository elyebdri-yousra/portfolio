<main class="flex-grow flex items-center justify-center">
  <div class="container mx-auto p-6 w-full max-w-3xl">

    <!-- Onglets -->
    <nav aria-label="Navigation entre les formulaires" class="flex justify-center mb-6" role="tablist">
      <button id="tab-login" class="px-4 py-2 font-semibold text-[#DB9ECF] border-b-2 border-[#DB9ECF]" role="tab" aria-selected="true">Connexion</button>
      <button id="tab-register" class="px-4 py-2 font-semibold text-gray-500" role="tab" aria-selected="false">Inscription</button>
    </nav>

    <!-- Formulaire de Connexion -->
    <section id="login-form" aria-labelledby="tab-login">
      <h1 class="text-3xl font-bold text-center mb-4 text-[#DB9ECF]">Connexion</h1>
      <article class="border border-gray-200 bg-white shadow-lg p-8 rounded-xl" role="form">
        <?php if (isset($errorConnexion)): ?>
          <p class="text-red-500 mb-4"><?php echo $errorConnexion; ?></p>
        <?php endif; ?>
        <form action="index.php?page=authenticate" method="post" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium mb-1">Adresse e-mail :</label>
            <input type="email" name="email" id="email" required autocomplete="email" placeholder="votre@email.com" class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
          </div>
          <div>
            <label for="mdp" class="block text-sm font-medium mb-1">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required autocomplete="current-password" placeholder="Votre mot de passe" class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
          </div>
          <button type="submit" class="bg-[#DB9ECF] text-white p-3 mt-2 rounded-xl w-[40%] hover:bg-[#c085b7] transition-colors mx-auto block">
            Se connecter
          </button>
        </form>
      </article>
    </section>

    <!-- Formulaire d'Inscription -->
    <section id="register-form" class="hidden" aria-labelledby="tab-register">
      <h2 class="text-3xl font-bold text-center mb-4 text-[#DB9ECF]">Inscription Évaluateur</h2>
      <article class="border border-gray-200 bg-white shadow-lg p-8 rounded-xl" role="form">
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
              <input type="text" name="nom" id="nom" required autocomplete="family-name" placeholder="Nom" class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
            </div>
            <div class="w-1/2">
              <label for="prenom" class="block text-sm font-medium mb-1">Prénom :</label>
              <input type="text" name="prenom" id="prenom" required autocomplete="given-name" placeholder="Prénom" class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
            </div>
          </div>
          <div>
            <label for="email_reg" class="block text-sm font-medium mb-1">Adresse e-mail :</label>
            <input type="email" name="email" id="email_reg" required autocomplete="email" placeholder="votre@email.com" class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
          </div>
          <div>
            <label for="mdp_reg" class="block text-sm font-medium mb-1">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp_reg" required autocomplete="new-password" placeholder="Choisissez un mot de passe sécurisé" class="border rounded-xl border-gray-300 bg-gray-100 p-3 w-full focus:outline-none focus:ring-2 focus:ring-[#DB9ECF]">
          </div>
          <button type="submit" class="bg-[#DB9ECF] text-white p-3 mt-2 w-[50%] rounded-xl hover:bg-[#c085b7] transition-colors mx-auto block">
            Demande d’inscription
          </button>
        </form>
      </article>
    </section>
  </div>
</main>

<!-- JS pour l’alternance des onglets -->
<script>
  const tabLogin = document.getElementById('tab-login');
  const tabRegister = document.getElementById('tab-register');
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');

  tabLogin.addEventListener('click', () => {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
    tabLogin.classList.add('text-[#DB9ECF]', 'border-b-2', 'border-[#DB9ECF]');
    tabRegister.classList.remove('text-[#DB9ECF]', 'border-b-2', 'border-[#DB9ECF]');
    tabRegister.classList.add('text-gray-500');
    tabLogin.setAttribute("aria-selected", "true");
    tabRegister.setAttribute("aria-selected", "false");
  });

  tabRegister.addEventListener('click', () => {
    registerForm.classList.remove('hidden');
    loginForm.classList.add('hidden');
    tabRegister.classList.add('text-[#DB9ECF]', 'border-b-2', 'border-[#DB9ECF]');
    tabLogin.classList.remove('text-[#DB9ECF]', 'border-b-2', 'border-[#DB9ECF]');
    tabLogin.classList.add('text-gray-500');
    tabLogin.setAttribute("aria-selected", "false");
    tabRegister.setAttribute("aria-selected", "true");
  });
</script>