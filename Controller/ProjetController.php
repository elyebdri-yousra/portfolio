<?php
// controllers/ProjetController.php
require_once 'Controller.php';
require_once 'Modeles/Projet.php';

class ProjetController extends Controller
{
    public function index()
    {
        $projetModel = new Projet();
        $projets = $projetModel->getAllProjets();
        $this->render('projet', ['projets' => $projets]);
    }

    public function show($id)
    {
        $projetModel = new Projet();
        $projet = $projetModel->getProjetById($id);
        if ($projet) {
            $this->render('projet_detail', ['projet' => $projet]);
        } else {
            echo "Projet non trouvé";
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtrage des entrées utilisateur
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $urlimg = filter_input(INPUT_POST, 'urlimg', FILTER_SANITIZE_URL);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee_but = filter_input(INPUT_POST, 'annee_but', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $apprentissage = filter_input(INPUT_POST, 'apprentissage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $competence = filter_input(INPUT_POST, 'competence', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $argumentaire = filter_input(INPUT_POST, 'argumentaire', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $commentaires = filter_input(INPUT_POST, 'commentaires', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idUser = $_SESSION['user']['id']; // Récupérer l'ID utilisateur connecté

            // Vérifier que les champs obligatoires ne sont pas vides
            if (!$titre || !$description || !$date || !$annee_but || !$apprentissage || !$competence || !$type || !$argumentaire) {
                echo "Tous les champs obligatoires doivent être remplis.";
                return;
            }

            $projetModel = new Projet();
            $success = $projetModel->addProjet($titre, $description, $urlimg, $date, $annee_but, $apprentissage, $competence, $type, $argumentaire, $commentaires, $idUser);

            if ($success) {
                header('Location: index.php?page=projet');
                exit;
            } else {
                echo "Erreur lors de l'ajout du projet.";
            }
        }
    }
}