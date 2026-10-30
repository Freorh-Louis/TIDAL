<?php
/**
 * ========================================================================

 * DESCRIPTION :
 * Ici gère le routage des différentes pages du site web en fonction de l'URI demandé
 * Il inclut l'initialisation de la connexion à la base de données via PDO, le chargement dynamique 
 * des classes nécessaires (par exemple, Home, Pathologies, Login, etc) et la gestion de la logique 
 * d'affichage en fonction des routes définies.
 * C'est notre SEP
 * 
 * - Une fonction spl_autoload_register est utilisée pour charger dynamiquement les classes nécessaires à partir de fichiers PHP
 * - La connexion à la base de données est établie en utilisant un objet PDO_access avec les paramètres de connexion récupérés depuis les variables d'environnement
 * - Un tableau $routes contient les associations entre les URI et les scripts à exécuter + les classes correspondantes à instancier pour chaque route
 * - L'URI de la requête est récupérée et comparée aux routes définies
 * - Si une route correspond le fichier et la classe associés sont inclus et exécutés
 * - Sinon erreur 404 
 * 
 * Ce code est inspiré d'un code trouvé sur StackOverFlow
 * ========================================================================
 */

require_once 'php/PDO_access.php';

//charge twig
spl_autoload_register(function ($classname) {
    $filename = ltrim(str_replace('\\', '/', $classname)) .'.php';
    if (file_exists($filename)) require_once $filename;
});

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DB'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

$myPDO = new PDO_access($host, $dbname, $user, $password);


// First, let's define our list of routes.
// We could put this in a different file and include it in order to separate
// logic and configuration.
$routes = [
    '/'      => ['script' => 'php/Home.php', 'class' => 'Home'],
    '/pathologies' => ['script' => 'php/Pathologies.php', 'class' => 'Pathologies'],
    '/login' => ['script' => 'php/Login.php', 'class' => 'Login'],
    '/authorize' => ['script' => 'php/Authorize.php', 'class'=> 'Authorize'],
    '/detailPathologie' => ['script' => 'php/DetailPathologie.php', 'class' => 'DetailPathologie'],
    '/myApi'=> ['script'=> 'php/Api.php', 'class'=> 'Api'],
    '/signUp'=> ['script'=> 'php/SignUp.php', 'class'=> 'SignUp'],
];

// Get the requested URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the requested URI matches any of the defined routes
if (array_key_exists($requestUri, $routes)) {
    // Include the corresponding file
    require_once $routes[$requestUri]['script'];
    $page = new $routes[$requestUri]['class']($myPDO);
    $page->controller();
} 
else {
    // Handle 404 Not Found
    if (!headers_sent()) {
        header("HTTP/1.0 404 Not Found");
    }
    echo "404 Not Found";
}

