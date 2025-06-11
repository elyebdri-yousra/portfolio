<main class="container mx-auto p-4 scrollbar-none overflow-auto" role="main" aria-label="Liste des projets du portfolio de formation">

  <!-- Titre + bouton -->
  <div class="w-full flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-5xl font-bold my-6" aria-label="Titre principal : Portfolio de formation">Portfolio de Formation</h1>

    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) : ?>
      <button id="openOverlayBtn" aria-haspopup="dialog" aria-controls="overlay" aria-expanded="false"
        class="bg-[#DB9ECF] text-white px-[80px] py-[20px] rounded-xl hover:bg-[#c085b7] transition-colors  sm:w-auto text-base sm:text-lg flex  items-center justify-center w-[300px] ">
        Ajouter un projet
      </button>

      <!-- Modale d'ajout de projet -->
      <div id="overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-2">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-[90%] max-h-[85%] relative overflow-auto">
          <button id="closeOverlayBtn" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" aria-label="Fermer la fenêtre d'ajout">
            <i class="fas fa-times fa-xl"></i>
          </button>
          <h2 id="modalTitle" class="text-2xl font-bold mb-4">Ajouter un projet</h2>

          <form action="index.php?page=projet_add" method="POST" enctype="multipart/form-data"
            class="flex flex-col lg:flex-row justify-around gap-6" aria-label="Formulaire d'ajout de projet">
            <div class="w-full lg:w-[80%] grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="col-span-2">
                <label for="titre">Titre du projet :</label>
                <input type="text" name="titre" id="titre" required class="w-full p-2 border rounded">
              </div>

              <div>
                <label for="images">Images :</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple class="w-full p-2 border rounded">
              </div>

              <div>
                <label for="annee_but">Année de création (BUT) :</label>
                <input type="number" name="annee_but" id="annee_but" required class="w-full p-2 border rounded">
              </div>

              <div>
                <label for="date">Date d'ajout :</label>
                <input type="date" name="date" id="date" required class="w-full p-2 border rounded">
              </div>

              <div>
                <label for="type">Type de projet :</label>
                <select name="type" id="type" required class="w-full p-2 border rounded">
                  <option value="programme">Développement</option>
                  <option value="infographie">Infographie</option>
                  <option value="vidéo">Production audio visuelle</option>
                  <option value="texte">Communication</option>
                </select>
              </div>

              <div class="col-span-2">
                <label for="description">Description :</label>
                <textarea name="description" id="description" required class="w-full p-2 border rounded h-20"></textarea>
              </div>

              <div class="col-span-2">
                <label for="apprentissage">Argumentaire :</label>
                <textarea name="apprentissage" id="apprentissage" required class="w-full p-2 border rounded h-20"></textarea>
              </div>

              <div class="col-span-2">
                <label for="argumentaire">Apprentissage critique :</label>
                <textarea name="argumentaire" id="argumentaire" required class="w-full p-2 border rounded h-20"></textarea>
              </div>

              <div class="col-span-2">
                <button type="submit" class="bg-[#DB9ECF] text-white p-3 w-full rounded-xl hover:bg-[#c085b7] transition-colors">
                  Ajouter
                </button>
              </div>
            </div>

            <div class="w-[18%]  justify-around flex flex-col ">
              <div class="w-[100%]  h-[49%] justify-start items-center flex space-y-4 flex-col">
                <a href="index.php?page=logiciel" class="font-[Cantarell] text-[#DB9ECF]">Ajouter des logiciels +</a>
                <fieldset>
                  <legend class="font-[Cantarell]">Choisir les logiciels :</legend>
                  <?php foreach ($logiciels as $logiciel) { ?>
                    <div>
                      <input type="checkbox" id="<?php echo $logiciel['nomLogiciel']; ?>" name="logiciels[]" value="<?php echo $logiciel['id']; ?>" />
                      <label for="<?php echo $logiciel['nomLogiciel']; ?>"><?php echo $logiciel['nomLogiciel']; ?></label>
                    </div>
                  <?php } ?>
                </fieldset>
              </div>

              <div class="w-[100%] h-[49%] justify-start items-center flex space-y-4 flex-col">
                <fieldset>
                  <legend class="font-[Cantarell]">Choisir les compétences :</legend>
                  <?php foreach ($competences as $competence) { ?>
                    <div>
                      <input type="checkbox" id="<?php echo $competence['nom']; ?>" name="competences[]" value="<?php echo $competence['id']; ?>" />
                      <label for="<?php echo $competence['nom']; ?>"><?php echo $competence['nom']; ?></label>
                    </div>
                  <?php } ?>
                </fieldset>
              </div>
            </div>


          </form>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Intro projet -->
  <div class="w-full sm:max-w-[720px] sm:mr-auto sm:col-span-2 mb-20 px-2">
    <p class="text-lg text-left sm:text-left"">
      Explorez les projets qui jalonnent mon parcours, principalement réalisés dans le cadre de mon BUT MMI, mais aussi issus d’autres formations et expériences, reflétant mon évolution et ma polyvalence dans le domaine du multimédia et du digital.
    </p>
  </div>

  <form id=" filtre-form" class="mb-6">
      <label for="filtre-type" class="block mb-2 font-semibold">Type :</label>
      <select id="filtre-type" class="mb-4 w-full border rounded p-2">
        <option value="">-- Tous les types --</option>
        <option value="programme">Développement</option>
        <option value="infographie">Infographie</option>
        <option value="vidéo">Production audio visuelle</option>
        <option value="texte">Communication</option>
        <!-- Ajoute ici tous les types que tu utilises -->
      </select>

      <label for="filtre-competences" class="block mb-2 font-semibold">Compétences :</label>
      <select id="filtre-competences" multiple class="w-full border rounded p-2">
        <?php foreach ($competences as $compt) { ?>
          <option value="<?php echo $compt['nom'] ?>"><?php echo $compt['nom'] ?></option>
        <?php } ?>
      </select>
      </form>


      <!-- Liste des projets -->
      <?php if (!empty($projets)) : ?>
    <ul class=" grid grid-cols-1 sm:grid-cols-2 gap-6" id="liste">
      <?php foreach ($projets as $projet) : ?>
        <li data-type="<?php echo $projet['typeProjet'] ?>" data-competences="<?= htmlspecialchars(implode(',', array_column($projet['competences'], 'nom')), ENT_QUOTES, 'UTF-8') ?>">
          <a href="index.php?page=projet_show&id=<?php echo $projet['id']; ?>" class="block group" aria-label="Voir le projet : <?php echo html_entity_decode($projet['titre']); ?>">
            <article class="border rounded-lg shadow flex flex-col gap-4 p-4 hover:shadow-md transition-shadow bg-white h-full">
              <?php if (!empty($projet['urlimg'])): ?>
                <figure>
                  <img src="<?php echo html_entity_decode($projet['urlimg']); ?>" alt="Image du projet : <?php echo html_entity_decode($projet['titre']); ?>" class="rounded w-full h-48 object-cover">
                </figure>
              <?php endif; ?>
              <h2 class="text-xl font-bold font-[Cantarell] group-hover:text-[#DB9ECF] transition-colors">
                <?php echo html_entity_decode($projet['titre']); ?>
              </h2>
            </article>
          </a>

          <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) { ?>
            <div class="flex justify-center mt-2">
              <a href="index.php?page=supprimer&id=<?php echo $projet['id']; ?>" class="text-red-500 hover:text-red-700 font-semibold font-[Cantarell]" aria-label="Supprimer le projet : <?php echo html_entity_decode($projet['titre']); ?>">
                Supprimer le projet
              </a>
            </div>
          <?php } ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else : ?>
    <p class="text-gray-500">Aucun projet disponible.</p>
  <?php endif; ?>
