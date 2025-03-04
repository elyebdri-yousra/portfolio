<?php

function Connexion()
{
    $hostname = '127.0.0.1';
    $username = 'userPortfolio';
    $password = '@Hsn7Ysr';
    $db = 'portfolio';
    $dsn = "mysql:host=$hostname;dbname=$db";
    try {
        $bdd = new PDO($dsn, $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "connecxion réussie ! </br>";
        return $bdd;
    } catch (PDOException $e) {
        echo "Erreur de connection ! </br>";
        echo $e->getMessage();
    }
}
$db = connexion();
