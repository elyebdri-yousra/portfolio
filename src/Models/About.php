<?php

namespace Modeles;

use PDO;

class About extends Model
{
    // ============ PARCOURS ============
    public function getAllParcours()
    {
        $req = $this->pdo->query("SELECT * FROM about_parcours ORDER BY ordre ASC, id ASC");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParcoursById($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM about_parcours WHERE id = ? LIMIT 1");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addParcours($poste, $entreprise, $periode, $missions)
    {
        $req = $this->pdo->prepare("SELECT COALESCE(MAX(ordre), -1) + 1 AS o FROM about_parcours");
        $req->execute();
        $ordre = (int) $req->fetch(PDO::FETCH_ASSOC)['o'];

        $req = $this->pdo->prepare("INSERT INTO about_parcours (poste, entreprise, periode, missions, ordre) VALUES (?, ?, ?, ?, ?)");
        $req->execute([$poste, $entreprise, $periode, $missions, $ordre]);
        return $this->pdo->lastInsertId();
    }

    public function updateParcours($id, $poste, $entreprise, $periode, $missions)
    {
        $req = $this->pdo->prepare("UPDATE about_parcours SET poste = ?, entreprise = ?, periode = ?, missions = ? WHERE id = ?");
        return $req->execute([$poste, $entreprise, $periode, $missions, $id]);
    }

    public function deleteParcours($id)
    {
        $req = $this->pdo->prepare("DELETE FROM about_parcours WHERE id = ?");
        return $req->execute([$id]);
    }

    // ============ FORMATIONS ============
    public function getAllFormations()
    {
        $req = $this->pdo->query("SELECT * FROM about_formation ORDER BY ordre ASC, id ASC");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFormationById($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM about_formation WHERE id = ? LIMIT 1");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addFormation($titre, $etablissement, $contenu)
    {
        $req = $this->pdo->prepare("SELECT COALESCE(MAX(ordre), -1) + 1 AS o FROM about_formation");
        $req->execute();
        $ordre = (int) $req->fetch(PDO::FETCH_ASSOC)['o'];

        $req = $this->pdo->prepare("INSERT INTO about_formation (titre, etablissement, contenu, ordre) VALUES (?, ?, ?, ?)");
        $req->execute([$titre, $etablissement, $contenu, $ordre]);
        return $this->pdo->lastInsertId();
    }

    public function updateFormation($id, $titre, $etablissement, $contenu)
    {
        $req = $this->pdo->prepare("UPDATE about_formation SET titre = ?, etablissement = ?, contenu = ? WHERE id = ?");
        return $req->execute([$titre, $etablissement, $contenu, $id]);
    }

    public function deleteFormation($id)
    {
        $req = $this->pdo->prepare("DELETE FROM about_formation WHERE id = ?");
        return $req->execute([$id]);
    }

    // ============ COMPÉTENCES ============
    public function getAllCompetences()
    {
        $req = $this->pdo->query("SELECT * FROM about_competence ORDER BY ordre ASC, id ASC");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompetenceById($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM about_competence WHERE id = ? LIMIT 1");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addCompetence($categorie, $details)
    {
        $req = $this->pdo->prepare("SELECT COALESCE(MAX(ordre), -1) + 1 AS o FROM about_competence");
        $req->execute();
        $ordre = (int) $req->fetch(PDO::FETCH_ASSOC)['o'];

        $req = $this->pdo->prepare("INSERT INTO about_competence (categorie, details, ordre) VALUES (?, ?, ?)");
        $req->execute([$categorie, $details, $ordre]);
        return $this->pdo->lastInsertId();
    }

    public function updateCompetence($id, $categorie, $details)
    {
        $req = $this->pdo->prepare("UPDATE about_competence SET categorie = ?, details = ? WHERE id = ?");
        return $req->execute([$categorie, $details, $id]);
    }

    public function deleteCompetence($id)
    {
        $req = $this->pdo->prepare("DELETE FROM about_competence WHERE id = ?");
        return $req->execute([$id]);
    }
}