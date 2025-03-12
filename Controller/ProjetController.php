<?php
// controllers/ProjetController.php
require_once 'Controller.php';
require_once 'Modeles/Projet.php';

class ProjetController extends Controller {

    public function index() {
        $projetModel = new Projet();
        $projets = $projetModel->getAllProjets();
        $this->render('projet', ['projets' => $projets]);
    }
    
    public function show($id) {
        $projetModel = new Projet();
        $projet = $projetModel->getProjetById($id);
        if ($projet) {
            $this->render('projet_detail', ['projet' => $projet]);
        } else {
            echo "Projet non trouvé";
        }
    }
}