<?php
$isAdmin = isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1);

/**
 * Normalise un texte multi-ligne venant de la BDD :
 * - décode les éventuelles entités HTML (&#13;&#10;, &#39;, etc.) laissées par d'anciennes données
 * - uniformise les fins de ligne
 * Retourne un tableau de lignes non vides.
 */
function aboutLines($texte)
{
    $texte = htmlspecialchars_decode($texte, ENT_QUOTES);
    // Convertir d'éventuelles entités numériques de saut de ligne restantes
    $texte = str_replace(['&#13;', '&#10;', "\r\n", "\r"], ["", "\n", "\n", "\n"], $texte);
    $lignes = array_filter(array_map('trim', explode("\n", $texte)), fn($l) => $l !== '');
    return $lignes;
}

/** Décode proprement un champ simple (titre, apostrophes...) pour affichage. */
function aboutText($texte)
{
    return htmlspecialchars(htmlspecialchars_decode($texte, ENT_QUOTES));
}
?>

<main class="mx-auto max-w-[1100px] px-4 md:px-6 py-8 md:py-12 font-[Cantarell] space-y-12">

  <!-- HERO -->
  <section class="grid md:grid-cols-2 items-center gap-6 md:gap-10">
    <img
      class="w-full max-w-[220px] md:max-w-[260px] mx-auto rounded-2xl shadow-md object-cover"
      src="/assets/img/PostMe.png"
      alt="Portrait de Yousra EL YEBDRI">
    <div>
      <h1 class="text-3xl md:text-5xl font-bold mb-3">À propos de moi</h1>
      <p class="text-stone-600 leading-relaxed text-sm md:text-base">
        Étudiante en BUT Métiers du Multimédia et de l'Internet et développeuse web en alternance,
        je conçois des interfaces modernes, accessibles et centrées utilisateur.
        J'aime transformer des besoins en solutions concrètes.
      </p>
      <a href="index.php?page=projet" class="block w-full mt-4 bg-[#DB9ECF] text-white px-20 py-5 rounded-xl hover:bg-[#c085b7] text-sm text-center">
        Voir mes projets
      </a>
    </div>
  </section>

  <!-- ======================= PARCOURS ======================= -->
  <section id="parcours">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl md:text-2xl font-semibold">Parcours professionnel</h2>
      <?php if ($isAdmin) : ?>
        <button type="button" class="js-add-parcours inline-flex items-center gap-1 text-sm text-[#DB9ECF] hover:underline font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
          Ajouter
        </button>
      <?php endif; ?>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
      <?php foreach ($parcours as $p) : ?>
        <div class="relative bg-white p-5 rounded-xl shadow-sm border group">
          <?php if ($isAdmin) : ?>
            <div class="absolute top-3 right-3 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
              <button type="button"
                class="js-edit-parcours w-8 h-8 bg-gray-100 hover:bg-[#DB9ECF] hover:text-white rounded-full flex items-center justify-center transition-colors"
                data-id="<?= $p['id'] ?>"
                data-poste="<?= htmlspecialchars(htmlspecialchars_decode($p['poste'], ENT_QUOTES), ENT_QUOTES) ?>"
                data-entreprise="<?= htmlspecialchars(htmlspecialchars_decode($p['entreprise'], ENT_QUOTES), ENT_QUOTES) ?>"
                data-periode="<?= htmlspecialchars(htmlspecialchars_decode($p['periode'], ENT_QUOTES), ENT_QUOTES) ?>"
                data-missions="<?= htmlspecialchars(str_replace(['&#13;', '&#10;'], ['', "\n"], htmlspecialchars_decode($p['missions'], ENT_QUOTES)), ENT_QUOTES) ?>"
                aria-label="Modifier">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
              </button>
              <form method="POST" action="index.php?page=about_delete_parcours" onsubmit="return confirm('Supprimer cette expérience ?');">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button type="submit" class="w-8 h-8 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full flex items-center justify-center transition-colors" aria-label="Supprimer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
              </form>
            </div>
          <?php endif; ?>

          <div class="mb-3 pr-16">
            <h3 class="text-lg md:text-xl font-semibold leading-tight"><?= aboutText($p['poste']) ?></h3>
            <p class="text-xs md:text-sm text-stone-500"><?= aboutText($p['entreprise']) ?></p>
            <p class="text-xs text-stone-400 mt-1"><?= aboutText($p['periode']) ?></p>
          </div>
          <ul class="space-y-1.5 text-sm text-stone-700 leading-relaxed list-disc list-inside">
            <?php foreach (aboutLines($p['missions']) as $mission) : ?>
              <li><?= htmlspecialchars($mission) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>

      <?php if (empty($parcours)) : ?>
        <p class="text-stone-400 italic text-sm">Aucune expérience pour le moment.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- ======================= FORMATIONS ======================= -->
  <section id="formations">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl md:text-2xl font-semibold">Formations</h2>
      <?php if ($isAdmin) : ?>
        <button type="button" class="js-add-formation inline-flex items-center gap-1 text-sm text-[#DB9ECF] hover:underline font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
          Ajouter
        </button>
      <?php endif; ?>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
      <?php foreach ($formations as $f) : ?>
        <div class="relative bg-white p-5 rounded-xl shadow-sm border group">
          <?php if ($isAdmin) : ?>
            <div class="absolute top-3 right-3 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
              <button type="button"
                class="js-edit-formation w-8 h-8 bg-gray-100 hover:bg-[#DB9ECF] hover:text-white rounded-full flex items-center justify-center transition-colors"
                data-id="<?= $f['id'] ?>"
                data-titre="<?= htmlspecialchars(htmlspecialchars_decode($f['titre'], ENT_QUOTES), ENT_QUOTES) ?>"
                data-etablissement="<?= htmlspecialchars(htmlspecialchars_decode($f['etablissement'], ENT_QUOTES), ENT_QUOTES) ?>"
                data-contenu="<?= htmlspecialchars(str_replace(['&#13;', '&#10;'], ['', "\n"], htmlspecialchars_decode($f['contenu'], ENT_QUOTES)), ENT_QUOTES) ?>"
                aria-label="Modifier">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
              </button>
              <form method="POST" action="index.php?page=about_delete_formation" onsubmit="return confirm('Supprimer cette formation ?');">
                <input type="hidden" name="id" value="<?= $f['id'] ?>">
                <button type="submit" class="w-8 h-8 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full flex items-center justify-center transition-colors" aria-label="Supprimer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
              </form>
            </div>
          <?php endif; ?>

          <h3 class="text-lg font-semibold pr-16"><?= aboutText($f['titre']) ?></h3>
          <p class="text-xs text-stone-500 mb-3"><?= aboutText($f['etablissement']) ?></p>
          <ul class="space-y-1.5 text-sm text-stone-700 list-disc list-inside">
            <?php foreach (aboutLines($f['contenu']) as $point) : ?>
              <li><?= htmlspecialchars($point) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>

      <?php if (empty($formations)) : ?>
        <p class="text-stone-400 italic text-sm">Aucune formation pour le moment.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- ======================= COMPÉTENCES ======================= -->
  <section id="competences">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl md:text-2xl font-semibold">Compétences</h2>
      <?php if ($isAdmin) : ?>
        <button type="button" class="js-add-competence inline-flex items-center gap-1 text-sm text-[#DB9ECF] hover:underline font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
          Ajouter
        </button>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
      <?php foreach ($competences as $c) : ?>
        <div class="relative bg-white p-4 rounded-xl shadow-sm border text-sm group">
          <?php if ($isAdmin) : ?>
            <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
              <button type="button"
                class="js-edit-competence w-7 h-7 bg-gray-100 hover:bg-[#DB9ECF] hover:text-white rounded-full flex items-center justify-center transition-colors"
                data-id="<?= $c['id'] ?>"
                data-categorie="<?= htmlspecialchars(htmlspecialchars_decode($c['categorie'], ENT_QUOTES), ENT_QUOTES) ?>"
                data-details="<?= htmlspecialchars(htmlspecialchars_decode($c['details'], ENT_QUOTES), ENT_QUOTES) ?>"
                aria-label="Modifier">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
              </button>
              <form method="POST" action="index.php?page=about_delete_competence" onsubmit="return confirm('Supprimer cette compétence ?');">
                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                <button type="submit" class="w-7 h-7 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full flex items-center justify-center transition-colors" aria-label="Supprimer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
              </form>
            </div>
          <?php endif; ?>

          <h4 class="font-semibold mb-1 pr-12"><?= aboutText($c['categorie']) ?></h4>
          <p class="text-stone-600"><?= aboutText($c['details']) ?></p>
        </div>
      <?php endforeach; ?>

      <?php if (empty($competences)) : ?>
        <p class="text-stone-400 italic text-sm">Aucune compétence pour le moment.</p>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php if ($isAdmin) : ?>
  <!-- ============================================ -->
  <!-- MODALES (une par section, réutilisées add/edit) -->
  <!-- ============================================ -->

  <!-- ===== MODALE PARCOURS ===== -->
  <div id="parcoursModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[92vh] flex flex-col overflow-hidden">
      <header class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <h3 id="parcoursModalTitle" class="text-xl font-bold text-[#DB9ECF]">Expérience</h3>
        <button type="button" class="js-close-modal w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center" data-modal="parcoursModal">
          <i class="fas fa-times text-gray-500"></i>
        </button>
      </header>
      <form method="POST" action="index.php?page=about_save_parcours" class="flex-1 overflow-y-auto p-6 space-y-4">
        <input type="hidden" name="id" id="parcours_id">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Poste <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="poste" id="parcours_poste" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : Développeuse Web">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Entreprise <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="entreprise" id="parcours_entreprise" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : Ministère de la Culture">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Période <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="periode" id="parcours_periode" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : 2025 — Aujourd'hui">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Missions <span class="text-[#DB9ECF]">*</span></label>
          <textarea name="missions" id="parcours_missions" required rows="6" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition resize-y" placeholder="Une mission par ligne"></textarea>
          <p class="text-xs text-gray-400 mt-1">💡 Une mission par ligne (chaque ligne devient une puce)</p>
        </div>
        <div class="flex justify-end gap-2 pt-2">
          <button type="button" class="js-close-modal px-5 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium" data-modal="parcoursModal">Annuler</button>
          <button type="submit" class="px-6 py-2 bg-[#DB9ECF] hover:bg-[#c085b7] text-white rounded-lg font-medium shadow-sm transition-colors">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ===== MODALE FORMATION ===== -->
  <div id="formationModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[92vh] flex flex-col overflow-hidden">
      <header class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <h3 id="formationModalTitle" class="text-xl font-bold text-[#DB9ECF]">Formation</h3>
        <button type="button" class="js-close-modal w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center" data-modal="formationModal">
          <i class="fas fa-times text-gray-500"></i>
        </button>
      </header>
      <form method="POST" action="index.php?page=about_save_formation" class="flex-1 overflow-y-auto p-6 space-y-4">
        <input type="hidden" name="id" id="formation_id">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Titre <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="titre" id="formation_titre" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : BUT MMI — En cours">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Établissement <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="etablissement" id="formation_etablissement" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : IUT Toulon">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contenu <span class="text-[#DB9ECF]">*</span></label>
          <textarea name="contenu" id="formation_contenu" required rows="5" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition resize-y" placeholder="Un point par ligne"></textarea>
          <p class="text-xs text-gray-400 mt-1">💡 Un point par ligne (chaque ligne devient une puce)</p>
        </div>
        <div class="flex justify-end gap-2 pt-2">
          <button type="button" class="js-close-modal px-5 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium" data-modal="formationModal">Annuler</button>
          <button type="submit" class="px-6 py-2 bg-[#DB9ECF] hover:bg-[#c085b7] text-white rounded-lg font-medium shadow-sm transition-colors">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ===== MODALE COMPÉTENCE ===== -->
  <div id="competenceModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg flex flex-col overflow-hidden">
      <header class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <h3 id="competenceModalTitle" class="text-xl font-bold text-[#DB9ECF]">Compétence</h3>
        <button type="button" class="js-close-modal w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center" data-modal="competenceModal">
          <i class="fas fa-times text-gray-500"></i>
        </button>
      </header>
      <form method="POST" action="index.php?page=about_save_competence" class="p-6 space-y-4">
        <input type="hidden" name="id" id="competence_id">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="categorie" id="competence_categorie" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : Développement Web">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Détails <span class="text-[#DB9ECF]">*</span></label>
          <input type="text" name="details" id="competence_details" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#DB9ECF] focus:border-transparent outline-none transition" placeholder="Ex : PHP, JavaScript, HTML, CSS">
        </div>
        <div class="flex justify-end gap-2 pt-2">
          <button type="button" class="js-close-modal px-5 py-2 text-gray-700 hover:bg-gray-100 rounded-lg font-medium" data-modal="competenceModal">Annuler</button>
          <button type="submit" class="px-6 py-2 bg-[#DB9ECF] hover:bg-[#c085b7] text-white rounded-lg font-medium shadow-sm transition-colors">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
      document.body.style.overflow = '';
    }

    document.querySelectorAll('.js-close-modal').forEach(btn => {
      btn.addEventListener('click', () => closeModal(btn.dataset.modal));
    });
    ['parcoursModal', 'formationModal', 'competenceModal'].forEach(id => {
      const el = document.getElementById(id);
      el.addEventListener('click', (e) => { if (e.target === el) closeModal(id); });
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') ['parcoursModal', 'formationModal', 'competenceModal'].forEach(id => closeModal(id));
    });

    // ===== PARCOURS =====
    document.querySelector('.js-add-parcours')?.addEventListener('click', () => {
      document.getElementById('parcoursModalTitle').textContent = 'Ajouter une expérience';
      document.getElementById('parcours_id').value = '';
      document.getElementById('parcours_poste').value = '';
      document.getElementById('parcours_entreprise').value = '';
      document.getElementById('parcours_periode').value = '';
      document.getElementById('parcours_missions').value = '';
      openModal('parcoursModal');
    });
    document.querySelectorAll('.js-edit-parcours').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('parcoursModalTitle').textContent = 'Modifier l\'expérience';
        document.getElementById('parcours_id').value = btn.dataset.id;
        document.getElementById('parcours_poste').value = btn.dataset.poste;
        document.getElementById('parcours_entreprise').value = btn.dataset.entreprise;
        document.getElementById('parcours_periode').value = btn.dataset.periode;
        document.getElementById('parcours_missions').value = btn.dataset.missions;
        openModal('parcoursModal');
      });
    });

    // ===== FORMATION =====
    document.querySelector('.js-add-formation')?.addEventListener('click', () => {
      document.getElementById('formationModalTitle').textContent = 'Ajouter une formation';
      document.getElementById('formation_id').value = '';
      document.getElementById('formation_titre').value = '';
      document.getElementById('formation_etablissement').value = '';
      document.getElementById('formation_contenu').value = '';
      openModal('formationModal');
    });
    document.querySelectorAll('.js-edit-formation').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('formationModalTitle').textContent = 'Modifier la formation';
        document.getElementById('formation_id').value = btn.dataset.id;
        document.getElementById('formation_titre').value = btn.dataset.titre;
        document.getElementById('formation_etablissement').value = btn.dataset.etablissement;
        document.getElementById('formation_contenu').value = btn.dataset.contenu;
        openModal('formationModal');
      });
    });

    // ===== COMPÉTENCE =====
    document.querySelector('.js-add-competence')?.addEventListener('click', () => {
      document.getElementById('competenceModalTitle').textContent = 'Ajouter une compétence';
      document.getElementById('competence_id').value = '';
      document.getElementById('competence_categorie').value = '';
      document.getElementById('competence_details').value = '';
      openModal('competenceModal');
    });
    document.querySelectorAll('.js-edit-competence').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('competenceModalTitle').textContent = 'Modifier la compétence';
        document.getElementById('competence_id').value = btn.dataset.id;
        document.getElementById('competence_categorie').value = btn.dataset.categorie;
        document.getElementById('competence_details').value = btn.dataset.details;
        openModal('competenceModal');
      });
    });
  </script>
<?php endif; ?>