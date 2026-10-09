<main class="flex-1 container mx-auto p-4 pb-32 max-w-[1200px] font-[Cantarell]" role="main">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full mb-6 gap-4">
        <div>
            <h1 class="text-3xl sm:text-4xl font-bold text-[#243561]">
                <?php echo html_entity_decode($projet['titre']); ?>
            </h1>
            <p class="text-sm text-gray-500 mt-1">Mode édition</p>
        </div>
        <div style="display:flex; gap:12px; align-items:center;">
            <span id="autosave-status" style="font-size:0.85rem; color:#6b7280; font-style:italic;"></span>
            <a href="index.php?page=projet#liste"
                style="padding:10px 24px; background:#f3f4f6; color:#374151; border-radius:10px; font-weight:500; text-decoration:none;">
                ← Retour aux projets
            </a>
        </div>
    </div>

    <!-- FORM PRINCIPAL — aucun form imbriqué dedans -->
    <form id="editProjectForm" method="POST" action="index.php?page=save_update_projet"
          style="display:flex; flex-direction:column; gap:2.5rem;">
        <input type="hidden" value="<?php echo $projet['id'] ?>" name="id_projet">

        <!-- SECTION 1 : Images -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-[#FDF3FB] to-white">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">1</span>
                    <h2 class="text-lg font-semibold text-[#243561]">Images du projet</h2>
                </div>
                <span class="text-xs text-gray-500 italic">💡 Glisse-dépose pour réordonner</span>
            </header>
            <div class="p-6">
                <div id="reorder-status" style="opacity:0; font-size:0.85rem; color:#243561; margin-bottom:12px; display:inline-flex; align-items:center; gap:6px; transition:opacity 0.3s;">
                    <span style="width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block;"></span>
                    <span class="status-text"></span>
                </div>

                <ul id="images-sortable" style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px;"
                    data-projet-id="<?php echo $projet['id'] ?>">

                    <?php foreach ($images as $image) : ?>
                        <li class="group" data-image-id="<?php echo $image['id'] ?>"
                            data-nom="<?php echo htmlspecialchars($image['nom']) ?>"
                            style="position:relative; border-radius:12px; overflow:hidden; border:2px solid #f3f4f6; aspect-ratio:1; background:#f9fafb; cursor:move;">
                            <img src="<?php echo $image['img_path'] ?>" alt=""
                                style="width:100%; height:100%; object-fit:cover; pointer-events:none; display:block;">
                            <!-- Bouton supprimer : PAS un form, juste un button avec data-* -->
                            <button type="button"
                                class="delete-img-btn"
                                data-projet-id="<?php echo $projet['id'] ?>"
                                data-image-nom="<?php echo htmlspecialchars($image['nom']) ?>"
                                style="position:absolute; top:8px; right:8px; width:32px; height:32px; background:#ef4444; color:white; border:none; border-radius:50%; cursor:pointer; display:none; align-items:center; justify-content:center; font-size:16px; font-weight:bold;">
                                ×
                            </button>
                            <div style="position:absolute; top:8px; left:8px; background:rgba(0,0,0,0.6); color:white; padding:2px 8px; border-radius:6px; font-size:11px; display:none;">
                                ⠿ Glisser
                            </div>
                        </li>
                    <?php endforeach; ?>

                    <!-- Tuile Ajouter -->
                    <li class="js-no-drag" style="aspect-ratio:1;">
                        <button type="button" id="openAddImageBtn"
                            style="width:100%; height:100%; border:2px dashed #DB9ECF; background:#FDF3FB; color:#DB9ECF; border-radius:12px; cursor:pointer; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; font-size:0.9rem; font-weight:500;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:40px;height:40px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Ajouter
                        </button>
                    </li>
                </ul>
            </div>
        </section>

        <!-- SECTION 2 : Infos générales -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <header class="px-6 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-r from-[#FDF3FB] to-white">
                <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">2</span>
                <h2 class="text-lg font-semibold text-[#243561]">Informations générales</h2>
            </header>
            <div class="p-6" style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date d'ajout</label>
                    <input type="date" name="date" value="<?php echo html_entity_decode($projet['date']); ?>"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Année BUT</label>
                    <input type="number" name="annee_but" value="<?php echo html_entity_decode($projet['dateCrea']); ?>"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg outline-none" required min="1" max="3">
                </div>
            </div>
        </section>

        <!-- SECTION 3 + 4 : Logiciels & Compétences -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2.5rem;">
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <header class="px-6 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-r from-[#FDF3FB] to-white">
                    <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">3</span>
                    <h2 class="text-lg font-semibold text-[#243561]">Logiciels utilisés</h2>
                </header>
                <div class="p-6">
                    <div style="display:flex; flex-wrap:wrap; gap:8px;">
                        <?php foreach ($logiciels as $logiciel) { ?>
                            <label style="cursor:pointer;">
                                <input <?php if (!empty($logiciel['checked'])) echo 'checked'; ?>
                                    type="checkbox" name="logiciels[]" value="<?php echo $logiciel['id']; ?>" class="sr-only peer" />
                                <span class="inline-flex items-center px-4 py-2 rounded-full border-2 border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-[#DB9ECF] peer-checked:bg-[#DB9ECF] peer-checked:border-[#DB9ECF] peer-checked:text-white transition-all select-none">
                                    <?php echo htmlspecialchars($logiciel['nomLogiciel']); ?>
                                </span>
                            </label>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <header class="px-6 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-r from-[#FDF3FB] to-white">
                    <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">4</span>
                    <h2 class="text-lg font-semibold text-[#243561]">Compétences mobilisées</h2>
                </header>
                <div class="p-6">
                    <div style="display:flex; flex-wrap:wrap; gap:8px;">
                        <?php foreach ($competences as $competence) { ?>
                            <label style="cursor:pointer;">
                                <input <?php if (!empty($competence['checked'])) echo 'checked'; ?>
                                    type="checkbox" name="competences[]" value="<?php echo $competence['id']; ?>" class="sr-only peer" />
                                <span class="inline-flex items-center px-4 py-2 rounded-full border-2 border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-[#243561] peer-checked:bg-[#243561] peer-checked:border-[#243561] peer-checked:text-white transition-all select-none">
                                    <?php echo htmlspecialchars($competence['nom']); ?>
                                </span>
                            </label>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- SECTION 5 : Textes -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <header class="px-6 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-r from-[#FDF3FB] to-white">
                <span class="w-8 h-8 rounded-full bg-[#DB9ECF] text-white text-sm font-bold flex items-center justify-center">5</span>
                <h2 class="text-lg font-semibold text-[#243561]">Description &amp; analyse</h2>
            </header>
            <div class="p-6" style="display:flex; flex-direction:column; gap:20px;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description du projet</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg outline-none resize-y leading-7"><?php echo str_replace(["&#13;&#10;", "&#10;", "&#13;"], "\n", htmlspecialchars_decode($projet['description'])); ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Problèmes rencontrés &amp; solutions</label>
                    <textarea name="apprentissage" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg outline-none resize-y leading-7"><?php echo str_replace(["&#13;&#10;", "&#10;", "&#13;"], "\n", htmlspecialchars_decode($projet['apprentissageCritique'])); ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Argumentaire</label>
                    <textarea name="argumentaire" rows="6"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg outline-none resize-y leading-7"><?php echo str_replace(["&#13;&#10;", "&#10;", "&#13;"], "\n", htmlspecialchars_decode($projet['argumentaire'])); ?></textarea>
                </div>
            </div>
        </section>

        <!-- BOUTON SUBMIT caché — déclenché par autosave -->
        <button type="submit" id="realSubmitBtn" style="display:none;"></button>
    </form>

</main>

<!-- MODALE AJOUT IMAGES -->
<div id="addImageOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); z-index:50; align-items:center; justify-content:center; padding:16px;">
    <div style="background:white; border-radius:16px; width:100%; max-width:600px; max-height:90vh; display:flex; flex-direction:column; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.3);">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-bottom:1px solid #f3f4f6;">
            <h3 style="font-size:1.2rem; font-weight:700; color:#DB9ECF; margin:0;">Ajouter des images</h3>
            <button id="closeAddImageBtn" type="button" style="width:36px; height:36px; border:none; background:#f3f4f6; border-radius:50%; cursor:pointer; font-size:18px;">×</button>
        </div>

        <form id="addImageForm" method="POST" action="index.php?page=ajoute_image_projet"
              enctype="multipart/form-data" style="flex:1; overflow-y:auto; padding:24px; display:flex; flex-direction:column; gap:16px;">
            <input type="hidden" value="<?php echo $projet['id'] ?>" name="projet_id">

            <div id="imgDropZone" style="position:relative; border:2px dashed #DB9ECF; background:#FDF3FB; border-radius:12px; padding:40px; text-align:center; cursor:pointer;">
                <input type="file" name="images[]" id="imgInput" accept="image/*" multiple
                    style="position:absolute; inset:0; width:100%; height:100%; opacity:0; cursor:pointer;">
                <div style="pointer-events:none;">
                    <div style="font-size:2.5rem; margin-bottom:8px;">📁</div>
                    <p style="font-weight:500; color:#243561; margin:0;">Glisse-dépose tes images ici</p>
                    <p style="font-size:0.85rem; color:#6b7280; margin:4px 0 0;">ou clique pour choisir — les grosses images sont compressées auto</p>
                </div>
            </div>

            <div id="imgError" style="display:none; padding:12px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; font-size:0.85rem; color:#dc2626;"></div>
            <div id="imgInfo" style="display:none; padding:12px; background:#eff6ff; border:1px solid #bfdbfe; border-radius:8px; font-size:0.85rem; color:#2563eb;"></div>
            <div id="imgPreviewContainer" style="display:none; grid-template-columns:repeat(3,1fr); gap:12px;"></div>
            <p id="imgPreviewCount" style="display:none; font-size:0.85rem; color:#6b7280; margin:0;"></p>
        </form>

        <div style="display:flex; justify-content:flex-end; gap:8px; padding:16px 24px; border-top:1px solid #f3f4f6; background:#f9fafb;">
            <button type="button" id="cancelAddImageBtn" style="padding:8px 20px; background:white; border:1px solid #e5e7eb; border-radius:8px; cursor:pointer; font-weight:500;">Annuler</button>
            <button type="submit" form="addImageForm" id="submitAddImageBtn" disabled
                style="padding:8px 24px; background:#DB9ECF; color:white; border:none; border-radius:8px; cursor:pointer; font-weight:600; opacity:0.5;">
                <span class="btn-text">Ajouter</span>
                <span class="btn-loading" style="display:none;">⏳ Envoi…</span>
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== Hover sur les images : afficher boutons =====
    document.querySelectorAll('#images-sortable li[data-image-id]').forEach(li => {
        const btn = li.querySelector('.delete-img-btn');
        const hint = li.querySelector('div[style*="Glisser"]');
        li.addEventListener('mouseenter', () => {
            if (btn) btn.style.display = 'flex';
            if (hint) hint.style.display = 'block';
        });
        li.addEventListener('mouseleave', () => {
            if (btn) btn.style.display = 'none';
            if (hint) hint.style.display = 'none';
        });
    });

    // ===== Suppression image (AJAX — plus de form imbriqué) =====
    document.querySelectorAll('.delete-img-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Supprimer cette image ?')) return;
            const projetId = this.dataset.projetId;
            const imageNom = this.dataset.imageNom;
            const li = this.closest('li');

            const fd = new FormData();
            fd.append('projet_id', projetId);
            fd.append('image_id', imageNom);

            // Suppression optimiste : on retire la tuile immédiatement
            li.style.opacity = '0.4';
            li.style.pointerEvents = 'none';

            fetch('index.php?page=delete_image_projet', { method: 'POST', body: fd })
                .then(() => { li.remove(); })
                .catch(() => {
                    li.style.opacity = '1';
                    li.style.pointerEvents = 'auto';
                    alert('Erreur lors de la suppression');
                });
        });
    });

    // ===== Drag & drop réordonner =====
    const sortableEl = document.getElementById('images-sortable');
    if (sortableEl && typeof Sortable !== 'undefined') {
        const projetId = sortableEl.dataset.projetId;
        const status = document.getElementById('reorder-status');
        const statusText = status?.querySelector('.status-text');

        Sortable.create(sortableEl, {
            animation: 200,
            ghostClass: 'opacity-50',
            filter: '.js-no-drag',
            preventOnFilter: false,
            onMove: (evt) => !evt.related.classList.contains('js-no-drag'),
            onEnd: function() {
                const order = Array.from(sortableEl.querySelectorAll('li[data-image-id]')).map(li => li.dataset.imageId);
                if (statusText) statusText.textContent = 'Enregistrement…';
                status.style.opacity = '1';
                const fd = new FormData();
                fd.append('projet_id', projetId);
                order.forEach(id => fd.append('order[]', id));
                fetch('index.php?page=reorder_image_projet', { method: 'POST', body: fd })
                    .then(r => r.json())
                    .then(data => {
                        if (statusText) statusText.textContent = data.success ? '✓ Ordre enregistré' : '✗ Erreur';
                        setTimeout(() => { status.style.opacity = '0'; }, 1500);
                    })
                    .catch(() => { if (statusText) statusText.textContent = '✗ Erreur réseau'; });
            }
        });
    }

    // ===== Autosave : soumission du form quand on quitte un champ =====
    const form = document.getElementById('editProjectForm');
    const statusEl = document.getElementById('autosave-status');

    function saveForm() {
        if (statusEl) statusEl.textContent = '⏳ Enregistrement…';
        const fd = new FormData(form);
        fetch('index.php?page=save_update_projet', { method: 'POST', body: fd })
            .then(r => {
                if (r.ok) {
                    if (statusEl) {
                        statusEl.textContent = '✓ Enregistré';
                        statusEl.style.color = '#16a34a';
                        setTimeout(() => { statusEl.textContent = ''; }, 2000);
                    }
                } else {
                    if (statusEl) { statusEl.textContent = '✗ Erreur'; statusEl.style.color = '#dc2626'; }
                }
            })
            .catch(() => { if (statusEl) { statusEl.textContent = '✗ Erreur réseau'; statusEl.style.color = '#dc2626'; } });
    }

    // Debounce : attend 800ms après la dernière modif avant de sauvegarder
    let saveTimer = null;
    function scheduleSave() {
        clearTimeout(saveTimer);
        saveTimer = setTimeout(saveForm, 800);
    }

    // Écouter tous les champs du form
    form.querySelectorAll('input, textarea, select').forEach(el => {
        el.addEventListener('change', scheduleSave);
    });
    form.querySelectorAll('textarea').forEach(el => {
        el.addEventListener('input', scheduleSave);
    });

    // ===== Modale d'ajout d'images =====
    const addImageOverlay = document.getElementById('addImageOverlay');
    const openAddImageBtn = document.getElementById('openAddImageBtn');
    const closeAddImageBtn = document.getElementById('closeAddImageBtn');
    const cancelAddImageBtn = document.getElementById('cancelAddImageBtn');
    const imgInput = document.getElementById('imgInput');
    const imgPreviewContainer = document.getElementById('imgPreviewContainer');
    const imgPreviewCount = document.getElementById('imgPreviewCount');
    const submitAddImageBtn = document.getElementById('submitAddImageBtn');
    const imgError = document.getElementById('imgError');
    const imgInfo = document.getElementById('imgInfo');
    const addImageForm = document.getElementById('addImageForm');
    let imgFilesArray = [];

    function openImageModal() {
        addImageOverlay.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeImageModal() {
        addImageOverlay.style.display = 'none';
        document.body.style.overflow = '';
        imgFilesArray = [];
        imgError.style.display = 'none';
        imgInfo.style.display = 'none';
        updateImgPreviews();
    }

    openAddImageBtn?.addEventListener('click', openImageModal);
    closeAddImageBtn?.addEventListener('click', closeImageModal);
    cancelAddImageBtn?.addEventListener('click', closeImageModal);
    addImageOverlay?.addEventListener('click', (e) => { if (e.target === addImageOverlay) closeImageModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeImageModal(); });

    function formatSize(bytes) {
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(0) + ' Ko';
        return (bytes / (1024 * 1024)).toFixed(1) + ' Mo';
    }

    function compressImage(file) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            const reader = new FileReader();
            reader.onload = (e) => { img.src = e.target.result; };
            img.onload = () => {
                let { width, height } = img;
                if (width > 2000) { height = Math.round(height * 2000 / width); width = 2000; }
                const canvas = document.createElement('canvas');
                canvas.width = width; canvas.height = height;
                canvas.getContext('2d').drawImage(img, 0, 0, width, height);
                canvas.toBlob((blob) => {
                    if (!blob) return reject();
                    resolve(new File([blob], file.name.replace(/\.[^.]+$/, '') + '.jpg', { type: 'image/jpeg' }));
                }, 'image/jpeg', 0.85);
            };
            img.onerror = reject;
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    function updateImgPreviews() {
        imgPreviewContainer.innerHTML = '';
        if (imgFilesArray.length === 0) {
            imgPreviewContainer.style.display = 'none';
            imgPreviewCount.style.display = 'none';
            submitAddImageBtn.disabled = true;
            submitAddImageBtn.style.opacity = '0.5';
            const dt = new DataTransfer();
            imgInput.files = dt.files;
            return;
        }
        imgPreviewContainer.style.display = 'grid';
        imgPreviewCount.style.display = 'block';
        const total = imgFilesArray.reduce((s, f) => s + f.size, 0);
        imgPreviewCount.textContent = imgFilesArray.length + ' image(s) — ' + formatSize(total) + ' total';
        submitAddImageBtn.disabled = false;
        submitAddImageBtn.style.opacity = '1';

        imgFilesArray.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const card = document.createElement('div');
                card.style.cssText = 'position:relative; border-radius:8px; overflow:hidden; border:1px solid #e5e7eb; aspect-ratio:1; background:#f9fafb;';
                card.innerHTML = `
                    <img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">
                    <button type="button" style="position:absolute;top:4px;right:4px;width:24px;height:24px;background:#ef4444;color:white;border:none;border-radius:50%;cursor:pointer;font-weight:bold;font-size:14px;line-height:1;" class="rm-btn">×</button>
                    <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,0.6);color:white;font-size:11px;padding:2px 6px;">${formatSize(file.size)}</div>
                `;
                imgPreviewContainer.appendChild(card);
                card.querySelector('.rm-btn').addEventListener('click', () => {
                    imgFilesArray.splice(index, 1);
                    updateImgPreviews();
                });
            };
            reader.readAsDataURL(file);
        });

        const dt = new DataTransfer();
        imgFilesArray.forEach(f => dt.items.add(f));
        imgInput.files = dt.files;
    }

    async function addImgFiles(files) {
        imgInfo.textContent = '⏳ Traitement…'; imgInfo.style.display = 'block';
        const refused = [];
        for (const file of Array.from(files)) {
            if (!file.type.startsWith('image/')) continue;
            const mb = file.size / 1024 / 1024;
            if (mb > 8) { refused.push(file.name); continue; }
            if (mb > 1.5) {
                try { imgFilesArray.push(await compressImage(file)); }
                catch { refused.push(file.name); }
            } else {
                imgFilesArray.push(file);
            }
        }
        imgInfo.style.display = 'none';
        if (refused.length) { imgError.textContent = '❌ Refusés (>8 Mo) : ' + refused.join(', '); imgError.style.display = 'block'; }
        else imgError.style.display = 'none';
        updateImgPreviews();
    }

    imgInput?.addEventListener('change', (e) => addImgFiles(e.target.files));
    const dz = document.getElementById('imgDropZone');
    if (dz) {
        dz.addEventListener('dragover', (e) => { e.preventDefault(); dz.style.background = '#FBE9F5'; });
        dz.addEventListener('dragleave', () => { dz.style.background = '#FDF3FB'; });
        dz.addEventListener('drop', (e) => { e.preventDefault(); dz.style.background = '#FDF3FB'; addImgFiles(e.dataTransfer.files); });
    }

    addImageForm?.addEventListener('submit', () => {
        submitAddImageBtn.disabled = true;
        submitAddImageBtn.querySelector('.btn-text').style.display = 'none';
        submitAddImageBtn.querySelector('.btn-loading').style.display = 'inline';
    });
});
</script>