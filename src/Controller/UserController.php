<?php

require_once __DIR__ . '/../Modeles/PdoPortfolio.php';
use App\Modeles\PdoPortfolio;

class UserController
{
    function donneListe()
    {
        $bdd = PdoPortfolio::getInstance(); // Récupère la connexion PDO

        $sql = "SELECT * FROM utilisateur";
        $q = $bdd->prepare($sql);
        $q->execute();

        $items = [];

        while ($row = $q->fetch()) {
            $items[] = $row;
        }

        return $items; 
    }

}