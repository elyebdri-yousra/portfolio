<?php
require_once 'Model.php';

class Projet extends Model {

    // Je récupère tous les projets
    public function getAllProjets() {
        $req = $this->pdo->prepare("SELECT * FROM projet ORDER BY dateCrea DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Je récupère un projet selon son ID
    public function getProjetById($id) {
        $req = $this->pdo->prepare("SELECT * FROM projet WHERE id = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addProjet($titre, $description, $urlimg, $date, $annee_but, $apprentissage, $competence, $type, $argumentaire, $commentaires, $idUser) {
        $req = $this->pdo->prepare("
            INSERT INTO projet (titre, description, urlimg, date, dateCrea, pbSl, idUser) 
            VALUES (?, ?, ?, ?, NOW(), ?, ?)
        ");
    
        return $req->execute([
            $titre, $description, $urlimg, $date, $annee_but, $apprentissage, $competence, $type, $argumentaire, $commentaires, $idUser
        ]);
    }

    
}