<?php

namespace Controller;

use Modeles\Image;
use Modeles\Logiciel;

class LogicielController extends Controller
{

    public function index()
    {
        $this->render('admin/add_logiciel');
    }

    public function create()
    {
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS); //Me permets de vérifier le type de la donnée
        $this->loadImage($nom);
        header("Location: index.php?page=logiciel");
    }

    private function loadImage($name)
    {
        // Il faut que je récupère l'Id du projet dans lequel je dois inserer les images
        $logiciel = new Logiciel();
        $id = $logiciel->getLogicielByName($name);
        // Pour accéder aux images, avec php il existe $_FILES -> Qui contient toutes les images
        // Source pour comprendre https://www.w3schools.com/php/php_file_upload.asp
        $files_paths = "./storage/logiciel_img/"; // l'endroit ou ranger les images
        // Quand tu envoies un fichier depuis ton PC vers le site web, c'est le site web qui garde l'image dans 
        // son stockage. Donc toutes les images iront dans se dossier.
        // !!!!!!!!!! Pour pas alourdir le code, y'a l'explication en bas !!!!!!!!! \\    
        // Avant de commencer ma boucle je dois connaitre le nombre d'image que j'ai envoyé à l'application.
        // Il existe bcp de technique mais la plus simple est de compter les noms
        // A partir de maintenant je peux commencer ma boucle. Pour rappel mon but est de récupérer le nom, le type, full_path etc etc
        // Donc pour ma boucle je me place dans $_FILES['images']
        // Si tu te demande quel type de boucle il faut utiliser, ici il est plus intelligent d'utiliser une boucle for et pas une foreach. Comme j'accèdes à des données qui sont dans un tableau, ca m'évitera de faire bcp de boucle
        $nom_fichier = $files_paths . basename($_FILES["image"]["name"]); // nom_fichier c'est le nom de ton
        $type_fichier = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION)); // Permet de prendre le type de fichier pour vérifier si c'est une image
        if ($type_fichier == "jpg" || $type_fichier == "png" || $type_fichier == "jpeg" || $type_fichier == "svg" || $type_fichier == "ico") { // On vérifie le type de fichier
            if (!file_exists($nom_fichier)) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $nom_fichier);
                $logiciel->addLogiciel($name, $nom_fichier);
            } else {
                $logiciel->addLogiciel($name, $nom_fichier);
            }
        } else {
            $logiciel->deleteLogicielById($id);
        }
    }
}
