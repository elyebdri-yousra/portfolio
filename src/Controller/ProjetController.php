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

        $competenceModel = new Competence();
        $competences = $competenceModel->getAllCompetence();

        $nb_projet = count($projets);

        for ($i = 0; $i < $nb_projet; $i++) {
            $urlimg = $projetModel->getThumbnailById($projets[$i]['id']);
            $projets[$i]['urlimg'] = $urlimg['img_path'] ?? "";

            $projets[$i]['competences'] = $competenceModel->getCompetenceByProjet($projets[$i]['id']);
            $projets[$i]['logiciels'] = $logicielModel->getLogicielByProject($projets[$i]['id']);
        }

        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }

        $this->render('projet', [
            'projets' => $projets,
            'logiciels' => $logiciels,
            'competences' => $competences
        ]);
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

    public function supprimer(int $id)
    {
        $projetModel = new Projet();
        $imagesModel = new Image();
        if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) {
            $images = $imagesModel->getAllImageByProjectId($id);
            foreach ($images as $image) {
                if (file_exists($image['img_path'])) {
                    unlink($image['img_path']);
                }
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


    private function loadImage($titre, $date, $annee_but, $type)
    {
        $image = new Image();
        $projet = new Projet();
        $id = $projet->getProjetByCol($titre, $date, $annee_but, $type);

        if (empty($_FILES['images']['name'][0])) {
            return;
        }

        $files_paths = "./storage/projects_img/";
        $nombre_images = count($_FILES['images']['name']);

        for ($i = 0; $i < $nombre_images; $i++) {

            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            // 🔧 NETTOYAGE DU NOM DE FICHIER
            $nom_original = $_FILES["images"]["name"][$i];

            if (class_exists('Normalizer')) {
                $nom_original = \Normalizer::normalize($nom_original, \Normalizer::FORM_C);
            }

            $extension = strtolower(pathinfo($nom_original, PATHINFO_EXTENSION));
            $nom_sans_ext = pathinfo($nom_original, PATHINFO_FILENAME);

            $nom_propre = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $nom_sans_ext);
            if ($nom_propre === false) {
                $nom_propre = $nom_sans_ext;
            }
            $nom_propre = preg_replace('/[^A-Za-z0-9_-]/', '_', $nom_propre);
            $nom_propre = preg_replace('/_+/', '_', $nom_propre);
            $nom_propre = trim($nom_propre, '_');

            if (empty($nom_propre)) {
                $nom_propre = 'image_' . uniqid();
            }

            $nom_final = $nom_propre . '_' . time() . '_' . $i . '.' . $extension;
            $nom_fichier = $files_paths . $nom_final;

            $check = getimagesize($_FILES["images"]["tmp_name"][$i]);
            $is_uploaded = 0;

            if ($check !== false) {
                if (in_array($extension, ["jpg", "png", "jpeg", "webp"])) {
                    if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $nom_fichier)) {
                        $is_uploaded = 1;
                    }
                } else {
                    continue;
                }
            } else {
                continue;
            }

            if ($is_uploaded == 1) {
                $image->ajoutImage($nom_final, $nom_fichier, $id);
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
                if (file_exists($image['img_path'])) {
                    unlink($image['img_path']);
                }
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

    /**
     * 🆕 Méthode AJAX : reçoit en POST un id_projet + un tableau d'IDs d'images
     * dans l'ordre désiré, et met à jour la colonne `ordre` en base.
     */
    public function reorder_img()
    {
        header('Content-Type: application/json');

        // Sécurité : seuls les admins peuvent réordonner
        if (!isset($_SESSION['user']) || $_SESSION['user']['idRole'] != 1) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Non autorisé']);
            exit;
        }

        $idProjet = filter_input(INPUT_POST, 'projet_id', FILTER_SANITIZE_NUMBER_INT);
        $orderRaw = $_POST['order'] ?? null;

        if (!$idProjet || !is_array($orderRaw) || empty($orderRaw)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Paramètres invalides']);
            exit;
        }

        $orderedIds = array_map('intval', $orderRaw);

        $imageModel = new Image();
        $ok = $imageModel->updateOrder((int) $idProjet, $orderedIds);

        echo json_encode(['success' => $ok]);
        exit;
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
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $annee_but = filter_input(INPUT_POST, 'annee_but', FILTER_SANITIZE_SPECIAL_CHARS);
            $apprentissage = filter_input(INPUT_POST, 'apprentissage', FILTER_SANITIZE_SPECIAL_CHARS);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
            $argumentaire = filter_input(INPUT_POST, 'argumentaire', FILTER_SANITIZE_SPECIAL_CHARS);
            $commentaires = filter_input(INPUT_POST, 'commentaires', FILTER_SANITIZE_SPECIAL_CHARS);
            $idUser = $_SESSION['user']['id'];

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