</main>

<!-- Script modale -->
<script>
  document.getElementById('openOverlayBtn')?.addEventListener('click', function() {
    const overlay = document.getElementById('overlay');
    overlay.classList.remove('hidden');
    this.setAttribute('aria-expanded', 'true');
  });

  document.getElementById('closeOverlayBtn')?.addEventListener('click', function() {
    const overlay = document.getElementById('overlay');
    overlay.classList.add('hidden');
    document.getElementById('openOverlayBtn').setAttribute('aria-expanded', 'false');
  });

  document.getElementById('overlay')?.addEventListener('click', function(event) {
    if (event.target === this) {
      this.classList.add('hidden');
      document.getElementById('openOverlayBtn').setAttribute('aria-expanded', 'false');
    }
  });

  document.addEventListener('DOMContentLoaded', () => {
    const typeInput = document.getElementById('filtre-type');
    const competencesInput = document.getElementById('filtre-competences');
    const projets = document.querySelectorAll('#liste li');

    function filtrerProjets() {
      const typeFiltre = typeInput.value.trim().toLowerCase();
      const competencesFiltrees = Array.from(competencesInput.selectedOptions).map(opt => opt.value.toLowerCase());

      projets.forEach(projet => {
        const typeProjet = projet.dataset.type?.trim().toLowerCase() || '';
        const competencesProjet = (projet.dataset.competences || '').toLowerCase().split(',');

        const typeOK = !typeFiltre || typeProjet === typeFiltre;

        const competencesOK = competencesFiltrees.length === 0 ||
          competencesFiltrees.some(c => competencesProjet.includes(c));

        projet.style.display = (typeOK && competencesOK) ? '' : 'none';
      });
    }

    typeInput.addEventListener('change', filtrerProjets);
    competencesInput.addEventListener('change', filtrerProjets);
  });
</script>