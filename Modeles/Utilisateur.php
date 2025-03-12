<?php

require_once 'Model.php';

class Utilisateur extends Model {

    // Je récupère un utilisateur à partir de son email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // J'insère un nouvel utilisateur (inscription d'un évaluateur)
    public function createUser($nom, $prenom, $email, $mdp, $idRole) {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, idRole) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nom, $prenom, $email, $mdp, $idRole]);
    }

    // Je récupère tous les utilisateurs (pour gestion par l'ADMIN)
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM utilisateur");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Je mets à jour un utilisateur
    public function updateUser($id, $nom, $prenom, $email, $idRole) {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, idRole = ? WHERE id = ?");
        return $stmt->execute([$nom, $prenom, $email, $idRole, $id]);
    }

    // Je supprime un utilisateur
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateur WHERE id = ?");
        return $stmt->execute([$id]);
    }
}