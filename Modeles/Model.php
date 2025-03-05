<?php

abstract class Model {

    protected static $bdd;

    // Initialise la connexion depuis bdd.php
    private static function setBdd() {
        require_once __DIR__ . '/../config/bdd.php'; // 📌 Inclut le fichier de connexion
        self::$bdd = Connexion(); // 📌 Récupère la connexion

        if (!self::$bdd instanceof PDO) { // 📌 Vérifie si self::$bdd est bien une connexion
            throw new Exception("Erreur : La connexion à la base de données n'a pas été établie.");
        }
    }

    // Je récupère la connexion à la BDD
    protected function getBdd() {
        if (self::$bdd == null) {
            self::setBdd(); // Initialise la connexion si elle est null
        }
        return self::$bdd;
    }

    // Fonction générique pour récupérer toutes les entrées d'une table
    protected function getAll($table, $obj) {
        $var = [];

        // Vérification et sécurisation du nom de table (évite l'injection SQL)
        $allowedTables = ['utilisateur', 'role']; 
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Table non autorisée.");
        }

        $bdd = $this->getBdd(); // Récupération de la connexion
        $req = $bdd->prepare("SELECT * FROM " . $table);
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }

        $req->closeCursor(); // Fermeture propre du curseur avant le return
        return $var;
    }
}