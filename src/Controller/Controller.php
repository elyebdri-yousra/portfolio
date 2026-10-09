<?php

/**
 * @package   Portfolio
 * @author    EL YEBDRI Yousra <yousra.elyebdri@icloud.com>
 * @copyright 2025 portfolio
 */

namespace Controller;

class Controller
{

    // Je charge la vue en passant les données nécessaires
    public function render($vue, $data = [])
    {
        // Extraire les données pour les rendre accessibles dans la vue
        extract($data);

        // Capturer le contenu de la vue spécifique
        ob_start();
        require_once __DIR__ . '/../Views/' . $vue . '.php';
        $content = ob_get_clean();

        // Charger le layout avec le contenu
        require_once __DIR__ . '/../Views/layouts/main.php';
    }
}
