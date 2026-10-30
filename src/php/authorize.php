<?php
/**
 * ========================================================================

 * DESCRIPTION :
 * Ce fichier contient la classe Authorize qui gère l'authentification des
 * utilisateurs sur notre site. Lorsqu'un utilisateur soumet son nom d'utilisateur
 * et mdp la classe vérifie ces informations et crée une session d'utilisateur en cas de succès
 * En cas d'échec, elle affiche un message d'erreur
 * 
 * - controller()
 *     → Récupère les informations soumises via POST (nom d'utilisateur et mot de passe).
 *     → Tente de récupérer le mot de passe haché depuis la base de données via PDO_access
 *     → Vérifie le mot de passe soumis par rapport au mot de passe haché via password_verify
 *     → Si la vérification réussit, crée une session login pour l'utilisateur.
 *     → Si la vérification échoue, la session est marquée comme login = false.
 *     → Utilise Twig pour rendre la page de connexion, en affichant un message d’erreur si nécessaire.
 * 
 * ========================================================================
 */


session_start(); 

require_once 'PDO_access.php';
require_once 'App.php';

class Authorize extends App {

    public function controller() {
        $loader = new \Twig\Loader\FilesystemLoader('./html');
        $twig = new \Twig\Environment($loader);
        
        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';
        $loginFailed = 1;

        $hashedPassword = $this->pdo_access->getPasswd($username);

        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            $loginFailed = 0;
            $_SESSION['login'] = true; // ➤ Connexion réussie
        } else {
            $_SESSION['login'] = false; // ➤ Connexion échouée
        }

        echo $twig->render('login.html.twig', [
            "loginFailed" => $loginFailed
        ]);
    }
}
