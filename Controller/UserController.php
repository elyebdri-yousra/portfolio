<?php

require_once 'Controller.php';
require_once 'Modeles/Utilisateur.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class UserController extends Controller
{


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
                session_start(); // Crée la session 
                $_SESSION['user'] = $user; //J'accéde à la variable session, je crée une ligne applée user et j'y stock le user 
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
            $result = $userModel->createUser($nom, $prenom, $email, $hashedPassword, $role);
            if ($result) {
                $message = "Inscription réussie. En attente de validation par l'administrateur.";
                $this->render('auth', ['message' => $message]);
            } else {
                $error = "Erreur lors de l'inscription.";
                $this->render('auth', ['error' => $error]);
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
        $users = $userModel->getPendingUsers();
        $this->render('admin/manage_users', ['users' => $users]);
    }

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
            if ($userModel->updateUserRole($userId, $newRole)) {
                $message = "Rôle mis à jour avec succès.";
            } else {
                $message = "Erreur lors de la mise à jour du rôle.";
            }
            $this->render('admin/manage_users', ['message' => $message, 'users' => $userModel->getPendingUsers()]);
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
