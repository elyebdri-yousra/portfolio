<?php

require_once 'Model.php';

class Utilisateur extends Model
{

    // Je récupère un utilisateur à partir de son email
    public function getUserByEmail($email)
    {
        $req = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $req->bindParam(':email', $email, PDO::PARAM_STR); // filtrer la donnée pour la req preparer pour éviter les injections
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC); 
    }

    // J'insère un nouvel utilisateur (inscription d'un évaluateur)
    public function createUser($nom, $prenom, $email, $mdp, $idRole)
    {
        $req = $this->pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, idRole) VALUES (?, ?, ?, ?, ?)");
        return $req->execute([$nom, $prenom, $email, $mdp, $idRole]);
    }

    // Je récupère tous les utilisateurs (pour gestion par l'ADMIN)
    public function getAllUsers()
    {
        $req = $this->pdo->query("SELECT * FROM utilisateur");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // Je mets à jour un utilisateur
    public function updateUser($id, $nom, $prenom, $email, $idRole)
    {
        $req = $this->pdo->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, idRole = ? WHERE id = ?");
        return $req->execute([$nom, $prenom, $email, $idRole, $id]);
    }

    // Je supprime un utilisateur
    public function deleteUser($id)
    {
        $req = $this->pdo->prepare("DELETE FROM utilisateur WHERE id = ?");
        if ($req->execute([$id])) {
            return "Utilisateur supprimé avec succès.";
        } else {
            return "Erreur lors de la suppression de l'utilisateur.";
        }
    }

    // Fonction de déconnexion
    public function logoutUser() {
        session_start();
        session_destroy();
        return "Déconnexion réussie.";
    }

    public function getPendingUsers() {
        $req = $this->pdo->prepare("SELECT * FROM utilisateur WHERE idRole = 3");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserRole($userId, $newRoleId) {
        $req = $this->pdo->prepare("UPDATE utilisateur SET idRole = :newRole WHERE id = :userId");
        $req->bindParam(':newRole', $newRoleId, PDO::PARAM_INT);
        $req->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $req->execute();
    }
}
