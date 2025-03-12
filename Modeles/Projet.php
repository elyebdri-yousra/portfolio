<?php
require_once 'Model.php';

class Projet extends Model {

    // Je récupère tous les projets
    public function getAllProjets() {
        $stmt = $this->pdo->prepare("SELECT * FROM projet ORDER BY dateCrea DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Je récupère un projet selon son ID
    public function getProjetById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM projet WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}