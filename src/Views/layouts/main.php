<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yousra EL YEBDRI - Portfolio développeuse web & étudiante BUT MMI</title>

    <meta name="description" content="Bienvenue sur le portfolio de Yousra EL YEBDRI, développeuse web créative et étudiante en BUT MMI. Découvrez ses projets, compétences, et réalisations.">
    <meta name="author" content="Yousra EL YEBDRI">

    <!-- Open Graph (réseaux sociaux) -->
    <meta property="og:title" content="Yousra EL YEBDRI - Portfolio développeuse web">
    <meta property="og:description" content="Découvrez le portfolio de Yousra EL YEBDRI, développeuse web et étudiante BUT MMI.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://elyebdri-yousra.com">
    <meta property="og:image" content="https://elyebdri-yousra.com/assets/img/preview.png">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Cantarell:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PVWWXMQ6');</script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7CTLNQKT6M"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-7CTLNQKT6M');
    </script>

    <!-- Schema.org (SEO sémantique) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Yousra EL YEBDRI",
      "url": "https://elyebdri-yousra.com",
      "jobTitle": "Étudiante en BUT MMI",
      "sameAs": [
        "https://www.linkedin.com/in/elyebdri-yousra",
        "https://github.com/hosvn1"
      ]
    }
    </script>
</head>

<body class="w-full mx-auto h-screen flex flex-col justify-between overflow-auto scrollbar-none">
    <header>
        <?php require_once __DIR__ . '/header.php'; ?>
    </header>

    <?php echo $content; ?>

    <footer class="mt-auto">
        <?php require_once __DIR__ . '/footer.php'; ?>
    </footer>

    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('menu-mobile');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVWWXMQ6"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
</body>

</html>