<?php
// controllers/HomeController.php
require_once 'Controller.php';

class HomeController extends Controller {

    public function index() {
        $message = "Bienvenue sur mon portfolio !";
        $this->render('home', ['message' => $message]);
    }
}