<?php

function Connexion()
{
    $hostname = '127.0.0.1';
    $username = 'userPortfolio';
    $password = '@Hsn7Ysr.';
    $db = 'portfolio';
    $dsn = "mysql:host=$hostname;dbname=$db;charset=UTF8";

    try {
        $bdd = new PDO($dsn, $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd; // ✅ Retourne la connexion au lieu de l'afficher
    } catch (PDOException $e) {
        die("❌ Erreur de connexion à la base de données : " . $e->getMessage()); // Stoppe le script en cas d'erreur
    }
}