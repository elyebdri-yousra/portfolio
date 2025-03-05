<?php

class C_accueil {
    private $userManager;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->users();
        }
    }

    private function users() {
        $this->userManager = new UserManager();
        $users = $this->userManager->getUser();

        if (!is_array($users)) {
            $users = []; // Évite les erreurs si `$users` est NULL
        }

        // Inclure la vue en passant `$users`
        require_once __DIR__ . '/../Vues/v_accueil.php';
    }
}