<?php

namespace Modeles;

use PDO;

class Image extends Model {

    public function ajoutImage($nom, $urlimgL, $idProjet) {
        // On récupère l'ordre max existant pour ce projet, +1
        $req = $this->pdo->prepare("SELECT COALESCE(MAX(ordre), -1) + 1 AS next_ordre FROM projet_img WHERE id_projet = ?");
        $req->execute([$idProjet]);
        $ordre = (int) $req->fetch(PDO::FETCH_ASSOC)['next_ordre'];

        $req = $this->pdo->prepare("INSERT INTO projet_img (nom, img_path, id_projet, ordre) VALUES (?, ?, ?, ?)");
        return $req->execute([$nom, $urlimgL, $idProjet, $ordre]);
    }

    public function getAllImageByProjectId($id)
    {
        // ⬇️ Tri par ordre croissant (puis id en secours)
        $req = $this->pdo->prepare("SELECT id, nom, img_path, ordre FROM projet_img WHERE id_projet = ? ORDER BY ordre ASC, id ASC");
        $req->execute([$id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAllImageByProjectId($id) {
        $req = $this->pdo->prepare("DELETE FROM projet_img WHERE id_projet = ?");
        $req->execute([$id]);
        return true;
    }

    public function deleteUniqueImageByProjectId($id, $nom){
        $req = $this->pdo->prepare("DELETE FROM projet_img WHERE id_projet = ? and nom = ?");
        $req->execute([$id, $nom]);
        return true;
    }

    /**
     * Met à jour l'ordre des images d'un projet.
     * @param int $idProjet
     * @param array $orderedIds  tableau d'IDs dans l'ordre désiré
     */
    public function updateOrder($idProjet, array $orderedIds)
    {
        $this->pdo->beginTransaction();
        try {
            $req = $this->pdo->prepare("UPDATE projet_img SET ordre = ? WHERE id = ? AND id_projet = ?");
            foreach ($orderedIds as $position => $imageId) {
                $req->execute([$position, (int) $imageId, $idProjet]);
            }
            $this->pdo->commit();
            return true;
        } catch (\Throwable $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}