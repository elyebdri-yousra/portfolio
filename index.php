<?php

// J'inclus la configuration
require_once 'config/bdd.php';

// J'inclus les contrôleurs nécessaires
require_once 'Controller/Controller.php';
require_once 'Controller/HomeController.php';
require_once 'Controller/ProjetController.php';
require_once 'Controller/UserController.php';

// Je récupère la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'projet':
        $controller = new ProjetController();
        $controller->index();
        break;
    case 'projet_show':
        if (isset($_GET['id'])) {
            $controller = new ProjetController();
            $controller->show($_GET['id']);
        } else {
            echo "ID du projet non spécifié.";
        }
        break;
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'authenticate':
        $controller = new UserController();
        $controller->authenticate();
        break;
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
    case 'create_user':
        $controller = new UserController();
        $controller->create();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    default:
        echo "Page non trouvée.";
        break;
}