<?php

namespace Modeles;

use PDO;

class Competence extends Model
{

    public function getAllCompetence()
    {
        $req = $this->pdo->prepare("SELECT * FROM competences
        ");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompetenceById($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM competences where id = ? limit 1");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getCompetenceByProjet($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM projet_competence inner join competences on competences.id = projet_competence.id_competence where id_projet = ?");
        $req->execute([$id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function associateProjetCompetence($projet_id, $competence_id)
    {
        $req = $this->pdo->prepare("INSERT INTO projet_competence (id_projet, id_competence) VALUES ( ?, ?)");
        return $req->execute([$projet_id, $competence_id]);
    }

    public function desassociateAllProjetCompetence($projet_id)
    {
        $req = $this->pdo->prepare("DELETE FROM projet_competence WHERE id_projet = ?");
        return $req->execute([$projet_id]);
    }
}
