<main class="container mx-auto p-4 scrollbar-none overflow-auto" role="main" aria-label="Liste des projets du portfolio de formation">

  <!-- Titre + bouton "Ajouter un projet" -->
  <div class="w-full flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-5xl font-bold my-6" aria-label="Titre principal : Portfolio de formation">Projets</h1>

    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) : ?>
      <button id="openOverlayBtn" aria-haspopup="dialog" aria-controls="overlay" aria-expanded="false"
        class="bg-[#DB9ECF] text-white px-[80px] py-[20px] rounded-xl hover:bg-[#c085b7] transition-colors sm:w-auto text-base sm:text-base flex items-center justify-center w-[300px]">
        Ajouter un projet
      </button>

      <!-- ============================================ -->
      <!-- MODALE D'AJOUT DE PROJET                     -->
      <!-- ============================================ -->
      <div id="overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-40 p-4">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[92vh] relative flex flex-col overflow-hidden">

          <!-- Header sticky -->
          <header class="flex items-center justify-between px-8 py-5 border-b border-gray-100 bg-white sticky top-0 z-10">
            <div>
              <h2 id="modalTitle" class="text-2xl font-bold text-[#DB9ECF]">Ajouter un projet</h2>
              <p class="text-sm text-gray-500 mt-1">Remplis les informations ci-dessous</p>
            </div>
            <button id="closeOverlayBtn" type="button"
              class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors"
              aria-label="Fermer la fenêtre d'ajout">
              <i class="fas fa-times text-gray-500"></i>
            </button>
          </header>

          <!-- Form scrollable -->
          <form id="addProjectForm" action="index.php?page=projet_add" method="POST" enctype="multipart/form-data"
            class="flex-1 overflow-y-auto px-8 py-6 space-y-8" aria-label="Formulaire d'ajout de projet">

            <!-- ========== SECTION 1 : Informations générales ========== -->
            <section class="space-y-4">
              <div class="flex items-center gap-3 pb-2 border-b border-[#FDF3FB]">
                <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">1</span>
                <h3 class="text-lg font-semibold text-[#243561]">Informations générales</h3>
              </div>

              <div>
                <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre du projet <span class="text-[#DB9ECF]">*</span></label>
                <input type="text" name="titre" id="titre" required
                  class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition"
                  placeholder="Ex : Portfolio personnel">
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date d'ajout <span class="text-[#DB9ECF]">*</span></label>
                  <input type="date" name="date" id="date" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition">
                </div>
                <div>
                  <label for="annee_but" class="block text-sm font-medium text-gray-700 mb-1">Année BUT <span class="text-[#DB9ECF]">*</span></label>
                  <input type="number" name="annee_but" id="annee_but" required min="1" max="3"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition"
                    placeholder="1, 2 ou 3">
                </div>
                <div>
                  <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type de projet <span class="text-[#DB9ECF]">*</span></label>
                  <select name="type" id="type" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition bg-white">
                    <option value="programme">Développement</option>
                    <option value="infographie">Infographie</option>
                    <option value="texte">Communication</option>
                  </select>
                </div>
              </div>
            </section>

            <!-- ========== SECTION 2 : Images (drag & drop) ========== -->
            <section class="space-y-4">
              <div class="flex items-center gap-3 pb-2 border-b border-[#FDF3FB]">
                <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">2</span>
                <h3 class="text-lg font-semibold text-[#243561]">Images du projet</h3>
              </div>

              <!-- Zone drop -->
              <div id="dropZone"
                class="relative border-2 border-dashed border-[#DB9ECF] bg-[#FDF3FB] rounded-xl p-8 text-center cursor-pointer hover:bg-[#FBE9F5] transition-colors">
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="pointer-events-none">
                  <div class="text-4xl mb-2">📁</div>
                  <p class="text-[#243561] font-medium">Glisse-dépose tes images ici</p>
                  <p class="text-sm text-gray-500 mt-1">ou clique pour choisir des fichiers</p>
                  <p class="text-xs text-gray-400 mt-2">PNG, JPG, JPEG, WEBP</p>
                </div>
              </div>

              <!-- Aperçu des miniatures -->
              <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-4 gap-3 hidden">
                <!-- Miniatures générées en JS -->
              </div>
              <p id="previewCount" class="text-sm text-gray-500 hidden"></p>
            </section>

            <!-- ========== SECTION 3 : Logiciels (tags) ========== -->
            <section class="space-y-4">
              <div class="flex items-center justify-between pb-2 border-b border-[#FDF3FB]">
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">3</span>
                  <h3 class="text-lg font-semibold text-[#243561]">Logiciels utilisés</h3>
                </div>
                <!-- 🆕 Bouton qui ouvre la mini-modale au lieu de quitter la page -->
                <button type="button" id="openAddLogicielBtn" class="text-sm text-[#DB9ECF] hover:underline font-medium">
                  + Ajouter un logiciel
                </button>
              </div>

              <div id="logicielsContainer" class="flex flex-wrap gap-2">
                <?php foreach ($logiciels as $logiciel) : ?>
                  <label class="tag-pill cursor-pointer">
                    <input type="checkbox" name="logiciels[]" value="<?php echo $logiciel['id']; ?>" class="sr-only peer">
                    <span class="inline-flex items-center px-4 py-2 rounded-full border-2 border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-[#DB9ECF] peer-checked:bg-[#DB9ECF] peer-checked:border-[#DB9ECF] peer-checked:text-white transition-all select-none">
                      <?php echo htmlspecialchars($logiciel['nomLogiciel']); ?>
                    </span>
                  </label>
                <?php endforeach; ?>
              </div>
            </section>

            <!-- ========== SECTION 4 : Compétences (tags) ========== -->
            <section class="space-y-4">
              <div class="flex items-center gap-3 pb-2 border-b border-[#FDF3FB]">
                <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">4</span>
                <h3 class="text-lg font-semibold text-[#243561]">Compétences mobilisées</h3>
              </div>

              <div class="flex flex-wrap gap-2">
                <?php foreach ($competences as $competence) : ?>
                  <label class="tag-pill cursor-pointer">
                    <input type="checkbox" name="competences[]" value="<?php echo $competence['id']; ?>" class="sr-only peer">
                    <span class="inline-flex items-center px-4 py-2 rounded-full border-2 border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-[#243561] peer-checked:bg-[#243561] peer-checked:border-[#243561] peer-checked:text-white transition-all select-none">
                      <?php echo htmlspecialchars($competence['nom']); ?>
                    </span>
                  </label>
                <?php endforeach; ?>
              </div>
            </section>

            <!-- ========== SECTION 5 : Textes ========== -->
            <section class="space-y-4">
              <div class="flex items-center gap-3 pb-2 border-b border-[#FDF3FB]">
                <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">5</span>
                <h3 class="text-lg font-semibold text-[#243561]">Description &amp; analyse</h3>
              </div>

              <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-[#DB9ECF]">*</span></label>
                <textarea name="description" id="description" required rows="3"
                  class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition resize-y"
                  placeholder="Présente brièvement ce projet…"></textarea>
              </div>

              <div>
                <label for="apprentissage" class="block text-sm font-medium text-gray-700 mb-1">Argumentaire <span class="text-[#DB9ECF]">*</span></label>
                <textarea name="apprentissage" id="apprentissage" required rows="3"
                  class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition resize-y"
                  placeholder="Pourquoi ce projet, ses objectifs, ses choix…"></textarea>
              </div>

              <div>
                <label for="argumentaire" class="block text-sm font-medium text-gray-700 mb-1">Apprentissage critique <span class="text-[#DB9ECF]">*</span></label>
                <textarea name="argumentaire" id="argumentaire" required rows="3"
                  class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition resize-y"
                  placeholder="Ce que tu as appris, les difficultés rencontrées…"></textarea>
              </div>
            </section>

          </form>

          <!-- Footer sticky avec actions -->
          <footer class="flex items-center justify-end gap-3 px-8 py-4 border-t border-gray-100 bg-gray-50 sticky bottom-0">
            <button type="button" id="cancelBtn"
              class="px-6 py-2.5 text-gray-700 hover:bg-gray-200 rounded-lg font-medium transition">
              Annuler
            </button>
            <button type="submit" form="addProjectForm"
              class="px-8 py-2.5 bg-[#DB9ECF] hover:bg-[#c085b7] text-white rounded-lg font-medium shadow-sm transition-colors">
              Ajouter le projet
            </button>
          </footer>

        </div>
      </div>

      <!-- ================================================== -->
      <!-- 🆕 MINI-MODALE D'AJOUT DE LOGICIEL (imbriquée)     -->
      <!-- ================================================== -->
      <div id="addLogicielOverlay" role="dialog" aria-modal="true" aria-labelledby="logicielModalTitle"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md flex flex-col overflow-hidden">

          <header class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="logicielModalTitle" class="text-xl font-bold text-[#DB9ECF]">Nouveau logiciel</h3>
            <button id="closeAddLogicielBtn" type="button"
              class="w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors"
              aria-label="Fermer">
              <i class="fas fa-times text-gray-500"></i>
            </button>
          </header>

          <form id="addLogicielForm" class="p-6 space-y-4">
            <div>
              <label for="logicielNom" class="block text-sm font-medium text-gray-700 mb-1">
                Nom du logiciel <span class="text-[#DB9ECF]">*</span>
              </label>
              <input type="text" name="nom" id="logicielNom" required
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition"
                placeholder="Ex : Figma">
            </div>

            <div>
              <label for="logicielImage" class="block text-sm font-medium text-gray-700 mb-1">
                Icône / logo <span class="text-[#DB9ECF]">*</span>
              </label>
              <div id="logicielDropZone"
                class="relative border-2 border-dashed border-[#DB9ECF] bg-[#FDF3FB] rounded-lg p-5 text-center cursor-pointer hover:bg-[#FBE9F5] transition-colors">
                <input type="file" name="image" id="logicielImage" accept="image/*" required
                  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div id="logicielDropContent" class="pointer-events-none">
                  <div class="text-2xl mb-1">🖼️</div>
                  <p class="text-sm text-[#243561] font-medium">Choisir une image</p>
                  <p class="text-xs text-gray-400 mt-1">PNG, JPG, SVG, WEBP, ICO</p>
                </div>
                <div id="logicielPreview" class="hidden">
                  <img id="logicielPreviewImg" src="" alt="" class="h-16 mx-auto object-contain">
                  <p id="logicielPreviewName" class="text-xs text-gray-600 mt-2 truncate"></p>
                </div>
              </div>
            </div>

            <!-- Zone pour afficher les erreurs -->
            <div id="logicielError" class="hidden p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700"></div>

            <div class="flex items-center justify-end gap-2 pt-2">
              <button type="button" id="cancelLogicielBtn"
                class="px-5 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium transition">
                Annuler
              </button>
              <button type="submit" id="submitLogicielBtn"
                class="px-5 py-2 bg-[#DB9ECF] hover:bg-[#c085b7] text-white rounded-lg font-medium shadow-sm transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="submit-text">Créer</span>
                <span class="submit-loading hidden">⏳ Création…</span>
              </button>
            </div>
          </form>

        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Intro + bouton filtre -->
  <div class="w-full flex flex-col lg:flex-row justify-between items-start gap-8 mb-6 px-2">
    <div class="w-full lg:w-1/2">
      <p class="text-base">
        Explorez les projets qui jalonnent mon parcours, principalement réalisés dans le cadre de mon BUT MMI,
        mais aussi issus d'autres formations et expériences, reflétant mon évolution et ma polyvalence
        dans le domaine du multimédia et du digital.
      </p>
    </div>
    <div class="w-full lg:w-auto flex justify-end mt-4 lg:mt-0">
      <button id="toggleFiltres" class="bg-[#DB9ECF] text-white px-[80px] py-[20px] rounded-xl hover:bg-[#c085b7] transition-colors sm:w-auto text-base sm:text-base flex items-center justify-center w-[300px]">
        Filtrer les projets
      </button>
    </div>
  </div>

  <!-- Formulaire de filtres -->
  <form id="filtre-form" class="w-full max-w-3xl mx-auto bg-white p-4 rounded-2xl shadow-md border border-[#DB9ECF] space-y-4 mb-10 hidden">
    <div class="flex flex-col sm:flex-row gap-4">
      <div class="w-full sm:w-1/2">
        <label for="filtre-type" class="block text-sm font-semibold text-[#243561] mb-1">Type de projet</label>
        <select id="filtre-type" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 focus:ring-2 focus:ring-[#DB9ECF] focus:outline-none">
          <option value="">-- Tous les types --</option>
          <option value="programme">Développement</option>
          <option value="infographie">Infographie</option>
          <option value="texte">Communication</option>
        </select>
      </div>
      <div class="w-full sm:w-1/2">
        <label for="filtre-competences" class="block text-sm font-semibold text-[#243561] mb-1">Compétences</label>
        <select id="filtre-competences" multiple class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 focus:ring-2 focus:ring-[#DB9ECF] focus:outline-none h-[160px]">
          <?php foreach ($competences as $compt) { ?>
            <option value="<?php echo $compt['nom'] ?>"><?php echo $compt['nom'] ?></option>
          <?php } ?>
        </select>
        <p class="text-xs text-gray-500 mt-1">Ctrl (ou Cmd) + clic pour sélection multiple</p>
      </div>
    </div>
    <div class="flex justify-end">
      <button type="button" id="reset-filtres" class="text-sm text-[#DB9ECF] hover:underline font-semibold">
        Réinitialiser les filtres
      </button>
    </div>
  </form>

  <!-- Liste des projets -->
  <?php if (!empty($projets)) : ?>
    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-6" id="liste">
      <?php foreach ($projets as $projet) : ?>
        <li data-type="<?php echo $projet['typeProjet'] ?>" data-competences="<?= htmlspecialchars(implode(',', array_column($projet['competences'], 'nom')), ENT_QUOTES, 'UTF-8') ?>">
          <a href="index.php?page=projet_show&id=<?php echo $projet['id']; ?>" class="block group" aria-label="Voir le projet : <?php echo html_entity_decode($projet['titre']); ?>">
            <article class="border rounded-lg shadow flex flex-col gap-4 p-4 hover:shadow-md transition-shadow bg-white h-full">
              <?php if (!empty($projet['urlimg'])) : ?>
                <figure class="relative overflow-hidden rounded">
                  <img src="<?php echo html_entity_decode($projet['urlimg']); ?>"
                    alt="Image du projet : <?php echo html_entity_decode($projet['titre']); ?>"
                    class="w-full h-48 object-cover">
                  <div class="absolute inset-0 bg-[#DB9ECF]/20"></div>
                </figure>
              <?php endif; ?>

              <h2 class="text-xl font-bold font-[Cantarell] group-hover:text-[#DB9ECF] transition-colors">
                <?php echo html_entity_decode($projet['titre']); ?>
              </h2>

              <?php if (!empty($projet['logiciels']) || !empty($projet['competences'])) : ?>
                <div class="mt-2 flex flex-wrap gap-2 items-center">

                  <?php if (!empty($projet['logiciels'])) : ?>
                    <?php foreach ($projet['logiciels'] as $logiciel) : ?>
                      <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full border border-[#DB9ECF] bg-[#FDF3FB]">
                        <?php if (!empty($logiciel['icone'])) : ?>
                          <img src="<?php echo htmlspecialchars($logiciel['icone'], ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($logiciel['nomLogiciel'], ENT_QUOTES, 'UTF-8'); ?>"
                            class="w-[30px] h-[30px] object-contain">
                        <?php endif; ?>
                        <span class="text-xs font-[Cantarell]">
                          <?php echo htmlspecialchars($logiciel['nomLogiciel'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                      </span>
                    <?php endforeach; ?>
                  <?php endif; ?>

                  <?php if (!empty($projet['competences'])) : ?>
                    <?php foreach ($projet['competences'] as $competence) : ?>
                      <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-[#243561] text-white">
                        <?php if (!empty($competence['icone'])) : ?>
                          <img src="<?php echo htmlspecialchars($competence['icone'], ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($competence['nom'], ENT_QUOTES, 'UTF-8'); ?>"
                            class="w-[30px] h-[30px] object-contain rounded-full">
                        <?php endif; ?>
                        <span class="text-xs font-[Cantarell]">
                          <?php echo htmlspecialchars($competence['nom'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                      </span>
                    <?php endforeach; ?>
                  <?php endif; ?>

                </div>
              <?php endif; ?>
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

<!-- Scripts -->
<script>
  // ===== Modale principale (ajout projet) =====
  const overlay = document.getElementById('overlay');
  const openBtn = document.getElementById('openOverlayBtn');
  const closeBtn = document.getElementById('closeOverlayBtn');
  const cancelBtn = document.getElementById('cancelBtn');

  function openModal() {
    overlay?.classList.remove('hidden');
    openBtn?.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }
  function closeModal() {
    overlay?.classList.add('hidden');
    openBtn?.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  openBtn?.addEventListener('click', openModal);
  closeBtn?.addEventListener('click', closeModal);
  cancelBtn?.addEventListener('click', closeModal);
  overlay?.addEventListener('click', (e) => {
    if (e.target === overlay) closeModal();
  });

  // ===== 🆕 Mini-modale d'ajout de logiciel =====
  const logicielOverlay = document.getElementById('addLogicielOverlay');
  const openLogicielBtn = document.getElementById('openAddLogicielBtn');
  const closeLogicielBtn = document.getElementById('closeAddLogicielBtn');
  const cancelLogicielBtn = document.getElementById('cancelLogicielBtn');
  const logicielForm = document.getElementById('addLogicielForm');
  const logicielError = document.getElementById('logicielError');
  const submitLogicielBtn = document.getElementById('submitLogicielBtn');
  const logicielImageInput = document.getElementById('logicielImage');
  const logicielDropContent = document.getElementById('logicielDropContent');
  const logicielPreview = document.getElementById('logicielPreview');
  const logicielPreviewImg = document.getElementById('logicielPreviewImg');
  const logicielPreviewName = document.getElementById('logicielPreviewName');

  function openLogicielModal() {
    logicielOverlay?.classList.remove('hidden');
    // La modale parent reste ouverte derrière, c'est voulu
  }
  function closeLogicielModal() {
    logicielOverlay?.classList.add('hidden');
    logicielForm.reset();
    logicielError.classList.add('hidden');
    logicielDropContent.classList.remove('hidden');
    logicielPreview.classList.add('hidden');
  }

  openLogicielBtn?.addEventListener('click', openLogicielModal);
  closeLogicielBtn?.addEventListener('click', closeLogicielModal);
  cancelLogicielBtn?.addEventListener('click', closeLogicielModal);
  logicielOverlay?.addEventListener('click', (e) => {
    if (e.target === logicielOverlay) closeLogicielModal();
  });

  // Aperçu de l'icône sélectionnée
  logicielImageInput?.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
      logicielPreviewImg.src = ev.target.result;
      logicielPreviewName.textContent = file.name;
      logicielDropContent.classList.add('hidden');
      logicielPreview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
  });

  // Soumission AJAX
  logicielForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    logicielError.classList.add('hidden');

    const formData = new FormData(logicielForm);

    // État loading
    submitLogicielBtn.disabled = true;
    submitLogicielBtn.querySelector('.submit-text').classList.add('hidden');
    submitLogicielBtn.querySelector('.submit-loading').classList.remove('hidden');

    try {
      const response = await fetch('index.php?page=addLogiciel_ajax', {
        method: 'POST',
        body: formData
      });
      const data = await response.json();

      if (data.success && data.logiciel) {
        // Injecter le nouveau tag dans la liste — déjà coché pour qu'il soit immédiatement utilisable
        const container = document.getElementById('logicielsContainer');
        const label = document.createElement('label');
        label.className = 'tag-pill cursor-pointer';
        label.innerHTML = `
          <input type="checkbox" name="logiciels[]" value="${data.logiciel.id}" class="sr-only peer" checked>
          <span class="inline-flex items-center px-4 py-2 rounded-full border-2 border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-[#DB9ECF] peer-checked:bg-[#DB9ECF] peer-checked:border-[#DB9ECF] peer-checked:text-white transition-all select-none">
            ${escapeHtml(data.logiciel.nom)}
          </span>
        `;
        container.appendChild(label);

        // Petit feedback visuel sur le nouveau tag
        label.querySelector('span').style.animation = 'pulse 0.6s ease';

        closeLogicielModal();
      } else {
        logicielError.textContent = data.message || 'Une erreur est survenue';
        logicielError.classList.remove('hidden');
      }
    } catch (err) {
      logicielError.textContent = 'Erreur réseau, réessaie';
      logicielError.classList.remove('hidden');
      console.error(err);
    } finally {
      submitLogicielBtn.disabled = false;
      submitLogicielBtn.querySelector('.submit-text').classList.remove('hidden');
      submitLogicielBtn.querySelector('.submit-loading').classList.add('hidden');
    }
  });

  // Helper anti-XSS pour l'injection
  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  // ===== Échap : ferme la modale du dessus en priorité =====
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    if (!logicielOverlay?.classList.contains('hidden')) {
      closeLogicielModal();
    } else if (!overlay?.classList.contains('hidden')) {
      closeModal();
    }
  });

  // ===== Upload images du projet : drag & drop + miniatures =====
  const dropZone = document.getElementById('dropZone');
  const fileInput = document.getElementById('images');
  const previewContainer = document.getElementById('previewContainer');
  const previewCount = document.getElementById('previewCount');
  let filesArray = [];

  function updatePreviews() {
    previewContainer.innerHTML = '';
    if (filesArray.length === 0) {
      previewContainer.classList.add('hidden');
      previewCount.classList.add('hidden');
      const dt = new DataTransfer();
      fileInput.files = dt.files;
      return;
    }

    previewContainer.classList.remove('hidden');
    previewCount.classList.remove('hidden');
    previewCount.textContent = filesArray.length + ' image' + (filesArray.length > 1 ? 's' : '') + ' sélectionnée' + (filesArray.length > 1 ? 's' : '');

    filesArray.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = (e) => {
        const card = document.createElement('div');
        card.className = 'relative group rounded-lg overflow-hidden border border-gray-200 aspect-square bg-gray-50';
        card.innerHTML = `
          <img src="${e.target.result}" alt="${escapeHtml(file.name)}" class="w-full h-full object-cover">
          <button type="button" data-index="${index}" class="remove-btn absolute top-1 right-1 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-md opacity-0 group-hover:opacity-100 transition-opacity" aria-label="Supprimer">
            ×
          </button>
          <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs px-2 py-1 truncate">${escapeHtml(file.name)}</div>
        `;
        previewContainer.appendChild(card);

        card.querySelector('.remove-btn').addEventListener('click', () => {
          filesArray.splice(index, 1);
          updatePreviews();
        });
      };
      reader.readAsDataURL(file);
    });

    const dt = new DataTransfer();
    filesArray.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
  }

  function addFiles(newFiles) {
    Array.from(newFiles).forEach(f => {
      if (f.type.startsWith('image/')) filesArray.push(f);
    });
    updatePreviews();
  }

  fileInput?.addEventListener('change', (e) => addFiles(e.target.files));

  if (dropZone) {
    ['dragenter', 'dragover'].forEach(ev => {
      dropZone.addEventListener(ev, (e) => {
        e.preventDefault();
        dropZone.classList.add('ring-4', 'ring-[#DB9ECF]', 'bg-[#FBE9F5]');
      });
    });
    ['dragleave', 'drop'].forEach(ev => {
      dropZone.addEventListener(ev, (e) => {
        e.preventDefault();
        dropZone.classList.remove('ring-4', 'ring-[#DB9ECF]', 'bg-[#FBE9F5]');
      });
    });
    dropZone.addEventListener('drop', (e) => {
      addFiles(e.dataTransfer.files);
    });
  }

  // ===== Filtres =====
  document.getElementById('toggleFiltres')?.addEventListener('click', () => {
    document.getElementById('filtre-form').classList.toggle('hidden');
  });

  document.getElementById('reset-filtres')?.addEventListener('click', () => {
    document.getElementById('filtre-type').value = "";
    const comp = document.getElementById('filtre-competences');
    for (const option of comp.options) option.selected = false;
    comp.dispatchEvent(new Event('change'));
    document.getElementById('filtre-type').dispatchEvent(new Event('change'));
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

<style>
  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }
</style>