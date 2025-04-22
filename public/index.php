<?php

//routeur frontal 
use Controller\HomeController;
use Controller\ProjetController;
use Controller\UserController;
use Controller\ContactController;
use Controller\AboutController;
use Controller\ErrorController;
use Controller\LogicielController;

// J'inclus la configuration
require_once '../vendor/autoload.php';
require_once '../config/bdd.php';

// Je récupère la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$error = new ErrorController();


switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'contact':
        $controller = new ContactController();
        $controller->index();
        break;
    case 'about':
        $controller = new AboutController();
        $controller->index();
        break;
    case 'projet':
        $controller = new ProjetController();
        $controller->index();
        break;
    case 'logiciel':
        if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) {

            $controller = new LogicielController();
            $controller->index();
        } else {
            $controller = new ErrorController();
            $controller->render('error');
        }
        break;
    case 'addLogiciel':
        if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) {
            $controller = new LogicielController();
            $controller->create();
        } else {
            $controller = new ErrorController();
            $controller->render('error');
        }
        break;
    case 'projet_show':
        if (isset($_GET['id'])) {
            $controller = new ProjetController();
            $controller->show($_GET['id']);
        } else {
            $error->index();
        }
        break;
    // A modifier plus tard, ça mé déplait fort
    case 'supprimer':
        if (isset($_GET['id'])) {
            if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1)) {
                $controller = new ProjetController();
                $controller->supprimer($_GET['id']);
            } else {
                $controller = new ErrorController();
                $controller->render('error');
            }
        } else {
            $controller = new ErrorController();
            $controller->render('error');
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
        $userController = new UserController();
        $userController->manageUsers();
        break;
    case 'updateUser':
        $userController = new UserController();
        $userController->updateUser();
        break;
    case 'addCommentaire':
        $userController = new ProjetController();
        $userController->addCommentaire();
        break;
    default:
        $controller = new ErrorController();
        $controller->render('error');
        break;
}
