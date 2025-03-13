<?php
// controllers/HomeController.php
require_once 'Controller.php';

class ContactController extends Controller
{

    public function index()
    {
        $this->render('contact');
    }
}
