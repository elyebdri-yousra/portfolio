<?php

class Router {

    private $_ctrl;
    private $_vues;

    public function routeReq()
    {
        try {
            // Chargement automatique des classes
            spl_autoload_register(function($class) {
                $file = __DIR__ . '/../Modeles/' . $class . '.php'; // Utilisation de __DIR__
                
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    die("Classe $class introuvable dans $file !");
                }
            });

            // Vérification de l'URL
            $url = isset($_GET['url']) ? explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL)) : [];

            // Si une action est définie, on instancie le bon contrôleur
            if (!empty($url)) {
                $controller = ucfirst(strtolower($url[0])); // Premier élément de l'URL
                $controllerClass = "c_" . $controller;
                $controllerFile = "Controller/" . $controllerClass . ".php";

                // Vérifier si le fichier du contrôleur existe
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $this->_ctrl = new $controllerClass($url); // Instanciation du contrôleur
                } else {
                    throw new Exception('Page introuvable');
                }
            } else {
                // Contrôleur par défaut : Accueil
                require_once __DIR__ . '/c_accueil.php';
                $this->_ctrl = new C_accueil($url);
            }
        } 
        catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('../Vues/vuesError.php');
        }
    }
}