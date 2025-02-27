<?php

namespace App\Modeles;

use PDO;
use PDOException;

require_once __DIR__ . '/../../config/bdd.php';

class PdoPortfolio {
// Déclaration d'une variable statique pour stocker l'instance unique de PDO
private static ?PDO $bdd = null;

// Méthode statique pour récupérer l'instance unique de connexion
public static function getInstance(): PDO
{
    // Vérifie si la connexion à la base de données n'a pas encore été créée
    if (self::$bdd === null) {
        try {
            // Création d'une nouvelle instance PDO avec les constantes définies ailleurs (ex: config)
            self::$bdd = new PDO(
                DB_DSN, 
                DB_USER, 
                DB_PWD,  
                [
                    // Active le mode exception pour gérer les erreurs proprement
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    // Définit le mode de récupération des données en tableau associatif
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            // En cas d'erreur, affiche un message et arrête l'exécution (peut être amélioré)
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    // Retourne l'instance unique de PDO
    return self::$bdd;
}
}