<?php
// controllers/AboutController.php

namespace Controller;

use Modeles\About;

class AboutController extends Controller
{

    public function index()
    {
        $aboutModel = new About();
        $this->render('about', [
            'parcours'    => $aboutModel->getAllParcours(),
            'formations'  => $aboutModel->getAllFormations(),
            'competences' => $aboutModel->getAllCompetences(),
        ]);
    }

    // Petite sécurité : admin uniquement
    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['idRole'] != 1) {
            header('Location: index.php?page=about');
            exit;
        }
    }

    /**
     * Nettoyage "doux" : on enlève juste les balises HTML (anti-XSS)
     * SANS encoder les apostrophes ni casser les retours à la ligne.
     * L'échappement se fait à l'affichage avec htmlspecialchars().
     */
    private function clean($value)
    {
        $value = $_POST[$value] ?? '';
        // strip_tags enlève le HTML mais garde \n, apostrophes, accents intacts
        $value = strip_tags($value);
        // Normaliser les fins de ligne en \n simple
        $value = str_replace(["\r\n", "\r"], "\n", $value);
        return trim($value);
    }

    // ============ PARCOURS ============
    public function saveParcours()
    {
        $this->checkAdmin();
        $id          = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $poste       = $this->clean('poste');
        $entreprise  = $this->clean('entreprise');
        $periode     = $this->clean('periode');
        $missions    = $this->clean('missions');

        $aboutModel = new About();
        if (!empty($id)) {
            $aboutModel->updateParcours($id, $poste, $entreprise, $periode, $missions);
        } else {
            $aboutModel->addParcours($poste, $entreprise, $periode, $missions);
        }
        header('Location: index.php?page=about#parcours');
        exit;
    }

    public function deleteParcours()
    {
        $this->checkAdmin();
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($id)) {
            (new About())->deleteParcours($id);
        }
        header('Location: index.php?page=about#parcours');
        exit;
    }

    // ============ FORMATIONS ============
    public function saveFormation()
    {
        $this->checkAdmin();
        $id            = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $titre         = $this->clean('titre');
        $etablissement = $this->clean('etablissement');
        $contenu       = $this->clean('contenu');

        $aboutModel = new About();
        if (!empty($id)) {
            $aboutModel->updateFormation($id, $titre, $etablissement, $contenu);
        } else {
            $aboutModel->addFormation($titre, $etablissement, $contenu);
        }
        header('Location: index.php?page=about#formations');
        exit;
    }

    public function deleteFormation()
    {
        $this->checkAdmin();
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($id)) {
            (new About())->deleteFormation($id);
        }
        header('Location: index.php?page=about#formations');
        exit;
    }

    // ============ COMPÉTENCES ============
    public function saveCompetence()
    {
        $this->checkAdmin();
        $id        = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $categorie = $this->clean('categorie');
        $details   = $this->clean('details');

        $aboutModel = new About();
        if (!empty($id)) {
            $aboutModel->updateCompetence($id, $categorie, $details);
        } else {
            $aboutModel->addCompetence($categorie, $details);
        }
        header('Location: index.php?page=about#competences');
        exit;
    }

    public function deleteCompetence()
    {
        $this->checkAdmin();
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($id)) {
            (new About())->deleteCompetence($id);
        }
        header('Location: index.php?page=about#competences');
        exit;
    }
}