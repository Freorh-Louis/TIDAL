<?php
/**
 * ======================================================================

 * DESCRIPTION :
 * Ce contrôleur PHP permet de gérer notre API REST pour récup les détails d'une pathologie spécifique depuis une base de données, 
 * en se basant sur un identifiant transmis par l'URL (on utilise GET id)
 * Il s'appuie sur la classe App (base de l'application) et un accès PDO encapsulé dans PDO_access.php.
 * 
 * MÉTHODES PRINCIPALES :
 * - read_single($id) :
 *     → Charge une requête SQL depuis un fichier 
 *     → Exécute la requête via une méthode dédiée dans PDO_access
 *     → Retourne un tableau associatif contenant les détails d'une pathologie
 *     → Définit les headers HTTP (CORS + JSON)
 *     → Et permet de gérer les erreurs ("code à la main") : requête non trouvée, pathologie introuvable, ou exception
 * 
 * - controller() :
 *     → Récupère id depuis l’URL
 *     → Valide id (doit être > 0)
 *     → Appelle read_single() et retourne la réponse JSON

 * ======================================================================
 */

require_once 'App.php';
require_once 'PDO_access.php';

class Api extends App {

    public function read_single($id) {

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        http_response_code(200);

        try {    
            // Chargement de la requête SQL depuis le fichier
            $sql = file_get_contents(__DIR__ . '/../sql/detailPathologie.sql');
            if ($sql === false) {
                die("Erreur : impossible de lire le fichier SQL.");
            }

            // Exécution de la requête
            $patho = $this->pdo_access->getDetailPathologie($sql, $id);

            if (!$patho) {
                http_response_code(404);
                die("Pathologie non trouvée.");
            }

            return $patho;
        } catch (Exception $e) {
            http_response_code(500);
        }
    }

    public function controller() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id <= 0) {
            die("ID invalide.");
        }

        $patho = $this->read_single($id);
        echo json_encode($patho);
    }
}