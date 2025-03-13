<?php
require_once 'config/bdd.php'; // Inclusion de la connexion

class Model {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance(); // Récupérer la connexion unique à PDO
    }
}