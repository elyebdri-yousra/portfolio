<?php

namespace Controller;

use Modeles\Utilisateur;
use Controller\ErrorController;
use Exception;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


class UserController extends Controller
{

    private $error;

    public function __construct()
    {
        $this->error = new ErrorController();
    }


    public function deleteUser()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['idRole']) || $_SESSION['user']['idRole'] != 1) {
            $this->error->index();
        } else {
            $id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT); //Me permets de vérifier le type de la donnée
            if ($id != 1) {
                $userModel = new Utilisateur();
                $userModel->deleteUser($id);
            }
            header("Location: index.php?page=manageUsers");
        }
    }


    public function auth()
    {
        $this->render('auth');
    }
    // Traite la connexion
    public function authenticate()
    {
        if (isset($_POST['email']) && isset($_POST['mdp'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Me permets de vérifier le type de la donnée
            $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userModel = new Utilisateur(); // Crée un nouvel objet de la classe utilisateur
            $user = $userModel->getUserByEmail($email); // Récupérer l'email de l'utilisateur grâce au model
            // Je vérifie le mot de passe (il est hashé)
            if ($user && password_verify($mdp, $user['mdp'])) {
                if ($user['idRole'] == 3) {
                    $error = "Votre inscription est toujours en attente.";
                    $this->render('auth', ['errorConnexion' => $error]);
                    return;
                }
                if ($user['idRole'] == 4) {
                    $error = "Votre inscription a été refusée";
                    $this->render('auth', ['errorConnexion' => $error]);
                    return;
                }
                session_start(); // Crée la session 
                $_SESSION['user'] = $user; //J'accéde à la variable session, je crée une ligne appler user et j'y stock le user 
                header("Location: index.php?page=home");
            } else {
                $error = "Email ou mot de passe incorrect.";
                $this->render('auth', ['errorConnexion' => $error]);
            }
        } else {
            $this->render('auth', ['errorConnexion' => 'Veuillez remplir tous les champs.']);
        }
    }

    // Traite l'inscription
    public function create()
    {
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Me permets de vérifier le type de la donnée
            $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userModel = new Utilisateur();
            // Je hash le mot de passe
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
            // Je définis par défaut le rôle "évaluateur" (par exemple, idRole = 2)
            $role = 3;

            try {

                $result = $userModel->createUser($nom, $prenom, $email, $hashedPassword, $role);
                if ($result) {
                    $message = "Inscription réussie. En attente de validation par l'administrateur.";
                    $this->render('auth', ['message' => $message]);
                } else {
                    $error = "Erreur lors de l'inscription.";
                    $this->render('auth', ['error' => $error]);
                }
            } catch (Exception $e) {
                if ($e->getCode() == 23000) {
                    $this->render('auth', ['error' => "L'adresse mail est déjà utilisée"]);
                }
            }
        } else {
            $this->render('auth', ['error' => 'Veuillez remplir tous les champs.']);
        }
    }

    public function manageUsers()
    {
        // Vérifie si l'utilisateur est bien un admin
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['idRole']) || $_SESSION['user']['idRole'] != 1) {
            header("Location: index.php");
            exit();
        }
        $userModel = new Utilisateur();
        $waiters = $userModel->getPendingUsers(); // Ceux en attente
        $users = $userModel->getAllUsersWithRole();
        $roles = $userModel->getAllRoles();
        $this->render('admin/manage_users', ['waiters' => $waiters, 'users' => $users, 'roles' => $roles]);
    }

    //Met tout à jour
    public function updateUserInfo()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['idRole']) || $_SESSION['user']['idRole'] != 1) {
            header("Location: index.php");
            exit();
        }

        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT); //Me permets de vérifier le type de la donnée
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Me permets de vérifier le type de la donnée
        $mdp = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id_role = filter_input(INPUT_POST, 'new_role', FILTER_SANITIZE_NUMBER_INT);

        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
        $userModel = new Utilisateur();

        $userModel->updateUser($user_id,$nom,$prenom,$email,$id_role);
        if($mdp != ""){
            $userModel->changeUserPassword($user_id,$hashedPassword);
        }

        header("Location: index.php?page=manageUsers");
    }

    //Met a jour que le role
    public function updateUser()
    {
        // Vérifie si l'utilisateur est bien un admin
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['idRole']) || $_SESSION['user']['idRole'] != 1) {
            header("Location: index.php");
            exit();
        }

        if (isset($_POST['user_id'], $_POST['new_role'])) {
            $userId = intval($_POST['user_id']);
            $newRole = intval($_POST['new_role']);
            $userModel = new Utilisateur();
            $userModel->updateUserRole($userId, $newRole);
            header("Location: index.php?page=manageUsers");
        }
    }

    // Affiche la page de déconnexion (confirmation)
    public function logout()
    {
        $this->render('logout');
    }

    // Traite la déconnexion après confirmation
    public function logoutAction()
    {
        // Appel optionnel à une méthode du modèle si nécessaire
        $userModel = new Utilisateur();
        $userModel->logoutUser(); // fonction minimale dans le modèle

        // Détruire la session
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_destroy();
        header("Location: index.php?page=home");
        exit;
    }
}
