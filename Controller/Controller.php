<?php

class Controller {

    // Je charge la vue en passant les données nécessaires
    public function render($vue, $data = []) {
        extract($data);
        require_once "Vues/$vue.php";
    }
}