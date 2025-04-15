<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de moi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Braah+One&family=Cantarell:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>


<body class="max-w-[1440px] mx-auto min-h-screen flex flex-col">
    <?php include 'header.php'; ?>
    <main class="container mx-auto p-4 flex flex-col md:flex-row items-start gap-3">
        <div>
            <img class="h-[300px] w-auto object-cover" src="../public/img/PostMe.png" alt="">
        </div>
        <div class="container mx-auto p-4 flex flex-col md:flex-col gap-10">
            <h1 class="text-2xl md:text-3xl font-bold">EL YEBDRI Yousra
                <hr class="flex-grow w-[250px] border-t border-stone-700 mt-3">
            </h1>

            <div>
                <h2 class="text-black text-2xl mb-8">Parcours professionel</h2>
                <div class="container mx-auto p-4 flex flex-row md:flex-row gap-5">
                    <div class="flex items-start">
                        <div class="h-80 w-[1px] border-l border-stone-700"></div>
                        <div class="w-5 h-5 bg-stone-700"></div>
                    </div>
                    <div>
                        <h2 class="font-['Cantarell',sans-serif] font-normal text-black text-2xl">APPRENTIE RESPONSABLE INFORMATIQUE LABORATOIRE</h2>
                        <h3 class="font-['Cantarell',sans-serif] text-[#6F6C6C] text-sm">LE LABORATOIRE D’ANALYSE, DE SURVEILLANCE ET D’EXPERTISE DE LA MARINE (LASEM)</h3>
                        <div class="max-w-[379px] mt-5">
                            <p class="text-base"><strong>Refonte d’interface (GED) :</strong> UX/UI, ergonomie, accessibilité. <br>

                                <strong>Automatisation de workflows :</strong> digitalisation, optimisation des processus.<br>

                                <strong>Développement VBA :</strong> automatisation, scripts, traitement de données.<br>

                                <strong>Reporting (JasperSoft iReport) :</strong> BI, SQL, extraction de données.<br>

                                <strong>SO 17025 :</strong> normes qualité, conformité.<br>

                                <strong>Accréditation COFRAC :</strong> audit, réglementation.<br>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="m-0 relative">
                <h2 class="text-black text-2xl mb-8">Formations</h2>

                <!-- Bloc 1 + ligne qui dépasse vers le bas -->
                <div class="container mx-auto p-4 flex flex-row gap-5 relative">
                    <div class="flex items-start gap-2 relative">
                        <!-- Ligne verticale qui déborde vers le bas -->
                        <div class="absolute top-0 w-[1px] h-[550px] bg-stone-700"></div>
                        <!-- Le point sur la ligne -->
                        <div class="w-5 h-5 bg-stone-700 mt-1 z-10"></div>
                    </div>
                    <div>
                        <h2 class="font-['Cantarell',sans-serif] text-black text-2xl">
                            BUT Métiers du Multimédia et de l’Internet - En cours
                        </h2>
                        <h3 class="font-['Cantarell',sans-serif] text-[#6F6C6C] text-sm">IUT TOULON</h3>
                        <div class="max-w-[379px]">
                            <p class="text-base mt-5">
                                <strong>Développement web :</strong> site vitrine, UX/UI, intégration, SEO, PHP, JS.<br>
                                <strong>Gestion de projet :</strong> audit, stratégie digitale, recommandations.<br>
                                <strong>Création de contenu :</strong> vidéo, storytelling, tournage, montage, interviews.<br><br>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bloc 2 (classique, sans ligne) -->
                <div class="container mx-auto p-4 flex flex-row gap-5">
                    <div class="flex items-start gap-2">
                        <div class="w-5 h-5 bg-stone-700 mt-1"></div>
                    </div>
                    <div>
                        <h2 class="font-['Cantarell',sans-serif] text-black text-2xl">
                            BTS Services Informatiques aux Organisations - 2022/2024
                        </h2>
                        <h3 class="font-['Cantarell',sans-serif] text-[#6F6C6C] text-sm">LYCÉE BONAPARTE</h3>
                        <div class="max-w-[374px]">
                            <p class="text-base mt-5">
                                <strong>Développement web : </strong>site vitrine (HTML, CSS, JavaScript), Portfolio (Bootstrap).<br>
                                <strong>Back-end : </strong> application de gestion des frais (PHP, SQL), Symfony, Twig, POO (PHP, Java).<br>
                                <strong>Base de données :</strong> conception et manipulation (SQL).<br>
                                <strong>Gestion de version :</strong> Git, GitHub/GitLab.<br>
                                <strong>Certifications :</strong> compétences numériques validées.<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-10">Compétences
                    <hr class="flex-grow w-[200px] border-t border-stone-700 mt-3">
                </h2>
                <p><strong>Développement Web</strong><br>
                    • Programmation : PHP, SQL, Java, JavaScript <br>
                    • Front-end : HTML, CSS, Bootstrap <br>
                    • Back-end : Symfony, Twig, Programmation Orientée Objet (PHP, Java) <br>
                    • Base de données : Conception et manipulation (SQL) <br><br>

                    <strong>Environnement de Développement & Gestion de Version</strong> <br>
                    • Serveurs & Conteneurs : MAMP, WAMP, Docker<br>
                    • Gestion de version : Git, GitHub, GitLab <br><br>

                    <strong>Systèmes d’exploitation</strong><br>
                    • Windows, Linux (Debian)<br><br>

                    <strong>UI/UX & Design</strong><br>
                    • Outils : Figma, Suite Adobe<br>
                    • Compétences : UX/UI, ergonomie, accessibilité <br></p>
            </div>
            <a href="index.php?page=projet" class="bg-[#DB9ECF] text-white p-5 w-[150px] rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8" >En savoir plus</a>
        </div>
        


    </main>
    <?php include 'footer.php'; ?>
</body>

</html>