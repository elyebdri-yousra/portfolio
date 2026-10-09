<?php

namespace Modeles;
use Database;



class Model {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance(); // Récupérer la connexion unique à PDO
    }

    
}