<?php

namespace Controller;

// controllers/ProjetController.php
use Modeles\Projet;
use Modeles\Image;
use Controller\ErrorController;
use Exception;
use Modeles\Commentaire;
use Modeles\Logiciel;

class ProjetController extends Controller
{

    private $error;

    public function __construct()
    {
        $this->error = new ErrorController();
    }

    public function index()
    {
        $projetModel = new Projet();
        $projets = $projetModel->getAllProjets();

        $logicielModel = new Logiciel();
        $logiciels = $logicielModel->getAllLogiciel();
        // Je veux une image pour présenter le projet -> Thumbnail.
        // Je récupère le projet, c'est un array, j'y ajoute urlimg pour lui donner le lieu de la première image
        $nb_projet = count($projets);
        for ($i = 0; $i < $nb_projet; $i++) {
            $urlimg = $projetModel->getThumbnailById($projets[$i]['id']);
            $projets[$i]['urlimg'] = $urlimg['img_path'] ?? "";
        }
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
        $this->render('projet', ['projets' => $projets, 'logiciels' => $logiciels]);
    }

    public function show($id)
    {
        $projetModel = new Projet();
        $projet = $projetModel->getProjetById($id);
        $imageModel = new Image();
        $images = $imageModel->getAllImageByProjectId($id);
        $commentairesModel = new Commentaire();
        $commentaires = $commentairesModel->getAllCommentaireByProjectId($id);
        $logicielModel = new Logiciel();
        $logiciels = $logicielModel->getLogicielByProject($id);
        if ($projet) {
            $this->render('projet_detail', ['projet' => $projet, 'logiciels' => $logiciels ,'images' => $images, 'commentaires' => $commentaires, 'user_id' => $_SESSION['user']['id'] ?? null]);
        } else {
            $this->error->index();
        }
    }

