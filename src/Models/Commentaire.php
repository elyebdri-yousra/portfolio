<?php

namespace Modeles;

use PDO;

class Commentaire extends Model
{

    public function getAllCommentaireByProjectId($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM commentaire INNER JOIN utilisateur on commentaire.userId = utilisateur.id WHERE idProjet = ?");
        $req->execute([$id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCommentaire($id_projet, $user_id, $commentaire)
    {
        $req = $this->pdo->prepare("INSERT INTO commentaire (idProjet, userId, createdAt, commentaire) VALUES (:idProjet, :userId, NOW(), :commentaire)");
        $req->bindParam(':idProjet', $id_projet, PDO::PARAM_INT);
        $req->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->execute();

    }
}
