<?php

namespace Controller;

// controllers/ProjetController.php
use Modeles\Projet;
use Modeles\Image;
use Controller\ErrorController;
use Exception;
use Modeles\Commentaire;
use Modeles\Competence;
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
        $competenceModel = new Competence();
        $competences = $competenceModel->getAllCompetence();
        $nb_projet = count($projets);
        for ($i = 0; $i < $nb_projet; $i++) {
            $urlimg = $projetModel->getThumbnailById($projets[$i]['id']);
            $projets[$i]['urlimg'] = $urlimg['img_path'] ?? "";
            $projets[$i]['competences'] = $competenceModel->getCompetenceByProjet($projets[$i]['id']);
        }
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
        $this->render('projet', ['projets' => $projets, 'logiciels' => $logiciels, 'competences' => $competences]);
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
        $competenceModel = new Competence();
        $competences = $competenceModel->getCompetenceByProjet($id);
        if ($projet) {
            $this->render('projet_detail', ['projet' => $projet, 'logiciels' => $logiciels, 'images' => $images, 'commentaires' => $commentaires, 'competences' => $competences, 'user_id' => $_SESSION['user']['id'] ?? null]);
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

    public function editProjet($id)
    {
        $projetModel = new Projet();
        $projet = $projetModel->getProjetById($id);
        $imageModel = new Image();
        $images = $imageModel->getAllImageByProjectId($id);
        $commentairesModel = new Commentaire();
        $commentaires = $commentairesModel->getAllCommentaireByProjectId($id);
        $logicielModel = new Logiciel();
        $competenceModel = new Competence();

        $logiciels = $logicielModel->getLogicielByProject($id);
        $competences = $competenceModel->getCompetenceByProjet($id);
        $otherLogiciels = $logicielModel->getAllLogiciel();
        $otherCompetences = $competenceModel->getAllCompetence();
        $logiciels = $this->checkUsed($logiciels, $otherLogiciels);
        $competences = $this->checkUsed($competences, $otherCompetences);
        if ($projet) {
            $this->render('projet_edit', ['projet' => $projet, 'logiciels' => $logiciels, 'images' => $images, 'commentaires' => $commentaires, 'competences' => $competences, 'user_id' => $_SESSION['user']['id'] ?? null]);
        } else {
            $this->error->index();
        }
    }

    // Cette fonction permet de mettre un 1 si un élément est déjà utilisé par un projet.
    // En gros : je prends tous les logiciels de la bdd, et je regarde si le projet l'a déjà.
    // Si il l'a déjà je met un 1 sinon je met un 0
    public function checkUsed($used, $notUsed)
    {
        for ($i = 0; $i < count($notUsed); $i++) {
            foreach ($used as $thing) {
                if ($notUsed[$i]['id'] == $thing['id']) {
                    $notUsed[$i]['checked'] = 1;
                    break;
                }
            }
        }
        return $notUsed;
    }


    public function delete_img()
    {
        $id = filter_input(INPUT_POST, 'projet_id', FILTER_SANITIZE_NUMBER_INT);
        $image_nom = filter_input(INPUT_POST, 'image_id', FILTER_SANITIZE_SPECIAL_CHARS);
        $imageModel = new Image();
        $images = $imageModel->getAllImageByProjectId($id);

        foreach ($images as $image) {
            if ($image['img_path'] == "./storage/projects_img/" . $image_nom) {
                $imageModel->deleteUniqueImageByProjectId($id, $image_nom);
                break;
            }
        }
        $this->editProjet($id);
    }

    public function ajoute_img()
    {
        $id = filter_input(INPUT_POST, 'projet_id', FILTER_SANITIZE_NUMBER_INT);
        $projetModel = new Projet();
        $projet = $projetModel->getProjetById($id);
        $this->loadImage($projet['titre'], $projet['date'], $projet['dateCrea'], $projet['typeProjet']);
        $this->editProjet($id);
    }

    public function update_projet()
    {
        $id = filter_input(INPUT_POST, 'id_projet', FILTER_SANITIZE_NUMBER_INT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $annee_but = filter_input(INPUT_POST, 'annee_but', FILTER_SANITIZE_SPECIAL_CHARS);
        $apprentissage = filter_input(INPUT_POST, 'apprentissage', FILTER_SANITIZE_SPECIAL_CHARS);
        $argumentaire = filter_input(INPUT_POST, 'argumentaire', FILTER_SANITIZE_SPECIAL_CHARS);


        $logiciels = filter_input_array(INPUT_POST, [
            'logiciels' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_REQUIRE_ARRAY
            ]
        ]);

        $competences = filter_input_array(INPUT_POST, [
            'competences' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_REQUIRE_ARRAY
            ]
        ]);


        $modelProjet = new Projet();

        $this->retriveCompetenceById($id, $competences);
        $this->retriveLogicielById($id, $logiciels);


        $modelProjet->update_projet($description, $date, $annee_but, $apprentissage, $argumentaire, $id);

        $this->editProjet($id);
    }



    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtrage des entrées utilisateur
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $annee_but = filter_input(INPUT_POST, 'annee_but', FILTER_SANITIZE_SPECIAL_CHARS);
            $apprentissage = filter_input(INPUT_POST, 'apprentissage', FILTER_SANITIZE_SPECIAL_CHARS);
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

            $competences = filter_input_array(INPUT_POST, [
                'competences' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_REQUIRE_ARRAY
                ]
            ]);


            $projetModel = new Projet();
            $success = $projetModel->addProjet($titre, $description, $date, $annee_but, $apprentissage, $type, $argumentaire, $idUser);

            // Fonction pour associer les logiciels et les projets

            if ($success) {
                $this->loadImage($titre, $date, $annee_but, $type);
                $this->retriveLogiciel($titre, $date, $annee_but, $type, $logiciels);
                $this->retriveCompetence($titre, $date, $annee_but, $type, $competences);

                header('Location: index.php?page=projet');
                exit;
            } else {
                $this->error->index();
            }
        }
    }

    public function retriveCompetenceById($id_projet, $competences)
    {
        $competenceModel = new Competence();
        $competenceModel->desassociateAllProjetCompetence($id_projet);
        if ($competences['competences'] != null) {

            foreach ($competences['competences'] as $id) {
                $competence = $competenceModel->getCompetenceById($id);
                if ($competence) {

                    $competenceModel->associateProjetCompetence($id_projet, $competence['id']);
                }
            }
        }
    }

    public function retriveCompetence($titre, $date, $annee_but, $type, $competences)
    {
        $projetModel = new Projet();
        $projet_id = $projetModel->getProjetByCol($titre, $date, $annee_but, $type);

        $competenceModel = new Competence();
        $competenceModel->desassociateAllProjetCompetence($projet_id);
        if ($competences['competences'] != null) {

            foreach ($competences['competences'] as $id) {
                $competence = $competenceModel->getCompetenceById($id);
                if ($competence) {

                    $competenceModel->associateProjetCompetence($projet_id, $competence['id']);
                }
            }
        }
    }

    public function retriveLogicielById($id_projet, $logiciels)
    {
        $logicielModel = new Logiciel();
        $logicielModel->desassociateAllProjetLogiciel($id_projet);
        if ($logiciels['logiciels'] != null) {
            foreach ($logiciels['logiciels'] as $id) {
                $logiciel = $logicielModel->getLogicielById($id);
                if ($logiciel) {
                    $logicielModel->associateProjetLogiciel($id_projet, $id, $logiciel['urlimg']);
                }
            }
        }
    }

    public function retriveLogiciel($titre, $date, $annee_but, $type, $logiciels)
    {
        $projetModel = new Projet();
        $projet_id = $projetModel->getProjetByCol($titre, $date, $annee_but, $type);


        $logicielModel = new Logiciel();
        $logicielModel->desassociateAllProjetLogiciel($projet_id);
        if ($logiciels['logiciels'] != null) {

            foreach ($logiciels['logiciels'] as $id) {
                $logiciel = $logicielModel->getLogicielById($id);
                if ($logiciel) {
                    $logicielModel->associateProjetLogiciel($projet_id, $id, $logiciel['urlimg']);
                }
            }
        }
    }
}
