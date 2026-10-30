<?php

// Ce script génère des MDPs hachés. Bien entendu dans un vrai projet, ce fichier ne serait pas présent dans le site.
// Il sert ici à se rappeler de quel MDP nos utilisateurs utilisent pour pouvoir tester.
// Ils correspondent aux utilisateurs dans l'ordre des id.

$passwords = [
    'SecurePass1!',
    'Password123#',
    'MySecret456$',
    'LetMeIn789@',
    'TestPass987%',
    'FrankPass2025!',
];

$hashedPasswords = [];

foreach ($passwords as $password) {
    array_push($hashedPasswords, password_hash($password, PASSWORD_DEFAULT));
}

var_dump($hashedPasswords);