    /**
     * Fonction pour supprimer un projet
     *
     * @param int $id
     * @return void
     */
    public function supprimer(int $id)
    {
        $projetModel = new Projet();
        $imagesModel = new Image();
        if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) {
            $images = $imagesModel->getAllImageByProjectId($id);
            foreach ($images as $image) {
                unlink($image['img_path']);
            }
            $projetModel->deleteProjetById($id);
            $this->index();
        } else {
            $this->error->index();
        }
    }

    public function addCommentaire()
    {
        $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);
        $projet_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $user_id = $_SESSION['user']['id'];
        if (isset($_SESSION['user']) && (($_SESSION['user']['idRole'] == 1) || ($_SESSION['user']['idRole'] == 2))) {
            try {

                $commentaireModel = new Commentaire();
                $commentaireModel->addCommentaire($projet_id, $user_id, $commentaire);
                header('Location: index.php?page=projet_show&id=' . $projet_id . '#commentaire');
            } catch (Exception $e) {
                $this->error->index();
            }
        } else {
            $this->error->index();
        }
    }



    // Si tu ne mettais qu'une seule image par projet, la fonction ne serait pas obligatoire.
    // Comme il y en à plusieurs (2, 3, 4, 9, 27), il faut créer une fonction qui enregistre toutes ces images
    private function loadImage($titre, $date, $annee_but, $type)
    {

        $image = new Image(); // Le model qui vas servir à enregistrer

        // Il faut que je récupère l'Id du projet dans lequel je dois inserer les images
        $projet = new Projet();
        $id = $projet->getProjetByCol($titre, $date, $annee_but, $type);
        // Pour accéder aux images, avec php il existe $_FILES -> Qui contient toutes les images
        // Source pour comprendre https://www.w3schools.com/php/php_file_upload.asp
        $files_paths = "./storage/projects_img/"; // l'endroit ou ranger les images
        // Quand tu envoies un fichier depuis ton PC vers le site web, c'est le site web qui garde l'image dans 
        // son stockage. Donc toutes les images iront dans se dossier.
        // !!!!!!!!!! Pour pas alourdir le code, y'a l'explication en bas !!!!!!!!! \\    

        // Avant de commencer ma boucle je dois connaitre le nombre d'image que j'ai envoyé à l'application.
        // Il existe bcp de technique mais la plus simple est de compter les noms
        $nombre_images = count($_FILES['images']['name']);
        // A partir de maintenant je peux commencer ma boucle. Pour rappel mon but est de récupérer le nom, le type, full_path etc etc
        // Donc pour ma boucle je me place dans $_FILES['images']
        // Si tu te demande quel type de boucle il faut utiliser, ici il est plus intelligent d'utiliser une boucle for et pas une foreach. Comme j'accèdes à des données qui sont dans un tableau, ca m'évitera de faire bcp de boucle
        for ($i = 0; $i < $nombre_images; $i++) {
            $nom_fichier = $files_paths . basename($_FILES["images"]["name"][$i]); // nom_fichier c'est le nom de ton
            $type_fichier = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION)); // Permet de prendre le type de fichier pour vérifier si c'est une image
            $check = getimagesize($_FILES["images"]["tmp_name"][$i]); // Permet de vérifier la taille de l'image
            $is_uploaded = 0;
            if ($check !== false) {
                if ($type_fichier == "jpg" || $type_fichier == "png" || $type_fichier == "jpeg") { // On vérifie le type de fichier
                    if (!file_exists($nom_fichier)) {
                        move_uploaded_file($_FILES["images"]["tmp_name"][$i], $nom_fichier);
                        $is_uploaded = 1;
                    } else {
                        $is_uploaded = 1;
                    }
                } else {
                    $projet->deleteProjetById($id);
                }
            } else {
                $projet->deleteProjetById($id);
            }
            if ($is_uploaded == 1) {
                $image->ajoutImage(basename($_FILES["images"]["name"][$i]), $nom_fichier, $id);
            }
        }
    }




    public function add()
    {
        // fichier avec l'endroit ou il est enregistrer. Si le nom c'est bapt : ../storage/projects_img/bapt.png
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtrage des entrées utilisateur
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $annee_but = filter_input(INPUT_POST, 'annee_but', FILTER_SANITIZE_SPECIAL_CHARS);
            $apprentissage = filter_input(INPUT_POST, 'apprentissage', FILTER_SANITIZE_SPECIAL_CHARS);
            $competence = filter_input(INPUT_POST, 'competence', FILTER_SANITIZE_SPECIAL_CHARS);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
            $argumentaire = filter_input(INPUT_POST, 'argumentaire', FILTER_SANITIZE_SPECIAL_CHARS);
            $commentaires = filter_input(INPUT_POST, 'commentaires', FILTER_SANITIZE_SPECIAL_CHARS);
            $idUser = $_SESSION['user']['id']; // Récupérer l'ID utilisateur connecté

            $logiciels = filter_input_array(INPUT_POST, [
                'logiciels' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_REQUIRE_ARRAY
                ]
            ]);


            // Vérifier que les champs obligatoires ne sont pas vides
            if (!$titre || !$description || !$date || !$annee_but || !$apprentissage || !$competence || !$type || !$argumentaire) {
                echo "Tous les champs obligatoires doivent être remplis.";
                return;
            }
            $projetModel = new Projet();
            $success = $projetModel->addProjet($titre, $description, $date, $annee_but, $apprentissage, $competence, $type, $argumentaire, $commentaires, $idUser);
            // Fonction pour associer les logiciels et les projets

            if ($success) {
                $this->loadImage($titre, $date, $annee_but, $type);
                $this->retriveLogiciel($titre, $date, $annee_but, $type, $logiciels);
                header('Location: index.php?page=projet');
                exit;
            } else {
                $this->error->index();
            }
        }
    }

    public function retriveLogiciel($titre, $date, $annee_but, $type, $logiciels)
    {
        $projetModel = new Projet();
        $projet_id = $projetModel->getProjetByCol($titre, $date, $annee_but, $type);

        $logicielModel = new Logiciel();

        foreach ($logiciels['logiciels'] as $log) {
            $logiciel = $logicielModel->getLogicielById($log);
            if($logiciel){
                $logicielModel->associateProjetLogiciel($projet_id,$log, $logiciel['urlimg']);
            }
        }
    }
}
/*
Comme je gère plusieurs images et qu'elles sont rangé comme ça :
        array:1 [▼
            "images" => array:6 [▼
                "name" => array:3 [▼
                    0 => "Screenshot 2025-04-02 at 09.43.56.png"
                    1 => "Screenshot 2025-04-02 at 09.44.01.png"
                    2 => "Screenshot 2025-04-07 at 10.42.53.png"
                ]
                "full_path" => array:3 [▼
                    0 => "Screenshot 2025-04-02 at 09.43.56.png"
                    1 => "Screenshot 2025-04-02 at 09.44.01.png"
                    2 => "Screenshot 2025-04-07 at 10.42.53.png"
                ]
                "type" => array:3 [▼
                    0 => "image/png"
                    1 => "image/png"
                    2 => "image/png"
                ]
            ]
        ]

Un tableau qui contient un tableau qui lui meme contient un tableau, le tableau images qui à en lui les noms, les full_path et les types.
Je rappelle que pour accéder aux fichiers j'ai besoin de $_FILES. Donc si je veux voir les informations de mes images
je dois rentrer dans le tableau $_FILES. Pour cela j'écris $_FILES['images] ( ['images'] vient de la page web, du name )

Ce qui donne : 
        array:6 [▼
            "name" => array:3 [▼
                0 => "Screenshot 2025-04-02 at 09.43.56.png"
                1 => "Screenshot 2025-04-02 at 09.44.01.png"
                2 => "Screenshot 2025-04-07 at 10.42.53.png"
            ]
            "full_path" => array:3 [▼
                0 => "Screenshot 2025-04-02 at 09.43.56.png"
                1 => "Screenshot 2025-04-02 at 09.44.01.png"
                2 => "Screenshot 2025-04-07 at 10.42.53.png"
            ]
            "type" => array:3 [▼
                0 => "image/png"
                1 => "image/png"
                2 => "image/png"
            ]
        ]

Donc la je me retrouve avec 3 tableau: nom, full_path et type.
Par exemple si je veux voir tous les name:
$_FILES['images']['name']. Pour le moment j'y accède sans boucle, juste en écrivant à la main ce que je veux récuperer.
Si je veux le nom de la deuxième image j'écris $_FILES['images']['name'][1]

Donc si je résume =

$_FILES['images'] : array:6 [▼
                        "name" => array:3 [▼
                            0 => "Screenshot 2025-04-02 at 09.43.56.png"
                            1 => "Screenshot 2025-04-02 at 09.44.01.png"
                            2 => "Screenshot 2025-04-07 at 10.42.53.png"
                        ]
                        "full_path" => array:3 [▼
                            0 => "Screenshot 2025-04-02 at 09.43.56.png"
                            1 => "Screenshot 2025-04-02 at 09.44.01.png"
                            2 => "Screenshot 2025-04-07 at 10.42.53.png"
                        ]
                        "type" => array:3 [▼
                            0 => "image/png"
                            1 => "image/png"
                            2 => "image/png"
                        ]
                    ]

$_FILES['images']['name'] : "name" => array:3 [▼
                                0 => "Screenshot 2025-04-02 at 09.43.56.png"
                                1 => "Screenshot 2025-04-02 at 09.44.01.png"
                                2 => "Screenshot 2025-04-07 at 10.42.53.png"
                            ]

$_FILES['images']['name'][1] : 1 => "Screenshot 2025-04-02 at 09.44.01.png"


À la main ca donnerait ça, si je veux faire avec une bouclen je dois avoir "i" qui augmente en taille sans dépasser le nombre d'image.
Ca veut qu'au premier tour de boucle, je lis la première image, qu'au deuxième tour de boucle je lis la deuxième, qu'au troisième je lis la troisième etcetc. 

**/