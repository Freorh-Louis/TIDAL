<?php
session_start();

require_once 'PDO_access.php';
require_once 'App.php';

class Pathologies extends App {

    public function controller() {
        // Récupération des paramètres GET
        $recherche = isset($_GET['maladie']) ? strtolower(trim($_GET['maladie'])) : null;
        $motcle = isset($_GET['motcle']) ? strtolower(trim($_GET['motcle'])) : null;

        // Lecture de la requête SQL principale
        $sql = file_get_contents(__DIR__ . '/../sql/pathologies.sql');
        if ($sql === false) {
            die("Erreur : impossible de lire le fichier pathologies.sql");
        }

        // Requête principale sans paramètres
        $pathologies = $this->pdo_access->getRequest($sql);

        // Filtrage par recherche libre (maladie)
        if ($recherche) {
            $pathologies = array_filter($pathologies, function ($patho) use ($recherche) {
                foreach ($patho as $valeur) {
                    if (stripos($valeur, $recherche) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        // Filtrage par mot-clé uniquement si connecté
        if ($motcle && isset($_SESSION['login']) && $_SESSION['login'] === true) {
            $pdo = $this->pdo_access->getPDO();
            $mots = preg_split('/\s+/', $motcle); // coupe par espaces
        
            $listes_ids = [];
        
            foreach ($mots as $mot) {
                $sqlMotCle = "
                    SELECT DISTINCT patho.idp
                    FROM keywords
                    LEFT JOIN keysympt ON keywords.idk = keysympt.idk
                    LEFT JOIN symptpatho ON symptpatho.ids = keysympt.ids
                    LEFT JOIN patho ON patho.idp = symptpatho.idp
                    WHERE LOWER(keywords.name) LIKE :recherche
                ";
                $stmt = $pdo->prepare($sqlMotCle);
                $stmt->execute([':recherche' => '%' . $mot . '%']);
                $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
                $listes_ids[] = $ids;
            }
        
            // Intersection : on garde les idp présents dans toutes les listes
            $id_communs = array_shift($listes_ids);
            foreach ($listes_ids as $autres_ids) {
                $id_communs = array_intersect($id_communs, $autres_ids);
            }
        
            // Filtrage des pathologies
            $pathologies = array_filter($pathologies, function ($p) use ($id_communs) {
                return in_array($p['idp'], $id_communs);
            });
        }
        

        // Chargement de Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../html');
        $twig = new \Twig\Environment($loader);

        // Rendu de la vue
        echo $twig->render('pathologies.html.twig', [
            'pathologies' => $pathologies,
            'recherche' => $recherche,
            'motcle' => $motcle,
            'is_logged' => $_SESSION['login'] ?? false
        ]);
    }
}
