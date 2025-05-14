<main class="container mx-auto p-4 max-w-[1440px] flex flex-col font-[Cantarell] overflow-y-scroll scrollbar-none">

    <!-- Bouton Retour -->
    <div class="w-full">
        <a href="index.php?page=projet#liste" class="bg-[#DB9ECF] font-[Cantarell] text-lg text-white px-16 py-1 rounded-md hover:bg-[#c085b7] transition-colors">
            Retour
        </a>
    </div>

    <div class="grid grid-cols-1 gap-10 mt-6">

        <!-- Bloc Image + Infos -->
        <div class="w-full h-[470px] flex flex-row space-x-6">
            <!-- Carrousel -->
            <div class="bg-[#DB9ECF] rounded-xl h-full w-full relative overflow-hidden">
                <div id="carousel" class="w-full h-full flex">
                    <?php foreach ($images as $image) : ?>
                        <div class="swiper-slide">
                            <img src="<?php echo html_entity_decode($image['img_path']); ?>"
                                alt="<?php echo html_entity_decode($projet['titre']); ?>"
                                class="w-full h-full object-contain bg-[#F7F5EE]">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Flèches de navigation -->
                <button onclick="moveCarousel(-1)" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">
                    &lt;
                </button>
                <button onclick="moveCarousel(1)" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">
                    &gt;
                </button>
            </div>

            <!-- Infos projet -->
            <div class="rounded-xl h-full w-3/5 space-y-4">
                <h1 class="text-4xl pt-2"><?php echo html_entity_decode($projet['titre']); ?></h1>
                <div class="min-w-24 h-12 flex items-center justify-start text-sm">
                    <?php echo html_entity_decode($projet['dateCrea']); ?>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <?php foreach ($logiciels as $logiciel) : ?>
                        <img src="<?php echo html_entity_decode($logiciel['url_img']); ?>"
                            alt="<?php echo html_entity_decode($logiciel['nomLogiciel']); ?>"
                            class="max-h-12">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Description et Argumentaire -->
        <div class="container mx-auto p-4 flex items-start gap-8">
            <div class="w-1/2">
                <h2 class="text-black font-semibold">Description</h2>
                <p class="text-left leading-7"><?php echo html_entity_decode($projet['description']); ?></p>
            </div>

            <div class="w-1/2">
                <h2 class="text-black font-semibold">Problèmes Rencontrés et Solutions Apportées</h2>
                <p class="text-left leading-7"><?php echo html_entity_decode($projet['argumentaire']); ?></p>
            </div>
        </div>

            <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['idRole'], [1, 2])) : ?>
                <div class="w-full">
                    <p class="font-bold">Ressources :</p>
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        <li><?php echo $projet['apprentissageCritique']; ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        

        <!-- Commentaires -->
        <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['idRole'], [1, 2])) : ?>
            <div class="w-full flex flex-col h-[500px] space-y-4">
                <h3>
                    <?php echo $_SESSION['user']['idRole'] == 1 ? "Vous êtes administrateur" : "Vous êtes évaluateur"; ?>
                </h3>

                <div class="w-full h-[470px] flex flex-row space-x-6">
                    <div class="rounded-xl h-full w-3/5 bg-[#FFFFFF] shadow-md" id="commentaire">
                        <h2 class="text-xl pt-2 mt-2 font-[Cantarell] h-[50px] text-center font-semibold">Commentaires</h2>

                        <div id="commentaires-container" class="grid grid-cols-1 gap-2 mt-6 w-full h-[300px] overflow-y-scroll scrollbar-none">
                            <?php if (!empty($commentaires)) : ?>
                                <?php foreach ($commentaires as $commentaire) : ?>
                                    <div class="w-full flex <?php echo $user_id == $commentaire['userId'] ? 'justify-end' : 'justify-start'; ?>">
                                        <div class="bg-[#D9D9D9] min-w-[50%] max-w-[80%] p-1 rounded-sm <?php echo $user_id == $commentaire['userId'] ? 'mr-6' : 'ml-6'; ?>">
                                            <h3><?php echo $commentaire['prenom'] . ' ' . $commentaire['nom']; ?></h3>
                                            <p class="w-full break-words"><?php echo $commentaire['commentaire'] ?? ''; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-gray-500 w-full text-center">Aucun commentaire disponible.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Formulaire d'ajout de commentaire -->
                        <form method="POST" action="index.php?page=addCommentaire#commentaire" class="flex items-center justify-center w-full h-[70px]">
                            <input type="hidden" name="id" value="<?php echo $projet['id']; ?>">
                            <input
                                type="text"
                                name="commentaire"
                                required
                                class="w-[75%] h-[70%] bg-[#D9D9D9] indent-2 rounded-l-sm border-l-2 border-y-2 border-[#DB9ECF] focus:outline-none"
                                placeholder="Écrire votre commentaire">
                            <input
                                type="submit"
                                value="Envoyer"
                                class="w-[15%] h-[70%] bg-[#DB9ECF] cursor-pointer hover:bg-white hover:text-[#DB9ECF] font-semibold text-white rounded-r-sm border-l-2 border-[#DB9ECF] transition-colors">
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<script>
    let currentIndex = 0;
    const carousel = document.getElementById('carousel');
    const totalImages = carousel.children.length;

    function moveCarousel(direction) {
        currentIndex += direction;

        if (currentIndex < 0) currentIndex = totalImages - 1;
        if (currentIndex >= totalImages) currentIndex = 0;

        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    carousel.style.transition = 'transform 0.5s ease-in-out';

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('commentaires-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>