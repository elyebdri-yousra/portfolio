<?php
// controllers/HomeController.php
namespace Controller;

class HomeController extends Controller
{

    public function index()
    {
        $message = "Bienvenue sur mon portfolio ! <br>
        Je suis Yousra EL YEBDRI, étudiante en BUT Métiers du Multimédia et de l’Internet (MMI).<br><br>
        Vous pourrez découvrir mon parcours, mes compétences, mes projets et me contacter";
        $this->render('home', ['message' => $message]);
    }
}
