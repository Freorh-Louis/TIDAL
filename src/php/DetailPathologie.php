<?php
/**
 * ========================================================================

 * DESCRIPTION :
 * Ce fichier contient la classe DetailPathologie qui gère l'affichage des détails d'une pathologie spécifique
 * Lorsqu'un utilisateur accède à la page avec un paramètre id dans l'URL, cette classe récupère cet ID 
 * et génère un rendu dynamique des détails de la pathologie correspondante
 * 
 * - controller()
 *     → Récupère l'ID de la pathologie depuis l'URL via la méthode GET
 *     → Vérifie que l'ID est valide (supérieur à 0), sinon retourne un message d'erreur
 *     → Initialise Twig pour rendre le template de la page de détail de pathologie
 *     → Passe l'ID de la pathologie au template Twig pour une utilisation dans la vue
 * 
 * ========================================================================
 */


require_once 'PDO_access.php';
require_once 'App.php';

class DetailPathologie extends App {

    public function controller() {
        // Récupération de l'ID depuis l'URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id <= 0) {
            die("ID invalide.");
        }

        // Initialisation de Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../html');
        $twig = new \Twig\Environment($loader);

        // Affichage du template
        echo $twig->render('detailPathologieApi.html.twig', [
            'id' => $id,
        ]);
    }
}


