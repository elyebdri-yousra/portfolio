<main class="flex-1 container mx-auto p-4 pb-24 max-w-[1440px] font-[Cantarell]" role="main" aria-label="Détail du projet sélectionné">
    <!-- Titre et bouton retour -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full gap-4 mb-4">
        <h1 class="text-4xl font-bold" aria-label="Titre du projet : <?php echo strip_tags($projet['titre']); ?>">
            <?php echo html_entity_decode($projet['titre']); ?>
        </h1>
        <div class="flex flex-wrap gap-2">
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) { ?>
                <a href="index.php?page=projet_edit&id=<?php echo $projet['id'] ?>"
                    class="bg-[#DB9ECF] text-white px-[80px] py-[20px] rounded-xl hover:bg-[#c085b7] transition-colors  sm:w-auto text-base sm:text-lg flex  items-center justify-center w-[300px]">
                    Modifier
                </a>
            <?php } ?>
            <a href="index.php?page=projet#liste"
                class="bg-[#DB9ECF] text-white px-[80px] py-[20px] rounded-xl hover:bg-[#c085b7] transition-colors  sm:w-auto text-base sm:text-lg flex  items-center justify-center w-[300px] ">
                Retour
            </a>
        </div>
    </div>

    <!-- Carrousel d'images -->
    <div class="bg-[#DB9ECF] rounded-xl w-full relative overflow-hidden h-[300px] sm:h-[400px] md:h-[470px]">
        <div id="carousel" class="w-full h-full flex transition-transform duration-500 ease-in-out">
            <?php foreach ($images as $image) : ?>
                <div class="swiper-slide min-w-full h-full">
                    <img
                        src="<?php echo html_entity_decode($image['img_path']); ?>"
                        alt="Aperçu visuel du projet <?php echo strip_tags($projet['titre']); ?>"
                        class="zoomable-img w-full h-full object-contain bg-[#F7F5EE] cursor-pointer"
                        onclick="openLightbox('<?php echo html_entity_decode($image['img_path']); ?>')">
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="moveCarousel(-1)" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">&lt;</button>
        <button onclick="moveCarousel(1)" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">&gt;</button>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 hidden flex justify-center items-center z-50" onclick="closeLightbox()">
        <img id="lightbox-img" src="" class="max-h-[90vh] max-w-[90vw] rounded shadow-xl" alt="Image en grand">
    </div>

    <!-- Grille 2 colonnes -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
        <!-- Colonne gauche -->
        <div class="space-y-6">
            <section class="rounded-xl bg-white p-4 shadow" aria-labelledby="description-titre">
                <h3 id="description-titre" class="text-lg font-semibold mb-2">Description du projet</h3>
                <p class="leading-7 mb-5">
                    <?php echo nl2br(htmlspecialchars(html_entity_decode($projet['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')); ?></p>

                <h3 class="text-lg font-semibold mb-2">Logiciels utilisés & Dates</h3>
                <div class="flex flex-wrap gap-4 mb-2" aria-label="Logiciels utilisés dans le projet">
                    <?php foreach ($logiciels as $logiciel) { ?>
                        <div class="h-12 flex items-center justify-center">
                            <img
                                src="<?php echo html_entity_decode($logiciel['url_img']); ?>"
                                alt="Logo du logiciel <?php echo html_entity_decode($logiciel['nomLogiciel']); ?>"
                                class="max-h-12">
                        </div>
                    <?php } ?>
                </div>
                <p class="text-sm"><strong>Date :</strong> <?php echo html_entity_decode($projet['date']); ?></p>
                <p class="text-sm"><strong>Date de création :</strong> <?php echo html_entity_decode($projet['dateCrea']); ?></p>
            </section>

            <section class="rounded-xl bg-white p-4 shadow" aria-labelledby="problemes-titre">
                <h3 id="problemes-titre" class="text-lg font-semibold mb-2">Problèmes rencontrés et solutions apportées</h3>
                <p class="leading-7">
                    <?php echo nl2br(htmlspecialchars(html_entity_decode($projet['apprentissageCritique'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')); ?></p>
            </section>
        </div>

        <!-- Colonne droite -->
        <div class="space-y-6">
            <article class="rounded-xl bg-white p-4 shadow relative" aria-labelledby="competences-titre">
                <h3 id="competences-titre" class="text-lg font-semibold mb-2">Compétences du projet</h3>
                <div id="competences-content" class="max-h-[200px] overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="grid grid-cols-3 grid-rows-2 gap-4">
                        <?php foreach ($competences as $competence) { ?>
                            <div>
                                <p> <?php echo nl2br(htmlspecialchars(html_entity_decode($competence['nom'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')); ?></p>
                                </p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </article>

            <article class="rounded-xl bg-white p-4 shadow relative" aria-labelledby="argumentaire-titre">
                <h3 id="argumentaire-titre" class="text-lg font-semibold mb-2">Argumentaire du projet</h3>
                <div id="argumentaire-content" class="max-h-[200px] overflow-hidden transition-all duration-300 ease-in-out">
                    <p class="leading-7">
                        <?php echo nl2br(htmlspecialchars(html_entity_decode($projet['argumentaire'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')); ?>
                    </p>
                </div>
                <button id="toggle-button" class="mt-2 text-sm text-blue-600 hover:underline hidden">
                    Afficher plus
                </button>
            </article>

            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2)) { ?>
                <div class="rounded-xl bg-white p-4 shadow" id="commentaire">
                    <h3 class="text-xl font-[Cantarell] text-center font-semibold mb-4">Commentaires</h3>
                    <div id="commentaires-container" aria-live="polite" class="space-y-2 h-[300px] overflow-y-scroll scrollbar-none">
                        <?php if (!empty($commentaires)) : ?>
                            <?php foreach ($commentaires as $commentaire) : ?>
                                <article class="flex <?php echo $user_id == $commentaire['userId'] ? 'justify-end' : 'justify-start'; ?>" aria-label="Commentaire de <?php echo $commentaire['prenom'] . ' ' . $commentaire['nom']; ?>">
                                    <div class="bg-[#D9D9D9] max-w-[80%] p-2 rounded-md">
                                        <div class="flex justify-between mb-1 text-sm font-semibold">
                                            <span><?php echo $commentaire['prenom'] . ' ' . $commentaire['nom']; ?></span>
                                        </div>
                                        <p class="text-sm"><?php echo $commentaire['commentaire'] ?? ''; ?></p>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-gray-500 text-center">Aucun commentaire disponible.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Formulaire -->
                    <form method="POST" action="index.php?page=addCommentaire#commentaire" class="flex flex-col sm:flex-row items-center justify-center mt-4 gap-2 sm:gap-0">
                        <input type="hidden" name="id" value="<?php echo $projet['id']; ?>">
                        <input
                            type="text"
                            name="commentaire"
                            id="commentaire"
                            required
                            class="w-full sm:w-[75%] h-10 bg-[#D9D9D9] indent-2 rounded-sm border border-[#DB9ECF] focus:outline-none"
                            placeholder="Écrire votre commentaire">
                        <input
                            type="submit"
                            value="Envoyer"
                            class="w-full sm:w-[25%] h-10 bg-[#DB9ECF] cursor-pointer hover:bg-white hover:text-[#DB9ECF] font-semibold text-white rounded-sm border border-[#DB9ECF] transition-colors duration-200">
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<!-- Script JS -->
<script>
    // Carrousel
    let currentIndex = 0;
    const carousel = document.getElementById('carousel');
    const totalImages = carousel.children.length;

    function moveCarousel(direction) {
        const newIndex = currentIndex + direction;

        if (newIndex >= totalImages) {
            currentIndex = 0;
            carousel.style.transition = 'none';
            carousel.style.transform = `translateX(0%)`;
            setTimeout(() => {
                carousel.style.transition = 'transform 0.5s ease-in-out';
            }, 0);
        } else if (newIndex < 0) {
            currentIndex = totalImages - 1;
            carousel.style.transition = 'none';
            carousel.style.transform = `translateX(-${(totalImages - 1) * 100}%)`;
            setTimeout(() => {
                carousel.style.transition = 'transform 0.5s ease-in-out';
            }, 0);
        } else {
            currentIndex = newIndex;
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
    }

    carousel.style.transition = 'transform 0.5s ease-in-out';

    // Argumentaire toggle
    document.addEventListener("DOMContentLoaded", function() {
        const content = document.getElementById("argumentaire-content");
        const button = document.getElementById("toggle-button");
        const commentaires = document.getElementById("commentaires-container");

        if (content && button && content.scrollHeight > 200) {
            button.classList.remove("hidden");
        }

        if (commentaires) {
            commentaires.scrollTop = commentaires.scrollHeight;
        }

        let expanded = false;
        button?.addEventListener("click", function() {
            expanded = !expanded;
            content.classList.toggle("max-h-[200px]");
            content.classList.toggle("overflow-hidden");
            button.textContent = expanded ? "Afficher moins" : "Afficher plus";
        });
    });

    // Lightbox
    function openLightbox(src) {
        const lightbox = document.getElementById("lightbox");
        const lightboxImg = document.getElementById("lightbox-img");
        lightboxImg.src = src;
        lightbox.classList.remove("hidden");
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById("lightbox");
        lightbox.classList.add("hidden");
        document.body.style.overflow = '';
    }
</script>