<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Mon Portfolio</title>
  <link rel="shortcut icon" href="public/img/PostMe.png" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Braah+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Braah+One&family=Cantarell:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
</head>

<body class="max-w-[1440px] mx-auto min-h-screen flex flex-col">
  <?php include 'header.php'; ?>
  <main class="container mx-auto p-4 flex flex-col md:flex-row items-center gap-3">
    <!-- Conteneur de l'image avec hauteur fixe et overflow-hidden -->
    <div class="w-full md:w-auto h-[500px] md:h-[700px] overflow-hidden">
      <!-- L'image prend toute la largeur et la hauteur du conteneur, avec object-cover pour un recadrage automatique -->
      <img class="w-full h-full object-cover" src="../public/img/PostMe.png" alt="">
    </div>
    <div>
      <h1 class="text-5xl md:text-9xl font-bold">PORTFOLIO</h1>
      <div class="flex items-center space-x-4">
        <hr class="flex-grow border-t border-stone-700">
        <p class="text-3xl md:text-5xl text-stone-700">2025</p>
      </div>
      <p class="text-lg md:text-2xl text-gray-800 mb-10">
        <?php echo $message; ?>
      </p>
      <a href="index.php?page=about" class="bg-[#DB9ECF] text-white p-5 w-[50%] rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8">En savoir plus</a>
      
    </div>
  </main>
  <footer class="mt-auto">
    <?php include 'footer.php'; ?>
  </footer>
</body>

</html>