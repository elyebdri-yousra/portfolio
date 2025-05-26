<main class="container mx-auto p-4 scrollbar-none overflow-auto" role="main" aria-label="Liste des projets du portfolio de formation">
    <div class="w-full flex flex-row items-center justify-between">
        <h1 class="text-5xl font-bold my-6">Portfolio de Formation</h1>

        <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) : ?>
            <button id="openOverlayBtn" aria-haspopup="dialog" aria-controls="overlay" aria-expanded="false" class="bg-[#DB9ECF] text-white p-4 font-[Cantarell] rounded-xl hover:bg-[#c085b7] transition-colors my-8">
                Ajouter un projet
            </button>

            <!-- Modale d'ajout de projet -->
            <div id="overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-h-[85%] relative">
                    <button id="closeOverlayBtn" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" aria-label="Fermer la fenêtre">
                        <i class="fas fa-times fa-xl"></i>
                    </button>
                    <h2 id="modalTitle" class="text-2xl font-bold mb-4">Ajouter un projet</h2>

                    <form action="index.php?page=projet_add" method="POST" enctype="multipart/form-data" class="flex flex-row justify-around">
                        <div class="w-[80%] grid grid-cols-2 gap-4">
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
                                    <option value="infographie">Infographie</option>
                                    <option value="vidéo">Production audio visuelle</option>
                                    <option value="programme">Développement</option>
                                    <option value="texte">Communication</option>
                                </select>
                            </div>

                            <div class="col-span-2">
                                <label for="description">Description :</label>
                                <textarea name="description" id="description" required class="w-full p-2 border rounded h-20"></textarea>
                            </div>

                            <div>
                                <label for="apprentissage">Apprentissage critique :</label>
                                <input type="text" name="apprentissage" id="apprentissage" class="w-full p-2 border rounded">
                            </div>

                            <div>
                                <label for="competence">Compétence associée :</label>
                                <input type="text" name="competence" id="competence" class="w-full p-2 border rounded">
                            </div>

                            <div class="col-span-2">
                                <label for="argumentaire">Argumentaire :</label>
                                <textarea name="argumentaire" id="argumentaire" required class="w-full p-2 border rounded h-20"></textarea>
                            </div>

                            <div class="col-span-2">
                                <button type="submit" class="bg-[#DB9ECF] text-white p-3 w-full rounded-xl hover:bg-[#c085b7] transition-colors">
                                    Ajouter
                                </button>
                            </div>
                        </div>

                        <div class="w-[18%] h-[100%] justify-center items-center flex space-y-4 flex-col">
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
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="flex items-center gap-4 mb-20">
        <p class="text-lg w-1/2">
            Explorez les projets qui jalonnent mon parcours, principalement réalisés dans le cadre de mon BUT MMI, mais aussi issus d’autres formations et expériences, reflétant mon évolution et ma polyvalence dans le domaine du multimédia et du digital.
        </p>
    </div>

    <?php if (!empty($projets)) : ?>
        <ul class="grid grid-cols-2 gap-6" id="liste">
            <?php foreach ($projets as $projet) : ?>
                <li>
                    <article class="border rounded-lg shadow flex flex-col gap-4 p-4 hover:shadow-md transition-shadow bg-white">
                        <?php if (!empty($projet['urlimg'])): ?>
                            <figure class="relative">
                                <img src="<?php echo html_entity_decode($projet['urlimg']); ?>" alt="Image du projet : <?php echo html_entity_decode($projet['titre']); ?>" class="rounded w-full h-48 object-cover">
                                <figcaption>
                                    <a href="index.php?page=projet_show&id=<?php echo $projet['id'] ?>" class="font-[Cantarell] hover:text-[#DB9ECF] duration-200 absolute inset-0 flex items-center justify-center text-2xl font-bold text-white bg-black bg-opacity-60">
                                        <?php echo html_entity_decode($projet['titre']); ?>
                                    </a>
                                </figcaption>
                            </figure>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) { ?>
                            <div class="flex flex-row justify-center">
                                <a href="index.php?page=supprimer&id=<?php echo $projet['id']; ?>" class="mt-auto text-red-500 hover:text-red-700 font-semibold font-[Cantarell]" aria-label="Supprimer le projet : <?php echo html_entity_decode($projet['titre']); ?>">
                                    Supprimer le projet
                                </a>
                            </div>
                        <?php } ?>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p class="text-gray-500">Aucun projet disponible.</p>
    <?php endif; ?>
</main>

<script>
    document.getElementById('openOverlayBtn').addEventListener('click', function() {
        const overlay = document.getElementById('overlay');
        overlay.classList.remove('hidden');
        this.setAttribute('aria-expanded', 'true');
    });

    document.getElementById('closeOverlayBtn').addEventListener('click', function() {
        const overlay = document.getElementById('overlay');
        overlay.classList.add('hidden');
        document.getElementById('openOverlayBtn').setAttribute('aria-expanded', 'false');
    });

    document.getElementById('overlay').addEventListener('click', function(event) {
        if (event.target === this) {
            this.classList.add('hidden');
            document.getElementById('openOverlayBtn').setAttribute('aria-expanded', 'false');
        }
    });
</script>