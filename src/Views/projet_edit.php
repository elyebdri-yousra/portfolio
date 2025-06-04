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
    <div class="bg-[#DB9ECF] rounded-xl w-full relative overflow-auto h-[470px] p-4">
        <ul class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <?php foreach ($images as $image): ?>
                <li class="bg-gray-200 rounded-lg p-4 flex flex-col space-y-2  items-center">
                    <img class="h-20" src="<?php echo $image["img_path"] ?>">
                    <form method="POST" action="index.php?page=delete_image_projet">
                        <input type="hidden" value="<?php echo $projet['id'] ?>" name="projet_id">
                        <input type="hidden" name="image_id" value="<?= $image['nom'] ?>">
                        <button type="submit" class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600 transition">
                            Supprimer
                        </button>
                    </form>
                </li>
            <?php endforeach; ?>
            <li class="bg-gray-200 rounded-lg p-4 flex flex-col space-y-2  items-center">
                <form method="POST" action="index.php?page=ajoute_image_projet" class="flex flex-col items-center justify-center" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $projet['id'] ?>" name="projet_id">
                    <input type="file" name="images[]" id="images" accept="image/*" multiple class="w-full p-2 border rounded">

                    <button type="submit" class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600 transition">
                        Ajouter
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Grille 2 colonnes -->
    <div>
        <!-- Colonne gauche -->
        <form class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6" method="POST" action="index.php?page=save_update_projet" >
            <input type="hidden" value="<?php echo $projet['id'] ?>" name="id_projet">
            <div class="space-y-6">
                <div class="rounded-xl bg-white p-4 shadow">
                    <h3 class="text-lg font-semibold mb-2">Description du projet</h3>
                    <textarea class="leading-7 mb-5 w-full p-2 border rounded h-20 " name="description" id="description"><?php echo html_entity_decode(htmlspecialchars($projet['description'])); ?></textarea>
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
                    <div>
                        <label for="date">Date d'ajout :</label>
                        <input type="date" value="<?php echo html_entity_decode($projet['date']); ?>" name="date" id="date" required class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label for="annee_but">Année de création (BUT) :</label>
                        <input type="number" value="<?php echo html_entity_decode($projet['dateCrea']); ?>" name="annee_but" id="annee_but" required class="w-full p-2 border rounded">
                    </div>
                </div>

                <div class="rounded-xl bg-white p-4 shadow">
                    <h3 class="text-lg font-semibold mb-2">Problèmes rencontrés et solutions apportées</h3>
                    <textarea class="leading-7 mb-5 w-full p-2 border rounded h-20 " name="apprentissage" id="apprentissage"><?php echo html_entity_decode(htmlspecialchars($projet['apprentissageCritique'])); ?></textarea>
                </div>

            </div>

            <!-- Colonne droite -->
            <div class="space-y-6">
                <div class="rounded-xl bg-white p-4 shadow relative">
                    <h3 class="text-lg font-semibold mb-2">Argumentaire</h3>
                    <div id="argumentaire-content" class="max-h-[500px] overflow-hidden transition-all duration-300 ease-in-out">
                        <textarea class="leading-7 mb-5 w-full p-2 border rounded h-20 " name="argumentaire" id="argumentaire"><?php echo html_entity_decode(htmlspecialchars(htmlspecialchars($projet['argumentaire']))); ?>
                        </textarea>
                    </div>
                    <button id="toggle-button" class="mt-2 text-sm text-blue-600 hover:underline hidden">
                        Afficher plus
                    </button>
                </div>
            </div>
            <input type="submit" class="bg-red-200">
        </form>
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


    document.addEventListener("DOMContentLoaded", function() {
        const content = document.getElementById("argumentaire-content");
        const button = document.getElementById("toggle-button");

        // Vérifie si le contenu dépasse 200px
        if (content.scrollHeight > 200) {
            button.classList.remove("hidden");
        }

        let expanded = false;

        button.addEventListener("click", function() {
            expanded = !expanded;
            if (expanded) {
                content.classList.remove("max-h-[200px]", "overflow-hidden");
                button.textContent = "Afficher moins";
            } else {
                content.classList.add("max-h-[200px]", "overflow-hidden");
                button.textContent = "Afficher plus";
            }
        });
    });
</script>

<style>
    #carousel img {
        min-width: 100%;
    }
</style>