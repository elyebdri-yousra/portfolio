<?php

namespace Modeles;

use PDO;

class Projet extends Model
{

    // Je récupère tous les projets
    public function getAllProjets()
    {
        $req = $this->pdo->prepare("SELECT * FROM projet ORDER BY dateCrea DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // Faut que je réflechisse à comment bien prendre l'id pour les images
    public function getProjetByCol($titre, $date, $annee_but, $type)
    {
        $req = $this->pdo->prepare("SELECT id FROM projet WHERE titre = ? AND date = ? AND dateCrea = ? AND typeProjet = ?");
        $req->execute([$titre, $date, $annee_but, $type]);
        $id = $req->fetchAll();
        return $id[0]['id'];
    }

    public function getThumbnailById($id)
    {
        $req = $this->pdo->prepare("SELECT img_path FROM projet_img WHERE id_projet = ? limit 1");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProjetById($id)
    {
        $req = $this->pdo->prepare("DELETE FROM projet WHERE id = ?");
        $req->execute([$id]); // Passe l'argument $id ici
        return true;
    }


    // Je récupère un projet selon son ID
    public function getProjetById($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM projet WHERE id = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function update_projet($description, $date, $annee_but, $apprentissage, $argumentaire, $id)
    {
        $sql = "UPDATE projet
        SET description = ?, date = ?, dateCrea = ?, apprentissageCritique = ?, argumentaire = ?
        WHERE id = ?";

        $req = $this->pdo->prepare($sql);
        return $req->execute([
            $description,
            $date,
            $annee_but,
            $apprentissage,
            $argumentaire,
            $id
        ]);
    }



    public function addProjet($titre, $description, $date, $annee_but, $apprentissage, $type, $argumentaire, $idUser)
    {
        $req = $this->pdo->prepare("
            INSERT INTO projet (titre, description,date, dateCrea, apprentissageCritique, typeProjet, argumentaire, idUser) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");


        return $req->execute([
            $titre,
            $description,
            $date,
            $annee_but,
            $apprentissage,
            $type,
            $argumentaire,
            $idUser
        ]);
    }
}
