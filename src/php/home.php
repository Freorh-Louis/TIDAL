<?php

/**
 * ========================================================================

 * DESCRIPTION :
 * Ce fichier contient la classe Home responsable de la gestion de la page d'accueil
 * Elle charge les données nécessaires pour afficher les images et les informations associées
 * et utilise le moteur de template Twig pour rendre la vue
 * 
 * - controller()
 *     → Charge les données nécessaires à la page d'accueil depuis le fichier homeImages.php
 *     → Initialise le moteur de template Twig pour rendre le contenu HTML
 *     → Passe les données chargées à Twig et génère la vue en appelant le template home.html.twig
 * 
 * ========================================================================
 */

require_once 'App.php';

class Home extends App {

    public function controller() {
        // Charger les données
        $data = require './php/homeImages.php';

        $loader = new \Twig\Loader\FilesystemLoader('./html');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('home.html.twig', $data);
    }
}

