<?php

// Je définis les paramètres de connexion à la base de données
$host = '127.0.0.1';
$dbname = 'portfolio'; 
$user = 'userPortfolio';
$password = '@Hsn7Ysr.';
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

try {
    // Je crée une instance PDO pour me connecter à la BDD
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur, j'arrête l'exécution et affiche un message
    die("Erreur de connexion : " . $e->getMessage());
}