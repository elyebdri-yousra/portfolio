<?php

class Image extends Model {
    public function addImage($urlimgL, $idProjet) {
        $req = $this->pdo->prepare("INSERT INTO images (urlimgL, idProjet) VALUES (?, ?)");
        return $req->execute([$urlimgL, $idProjet]);
    }
}