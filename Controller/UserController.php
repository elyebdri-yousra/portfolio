<?php

require_once 'Controller.php';
require_once 'Modeles/Utilisateur.php';

class UserController extends Controller {

    // Affiche le formulaire de connexion
    public function login() {
        $this->render('login');
    }

    // Traite la connexion
    public function authenticate() {
        if(isset($_POST['email']) && isset($_POST['mdp'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Me permets de vérifier le type de la donnée
            $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userModel = new Utilisateur(); // Crée un nouvel objet de la classe utilisateur
            $user = $userModel->getUserByEmail($email); // Récupérer l'email de l'utilisateur
            // Je vérifie le mot de passe (il est hashé)
            if($user && password_verify($mdp, $user['mdp'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php?page=home");
            } else {
                $error = "Email ou mot de passe incorrect.";
                $this->render('login', ['error' => $error]);
            }
        } else {
            $this->render('login', ['error' => 'Veuillez remplir tous les champs.']);
        }
    }

    // Affiche le formulaire d'inscription pour un évaluateur
    public function register() {
        $this->render('register');
    }

    // Traite l'inscription
    public function create() {
        if(isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'])) {
            $userModel = new Utilisateur();
            // Je hash le mot de passe
            $hashedPassword = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            // Je définis par défaut le rôle "évaluateur" (par exemple, idRole = 2)
            $role = 2;
            $result = $userModel->createUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $hashedPassword, $role);
            if($result) {
                $message = "Inscription réussie. En attente de validation par l'administrateur.";
                $this->render('register', ['message' => $message]);
            } else {
                $error = "Erreur lors de l'inscription.";
                $this->render('register', ['error' => $error]);
            }
        } else {
            $this->render('register', ['error' => 'Veuillez remplir tous les champs.']);
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?page=home");
    }
}