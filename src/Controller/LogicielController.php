<?php

namespace Controller;

use Modeles\Image;
use Modeles\Logiciel;

class LogicielController extends Controller
{

    public function index()
    {
        $this->render('admin/add_logiciel');
    }

    public function create()
    {
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->loadImage($nom);
        header("Location: index.php?page=logiciel");
    }

    /**
     * 🆕 Variante AJAX : crée un logiciel et renvoie du JSON au lieu de rediriger.
     * Appelée depuis la modale d'ajout de projet.
     */
    public function create_ajax()
    {
        header('Content-Type: application/json');

        // Sécurité : admin uniquement
        if (!isset($_SESSION['user']) || $_SESSION['user']['idRole'] != 1) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Non autorisé']);
            exit;
        }

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($nom)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Nom requis']);
            exit;
        }

        // Vérifier que le logiciel n'existe pas déjà
        $logicielModel = new Logiciel();
        $existant = $logicielModel->getLogicielByName($nom);
        if ($existant) {
            echo json_encode(['success' => false, 'message' => 'Ce logiciel existe déjà']);
            exit;
        }

        // Upload de l'image (réutilise la logique existante, version nettoyée)
        $url_img = $this->loadImageAjax($nom);
        if ($url_img === false) {
            echo json_encode(['success' => false, 'message' => 'Erreur upload image (format ou fichier invalide)']);
            exit;
        }

        // On récupère le logiciel fraîchement créé pour renvoyer son ID
        $nouveau = $logicielModel->getLogicielByName($nom);
        if (!$nouveau) {
            echo json_encode(['success' => false, 'message' => 'Erreur de création en base']);
            exit;
        }

        echo json_encode([
            'success' => true,
            'logiciel' => [
                'id' => $nouveau['id'],
                'nom' => $nouveau['nomLogiciel'],
                'urlimg' => $nouveau['urlimg'] ?? $url_img,
            ]
        ]);
        exit;
    }

    /**
     * 🆕 Version nettoyée de loadImage qui retourne le chemin (ou false en cas d'échec),
     * avec sanitization des noms de fichiers (accents, apostrophes...).
     */
    private function loadImageAjax($name)
    {
        if (empty($_FILES['image']['name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $files_paths = "./storage/logiciel_img/";
        $nom_original = $_FILES["image"]["name"];

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
            $nom_propre = 'logo_' . uniqid();
        }

        $extensions_ok = ["jpg", "png", "jpeg", "svg", "ico", "webp"];
        if (!in_array($extension, $extensions_ok)) {
            return false;
        }

        $nom_final = $nom_propre . '_' . time() . '.' . $extension;
        $nom_fichier = $files_paths . $nom_final;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $nom_fichier)) {
            return false;
        }

        $logiciel = new Logiciel();
        $logiciel->addLogiciel($name, $nom_fichier);

        return $nom_fichier;
    }

    private function loadImage($name)
    {
        $logiciel = new Logiciel();
        $id = $logiciel->getLogicielByName($name);
        $files_paths = "./storage/logiciel_img/";
        $nom_fichier = $files_paths . basename($_FILES["image"]["name"]);
        $type_fichier = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        if ($type_fichier == "jpg" || $type_fichier == "png" || $type_fichier == "jpeg" || $type_fichier == "svg" || $type_fichier == "ico" || $type_fichier == "webp") {
            if (!file_exists($nom_fichier)) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $nom_fichier);
                $logiciel->addLogiciel($name, $nom_fichier);
            } else {
                $logiciel->addLogiciel($name, $nom_fichier);
            }
        } else {
            $logiciel->deleteLogicielById($id);
        }
    }
}