<main class="flex-1 container mx-auto p-4 pb-24 max-w-[1440px] font-[Cantarell]" role="main" aria-label="Détail du projet sélectionné">
    <!-- Titre et bouton retour -->
    <div class="flex flex-row justify-between items-center w-full mb-4">
        <h1 class="text-4xl font-bold"><?php echo html_entity_decode($projet['titre']); ?></h1>
        <a href="index.php?page=projet#liste"
            class="bg-[#DB9ECF] font-[Cantarell] text-lg text-white px-6 py-2 rounded-md hover:bg-[#c085b7] transition-colors"
            aria-label="Revenir à la liste des projets">
            Retour
        </a>
    </div>

    <!-- Carrousel d'images -->
    <div class="bg-[#DB9ECF] rounded-xl w-full relative overflow-hidden h-[470px]">
        <div id="carousel" class="w-[1440px] h-full flex">
            <?php foreach ($images as $image) : ?>
                <div class="swiper-slide">
                    <img
                        src="<?php echo html_entity_decode($image['img_path']); ?>"
                        alt="Visuel du projet : <?php echo html_entity_decode($projet['titre']); ?>"
                        class="zoomable-img w-full h-full object-contain bg-[#F7F5EE]">
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="moveCarousel(-1)" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">&lt;</button>
        <button onclick="moveCarousel(1)" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">&gt;</button>
    </div>

    <!-- Grille 2 colonnes -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
        <!-- Colonne gauche -->
        <div class="space-y-6">
            <div class="rounded-xl bg-white p-4 shadow">
                <h3 class="text-lg font-semibold mb-2">Description du projet</h3>
                <p class="leading-7 mb-5"><?php echo html_entity_decode($projet['description']); ?></p>
                <h3 class="text-lg font-semibold mb-2">Logiciels utilisés & Dates</h3>
                <div class="flex flex-wrap gap-4 mb-2">
                    <?php foreach ($logiciels as $logiciel) { ?>
                        <div class="h-12 flex items-center justify-center">
                            <img
                                src="<?php echo html_entity_decode($logiciel['url_img']); ?>"
                                alt="Logo <?php echo html_entity_decode($logiciel['nomLogiciel']); ?>"
                                class="max-h-12">
                        </div>
                    <?php } ?>
                </div>
                <p class="text-sm"><strong>Date :</strong> <?php echo html_entity_decode($projet['date']); ?></p>
                <p class="text-sm"><strong>Date de création :</strong> <?php echo html_entity_decode($projet['dateCrea']); ?></p>
            </div>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1) { ?>
                <div class="rounded-xl bg-white p-4 shadow">
                    <h3 class="text-lg font-semibold mb-2">Ressources</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        <li>Lorem ipsum dolor sit amet.</li>
                        <li>Nulla facilisi.</li>
                        <li>Fusce auctor sapien.</li>
                        <li>Integer tincidunt.</li>
                    </ul>
                </div>
            <?php } ?>
            <div class="rounded-xl bg-white p-4 shadow">
                <h3 class="text-lg font-semibold mb-2">Problèmes rencontrés et solutions apportées</h3>
                <p class="leading-7"><?php echo html_entity_decode($projet['argumentaire']); ?></p>
            </div>

        </div>

        <!-- Colonne droite -->
        <div class="space-y-6">

            <div class="rounded-xl bg-white p-4 shadow">
                <h3 class="text-lg font-semibold mb-2">Argumentaire</h3>
                <p class="leading-7"><?php echo html_entity_decode($projet['argumentaire']); ?></p>
            </div>
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2)) { ?>
                <div class="rounded-xl bg-white p-4 shadow" id="commentaire">
                    <h3 class="text-xl font-[Cantarell] text-center font-semibold mb-4">Commentaires</h3>
                    <div id="commentaires-container" aria-live="polite" class="space-y-2 h-[300px] overflow-y-scroll scrollbar-none">
                        <?php if (!empty($commentaires)) : ?>
                            <?php foreach ($commentaires as $commentaire) : ?>
                                <div class="flex <?php echo $user_id == $commentaire['userId'] ? 'justify-end' : 'justify-start'; ?>">
                                    <div class="bg-[#D9D9D9] max-w-[80%] p-2 rounded-md">
                                        <div class="flex justify-between mb-1 text-sm font-semibold">
                                            <span><?php echo $commentaire['prenom'] . ' ' . $commentaire['nom']; ?></span>
                                            
                                        </div>
                                        <p class="text-sm"><?php echo $commentaire['commentaire'] ?? ''; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-gray-500 text-center">Aucun commentaire disponible.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Formulaire -->
                    <form method="POST" action="index.php?page=addCommentaire#commentaire" class="flex items-center justify-center mt-4">
                        <input type="hidden" name="id" value="<?php echo $projet['id']; ?>">
                        <input
                            type="text"
                            name="commentaire"
                            id="commentaire"
                            required
                            class="w-[75%] h-10 bg-[#D9D9D9] indent-2 rounded-l-sm border border-[#DB9ECF] focus:outline-none"
                            placeholder="Écrire votre commentaire">
                        <input
                            type="submit"
                            value="Envoyer"
                            class="w-[25%] h-10 bg-[#DB9ECF] cursor-pointer hover:bg-white hover:text-[#DB9ECF] font-semibold text-white rounded-r-sm border border-[#DB9ECF] transition-colors duration-200">
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<script>
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

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('commentaires-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>

<style>
    #carousel img {
        min-width: 100%;
    }
</style>