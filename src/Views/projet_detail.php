<main class="container mx-auto p-4 max-w-6xl flex flex-col font-[Cantarell] overflow-y-scroll scrollbar-none">
    <!-- Titre et description du projet en haut de page -->
    <div class="w-full">
        <a href="index.php?page=projet#liste" class="bg-[#DB9ECF] font-[Cantarell] text-lg text-white px-16 py-1 rounded-md hover:bg-[#c085b7] transition-colors">
            Retour
        </a>
    </div>
    <div class="grid grid-cols-1 gap-10 mt-6  ">
        <!-- Carré à gauche -->
        <div class="w-full h-[470px] space-x-6 flex flex-row">
            <div class="bg-[#DB9ECF] rounded-xl h-full w-2/5 relative overflow-hidden ">
                <!-- Carousel Implementation -->
                <div id="carousel" class="w-full h-full flex ">
                    <?php foreach ($images as $image) : ?>
                        <div class="swiper-slide ">
                            <img src="<?php echo html_entity_decode($image['img_path']); ?>"
                                alt="<?php echo html_entity_decode($projet['titre']); ?>"
                                class="zoomable-img w-full h-full object-contain bg-[#F7F5EE] ">
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Navigation Buttons -->
                <button onclick="moveCarousel(-1)" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2 ">
                    <
                        </button>
                        <button onclick="moveCarousel(1)" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white/50 hover:bg-white/80 text-black rounded-full p-2">
                            >
                        </button>
            </div>
            <div class="rounded-xl h-full w-3/5 space-y-4">
                <h1 class="text-4xl pt-2 ml-1"><?php echo html_entity_decode($projet['titre']); ?></h1>
                <p class="ml-1 text-left leading-7 max-h-48 overflow-y-scroll scrollbar-none"><?php echo html_entity_decode($projet['description']); ?></p>
                <div class="flex gap-2 mb-4 overflow-y-scroll scrollbar-none">
                    <?php foreach ($logiciels as $logiciel) { ?>
                        <div class="min-w-24 h-12 flex items-center justify-center text-sm">
                            <img src="<?php echo html_entity_decode($logiciel['url_img']); ?>"
                                alt="<?php echo html_entity_decode($logiciel['nomLogiciel']); ?>"
                                class="max-h-12">

                        </div>
                    <?php } ?>
                    <div class="min-w-24 h-12 flex items-center justify-center text-sm"><?php echo html_entity_decode($projet['date']); ?></div>
                    <div class="min-w-24 h-12 flex items-center justify-center text-sm"><?php echo html_entity_decode($projet['dateCrea']); ?></div>
                </div>
                <?php if (isset($_SESSION['user']) && (($_SESSION['user']['idRole'] == 1) || ($_SESSION['user']['idRole'] == 2))) { ?>
                    <div>
                        <p class="font-bold">Ressources :</p>
                        <ul class="list-disc list-inside text-sm  text-gray-700">
                            <li>Lorem ipsum dolor sit amet.</li>
                            <li>Nulla facilisi.</li>
                            <li>Fusce auctor sapien.</li>
                            <li>Integer tincidunt.</li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php if (isset($_SESSION['user']) && (($_SESSION['user']['idRole'] == 1) || ($_SESSION['user']['idRole'] == 2))) { ?>
            <div class="w-full flex flex-col h-[500px] space-y-4">
                <h3>Vous êtes évaluateur</h3>
                <div class="w-full h-[470px] space-x-6 flex flex-row">
                    <div class="rounded-xl h-full w-2/5 space-y-6 relative overflow-hidden ">
                        <h1 class="text-black font-[Cantarell]  font-semibold">Problèmes Rencontrés et Solutions Apportées</h1>
                        <p class="text-left leading-7 max-h-[280px] overflow-y-scroll scrollbar-none"><?php echo html_entity_decode($projet['argumentaire']); ?></p>

                    </div>
                    <div class="rounded-xl h-full w-3/5 space-y-3 bg-[#FFFFFF] shadow-md" id="commentaire">
                        <h1 class="text-xl pt-2 mt-2 font-[Cantarell] h-[50px] text-center font-semibold">Commentaires</h1>
                        <div id="commentaires-container" class="grid grid-cols-1 gap-2 mt-6 w-full h-[300px] overflow-y-scroll scrollbar-none">
                            <?php if (!empty($commentaires)) : ?>
                                <?php foreach ($commentaires as $commentaire) : ?>
                                    <div class="w-full flex items-start my-1 <?php echo $user_id == $commentaire['userId'] ? 'justify-end' : 'justify-start'; ?>">
                                        <div class="bg-[#D9D9D9] min-w-[50%] max-w-[80%] p-1 rounded-sm <?php echo $user_id == $commentaire['userId'] ? 'mr-6' : 'ml-6'; ?>">
                                            <div class="flex items-center justify-between">
                                                <h1><?php echo $commentaire['prenom'] . ' ' . $commentaire['nom'] ?></h1>
                                                <h1><?php echo $commentaire['createdAt'] ?></h1>
                                            </div>
                                            <p class="w-full break-all whitespace-normal"><?php echo ($commentaire['commentaire'] ?? ''); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-gray-500 h-full w-full text-center">Aucun commentaire disponible.</p>
                            <?php endif; ?>
                        </div>
                        <form method="POST" action="index.php?page=addCommentaire#commentaire" class="flex items-center justify-center w-full h-[70px]">
                            <input type="hidden" name="id" value="<?php echo $projet['id'] ?>">
                            <input
                                type="text"
                                name="commentaire" require
                                class="w-[75%] h-[70%] bg-[#D9D9D9] indent-2 rounded-l-sm border-l-2 border-y-2  border-[#DB9ECF] focus:outline-none peer"
                                placeholder="Écrire votre commentaire">
                            <input
                                type="submit"
                                class="w-[15%] h-[70%] bg-[#DB9ECF] cursor-pointer hover:bg-white hover:text-[#DB9ECF] font-semibold text-white rounded-r-sm border-l border-2 duration-200 border-[#DB9ECF]">
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</main>

<script>
    let currentIndex = 0;
    const carousel = document.getElementById('carousel');
    const totalImages = carousel.children.length;

    function moveCarousel(direction) {
        const newIndex = currentIndex + direction;

        // Handle bounds with seamless loop
        if (newIndex >= totalImages) {
            currentIndex = 0; // Jump to first image
            carousel.style.transition = 'none'; // Disable transition for instant jump
            carousel.style.transform = `translateX(0%)`;
            // Force reflow to apply transition for next move
            setTimeout(() => {
                carousel.style.transition = 'transform 0.5s ease-in-out';
            }, 0);
        } else if (newIndex < 0) {
            currentIndex = totalImages - 1; // Jump to last image
            carousel.style.transition = 'none'; // Disable transition for instant jump
            carousel.style.transform = `translateX(-${(totalImages - 1) * 100}%)`;
            // Force reflow to apply transition for next move
            setTimeout(() => {
                carousel.style.transition = 'transform 0.5s ease-in-out';
            }, 0);
        } else {
            currentIndex = newIndex;
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
    }

    // Smooth transition
    carousel.style.transition = 'transform 0.5s ease-in-out';

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('commentaires-container');
        container.scrollTop = container.scrollHeight; // Défiler jusqu'au bas
    });
</script>

<style>
    #carousel img {
        min-width: 100%;
    }
</style>