<?php

/**
 * ========================================================================

 * DESCRIPTION :
 * Ce fichier gère la logique de déconnexion de l'utilisateur et l'affichage du formulaire de connexion
 * Lorsqu'un utilisateur est déjà connecté, ce fichier déclenche une déconnexion et prépare le rendu de la page de connexion 
 * avec un message indiquant l'état de l'authentification
 * 
 * - session_start() démarre ou reprend la session PHP existante
 * - Vérif de la session si une session active est détectée, elle est détruite pour déconnecter l'utilisateur
 * - On utilise la variable "loginFailed" pour indiquer le statut de la connexion (déconnexion réussie ou tentative de connexion échouée)
 * 
 * ========================================================================
 */

require_once 'App.php';
session_start();

class Login extends App {

    public function controller() {
        $loader = new \Twig\Loader\FilesystemLoader('./html');
        $twig = new \Twig\Environment($loader);
        if (isset($_SESSION['login']) && $_SESSION['login']) {
            session_destroy();
            $loginFailed = 2;
        }
        else {
            $loginFailed = 2;
        }
        echo $twig->render('login.html.twig', ["loginFailed" => $loginFailed]);
    }
}