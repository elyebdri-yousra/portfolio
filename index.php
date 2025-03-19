<?php

//routeur frontal 

// J'inclus la configuration
require_once 'config/bdd.php';

// J'inclus les contrôleurs nécessaires
require_once 'Controller/Controller.php';
require_once 'Controller/HomeController.php';
require_once 'Controller/ProjetController.php';
require_once 'Controller/UserController.php';
require_once 'Controller/ContactController.php';


$userController = new UserController(); // Déclare UserController une seule fois

// Je récupère la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'contact':
        $controller = new ContactController();
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
    case 'auth':
        $controller = new UserController();
        $controller->auth();
        break;
    case 'authenticate':
        $controller = new UserController();
        $controller->authenticate();
        break;
    case 'create_user':
        $controller = new UserController();
        $controller->create();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case 'logout_action':
        $controller = new UserController();
        $controller->logoutAction();
        break;
    case 'projet_add':
        $controller = new ProjetController();
        $controller->add();
        break;
    case 'manageUsers':
        $userController->manageUsers();
        break;
    case 'updateUser':
        $userController = new UserController();
        $userController->updateUser();
        break;
    default:
        echo "Page non trouvée.";
        break;
}
