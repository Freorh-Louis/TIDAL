<?php

// Ce script a pour but de rendre accessible la page d'incription d'un nouvel utilisateur
// Pour l'instant, cette page n'est pas reliée a un autre script pour l'inscrire dans la base de donnée
// TO DO :  - Créer un script JavaScript pour modifier la base de données et ajouter ce nouvel utilisateur
//          - Authifier et connecter ce nouvel utilisateur

session_start();
require_once 'App.php';

class SignUp extends App {

    public function controller() {
        $loader = new \Twig\Loader\FilesystemLoader('./html');
        $twig = new \Twig\Environment($loader);
        $loginFailed = 2;
        echo $twig->render('signUp.html.twig', ["loginFailed" => $loginFailed]);
    }
}