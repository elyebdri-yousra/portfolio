<?php

class Model {
    protected $pdo;

    public function __construct() {
        // J'utilise la variable globale $pdo initialisée dans config/bdd.php
        global $pdo;
        $this->pdo = $pdo;
    }
}