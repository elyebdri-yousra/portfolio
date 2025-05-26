<main class="container mx-auto p-4 flex items-center gap-8 h-full" role="main">
    <div>
        <img
            class="h-[700px] w-auto object-cover"
            src="/assets/img/PostMe.png"
            alt="Portrait de Yousra El Yebdri, développeuse web et designer"
            loading="lazy">
    </div>

    <section aria-label="Introduction du portfolio de Yousra El Yebdri">
        <h1 class="text-9xl font-bold">PORTFOLIO</h1>

        <div class="flex items-center space-x-4">
            <hr class="flex-grow border-t-1 border-stone-700">
            <p class="text-5xl text-stone-700">2025</p>
        </div>

        <p class="text-2xl text-gray-800 mb-10">
            <?php echo $message; ?>
        </p>

        <a
            href="index.php?page=about"
            class="bg-[#DB9ECF] text-white p-5 w-[50%] rounded-xl hover:bg-[#c085b7] transition-colors mt-20 my-8">
            En savoir plus
        </a>
    </section>
</main>