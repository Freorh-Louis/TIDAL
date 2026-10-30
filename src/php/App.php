<?php
/**
 * ========================================================================

 * DESCRIPTION :
 * Classe abstraite de base pour toutes les applications ou contrôleurs qui souhaitent 
 * interagir avec la base de données via un accès PDO
 * Elle sert de fondation commune aux classes qui vont hériter de ses propriétés et méthodes
 * 
 * ATTRIBUTS :
 * - $pdo_access : instance de la classe PDO_access permettant d'exécuter des requêtes préparées 
 * de manière sécurisée
 * 
 * MÉTHODES :
 * - __construct(PDO_access $pdo_access)
 *     → Injecte une dépendance de type PDO_access dans la classe
 *     → Permet aux classes enfants d’accéder à la base via $this->pdo_access
 * 
 * - controller() [abstraite]
 *     → Méthode à implémenter obligatoirement par toute classe héritant de App
 *     → Sert de point d’entrée principal pour contrôler le flux de l’application
 *       (souvent déclenchée après une requête HTTP).

 * Toute classe héritière (pax ex : Api) devra définir la méthode controller(),
 * et bénéficiera automatiquement de l’accès PDO configuré.

 * ========================================================================
 */


abstract class App {
    protected PDO_access $pdo_access;

    public function __construct(PDO_access $pdo_access) {
        $this->pdo_access = $pdo_access;
    }

    public abstract function controller();
}