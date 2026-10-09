<main class="flex-1 container mx-auto p-4 pb-24 max-w-[1440px] font-[Cantarell]">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    
        <h1 class="text-4xl font-bold">
            <?php echo html_entity_decode($projet['titre']); ?>
        </h1>
    
        <div class="flex gap-2 flex-wrap">
    
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) { ?>
                <a href="index.php?page=projet_edit&id=<?php echo $projet['id'] ?>"
                   class="bg-[#DB9ECF] text-white px-6 py-3 rounded-xl hover:bg-[#c085b7] transition">
                    Modifier
                </a>
            <?php } ?>
    
            <a href="index.php?page=projet#liste"
               class="bg-[#DB9ECF] text-white px-6 py-3 rounded-xl hover:bg-[#c085b7] transition">
                Retour
            </a>
    
        </div>
    </div>

    <!-- CARROUSEL -->
    <div class="bg-[#DB9ECF] rounded-2xl w-full relative overflow-hidden h-[420px] mb-8">
        <div id="carousel" class="w-full h-full flex transition-transform duration-500">
            <?php foreach ($images as $image) : ?>
                <div class="min-w-full h-full">
                    <img src="<?php echo html_entity_decode($image['img_path']); ?>"
                         class="w-full h-full object-contain bg-[#F7F5EE]">
                </div>
            <?php endforeach; ?>
        </div>

        <button onclick="moveCarousel(-1)" class="absolute top-1/2 left-2 bg-white/60 p-2 rounded-full">&lt;</button>
        <button onclick="moveCarousel(1)" class="absolute top-1/2 right-2 bg-white/60 p-2 rounded-full">&gt;</button>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- ONGLET CONTENU -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border">

                <!-- TABS (FIX MOBILE) -->
                <div class="border-b overflow-x-auto md:overflow-visible">
                    <div class="flex min-w-max md:min-w-0">

                        <button class="tab-btn px-6 py-4 font-semibold text-[#DB9ECF] border-b-2 border-[#DB9ECF] whitespace-nowrap" data-tab="description">
                            Description
                        </button>

                        <button class="tab-btn px-6 py-4 text-stone-500 whitespace-nowrap" data-tab="argumentaire">
                            Argumentaire
                        </button>

                        <button class="tab-btn px-6 py-4 text-stone-500 whitespace-nowrap" data-tab="problemes">
                            Problèmes
                        </button>

                    </div>
                </div>

                <!-- CONTENU -->
                <div class="p-6 min-h-[260px]">

                    <div class="tab-content" id="description">
                        <div class="text-block overflow-hidden max-h-[180px] leading-relaxed text-stone-700 transition-all duration-300">
                            <?php echo nl2br(htmlspecialchars(html_entity_decode($projet['description']))); ?>
                        </div>
                        <button class="toggle-btn hidden text-sm text-[#DB9ECF] mt-3">Lire plus</button>
                    </div>

                    <div class="tab-content hidden" id="argumentaire">
                        <div class="text-block overflow-hidden max-h-[180px] leading-relaxed text-stone-700 transition-all duration-300">
                            <?php echo nl2br(htmlspecialchars(html_entity_decode($projet['argumentaire']))); ?>
                        </div>
                        <button class="toggle-btn hidden text-sm text-[#DB9ECF] mt-3">Lire plus</button>
                    </div>

                    <div class="tab-content hidden" id="problemes">
                        <div class="text-block overflow-hidden max-h-[180px] leading-relaxed text-stone-700 transition-all duration-300">
                            <?php echo nl2br(htmlspecialchars(html_entity_decode($projet['apprentissageCritique']))); ?>
                        </div>
                        <button class="toggle-btn hidden text-sm text-[#DB9ECF] mt-3">Lire plus</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="space-y-6">

            <section class="rounded-2xl bg-white p-6 shadow-sm border">
                <h3 class="text-lg font-semibold text-[#DB9ECF] mb-3">Compétences</h3>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($competences as $competence) { ?>
                        <span class="bg-[#F7F5EE] px-3 py-1 rounded-full text-sm">
                            <?php echo htmlspecialchars($competence['nom']); ?>
                        </span>
                    <?php } ?>
                </div>
            </section>

            <section class="rounded-2xl bg-white p-6 shadow-sm border">
                <h3 class="text-lg font-semibold text-[#DB9ECF] mb-3">Logiciels</h3>

                <div class="flex flex-wrap gap-3 mb-4">
                    <?php foreach ($logiciels as $logiciel) { ?>
                        <img src="<?php echo html_entity_decode($logiciel['url_img']); ?>" class="h-10">
                    <?php } ?>
                </div>

                <p class="text-sm text-stone-600">Date : <?php echo $projet['date']; ?></p>
                <p class="text-sm text-stone-600">Création : <?php echo $projet['dateCrea']; ?></p>
            </section>

        </div>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {

    /* ======================
       CARROUSEL
    ====================== */
    let currentIndex = 0;
    const carousel = document.getElementById('carousel');

    if (carousel) {
        const totalImages = carousel.children.length;

        window.moveCarousel = function(direction) {
            currentIndex = (currentIndex + direction + totalImages) % totalImages;
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        };
    }

    /* ======================
       FONCTION LIRE PLUS
    ====================== */
    function initReadMore(container) {
        const blocks = container.querySelectorAll(".text-block");

        blocks.forEach((block) => {
            const button = block.nextElementSibling;

            if (!button) return;

            // reset
            block.style.maxHeight = "180px";
            button.classList.add("hidden");

            // attendre le rendu
            requestAnimationFrame(() => {
                if (block.scrollHeight > 180) {
                    button.classList.remove("hidden");
                }
            });

            let expanded = false;

            button.onclick = () => {
                expanded = !expanded;

                if (expanded) {
                    block.style.maxHeight = block.scrollHeight + "px";
                    button.textContent = "Lire moins";
                } else {
                    block.style.maxHeight = "180px";
                    button.textContent = "Lire plus";
                }
            };
        });
    }

    /* ======================
       TABS
    ====================== */
    const buttons = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    // init premier onglet visible
    const firstTab = document.getElementById("description");
    if (firstTab) {
        initReadMore(firstTab);
    }

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {

            buttons.forEach(b => {
                b.classList.remove("border-[#DB9ECF]", "text-[#DB9ECF]", "border-b-2");
                b.classList.add("text-stone-500");
            });

            contents.forEach(c => c.classList.add("hidden"));

            btn.classList.add("border-[#DB9ECF]", "text-[#DB9ECF]", "border-b-2");

            const activeTab = document.getElementById(btn.dataset.tab);
            activeTab.classList.remove("hidden");

            initReadMore(activeTab);
        });
    });

});
</script>
