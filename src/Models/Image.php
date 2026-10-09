<?php

namespace Modeles;

use PDO;

class Image extends Model {
        public function ajoutImage($nom, $urlimgL, $idProjet) {
        $req = $this->pdo->prepare("INSERT INTO projet_img (nom, img_path, id_projet) VALUES (?, ?, ?)");
        return $req->execute([$nom, $urlimgL, $idProjet]);
    }

    public function getAllImageByProjectId($id)
    {
        $req = $this->pdo->prepare("SELECT nom,img_path FROM projet_img WHERE id_projet = ?");
        $req->execute([$id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAllImageByProjectId($id) {
        $req = $this->pdo->prepare("DELETE FROM projet_img WHERE id_projet = ?");
        $req->execute([$id]); // Passe l'argument $id ici
        return true;
    }

    public function deleteUniqueImageByProjectId($id,$nom){
        $req = $this->pdo->prepare("DELETE FROM projet_img WHERE id_projet = ? and nom = ?");
        $req->execute([$id, $nom]);
        return true;
    }


}