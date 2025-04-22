<?php

namespace Modeles;

use Database;
use PDO;

class Logiciel
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance(); // Récupérer la connexion unique à PDO
    }

    public function getAllLogiciel()
    {
        $req = $this->pdo->prepare("SELECT * FROM logiciel ORDER BY nomLogiciel");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLogicielByName($name)
    {
        $req = $this->pdo->prepare("SELECT * FROM logiciel WHERE nomLogiciel = ? limit 1");
        $req->execute([$name]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getLogicielById($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM logiciel WHERE id = ? limit 1");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function associateProjetLogiciel($projet_id, $logiciel_id, $url_img){
        $req = $this->pdo->prepare("INSERT INTO logicielUse (idProjet, idLogiciel, url_img) VALUES ( ?, ?, ?)");
        return $req->execute([$projet_id,$logiciel_id, $url_img]);
    }

    public function getLogicielByProject($id_projet){
        $req = $this->pdo->prepare("SELECT url_img,nomLogiciel FROM logicielUse inner join logiciel on logiciel.id = logicielUse.idLogiciel  WHERE idProjet = ?");
        $req->execute([$id_projet]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteLogicielById($id)
    {
        $req = $this->pdo->prepare("DELETE FROM logiciel WHERE id = ?");
        $req->execute([$id]); // Passe l'argument $id ici
        return true;
    }

    public function addLogiciel($nom, $url_img)
    {
        $req = $this->pdo->prepare("
        INSERT INTO logiciel (nomLogiciel, urlimg) 
        VALUES (?, ?)
    ");

        return $req->execute([
            $nom,
            $url_img,
        ]);
    }
}
