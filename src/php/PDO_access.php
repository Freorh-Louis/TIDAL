<?php

/**
 * ========================================================================

 * DESCRIPTION :
 * Ce fichier contient la classe PDO_access responsable de la gestion des connexions 
 * et des interactions avec la base de données via PDO
 * Il inclut des méthodes permettant d'exécuter des requêtes SQL de lecture, telles que la récupération de données spécifiques 
 * ou la gestion des informations de connexion d'un utilisateur
 * 
 * STRUCTURE DU FICHIER :
 * - Le constructeur nitialise la connexion à la base de données à l'aide de PDO avec  les informations de connexion fournies
 * (hôte, nom de base, utilisateur, mot de passe).
 * 
 * - Méthodes de requêtes : 
 *   - getTable() permet de récupérer toutes les données d'une table 
 *   - getRequest() exécute une requête SQL spécifique et récupère les résultats
 *   - getPasswd() récup le mot de passe d'un utilisateur pour la vérification de connexion
 *   - getDetailPathologie() récup les détails d'une pathologie à partir de son identifiant
 *   - getPDO() retourne l'objet PDO pour accéder directement à la base de données
 *
 * ========================================================================
 */

class PDO_access {
    private $dbh;

    function __construct($host, $dbname, $user, $password) {
        try {
            $dsn = "pgsql:host=$host;dbname=$dbname";
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo $e->getCode() . ' ' . $e->getMessage();
        }
    }

    public function getTable($mytable) {
        $sql = "SELECT * FROM :mytable";
        $data = null;
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute([":mytable"=> $mytable]);
            $data = $sth->fetchALL(PDO::FETCH_ASSOC);
            $this->dbh->commit();
        } catch(PDOException $e) {
            $this->dbh->rollback();
            echo $e->getCode() . ' ' . $e->getMessage();
        }
        return $data;
    }

    public function getRequest($request) {
        $data = null;
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($request);
            $sth->execute();
            $data = $sth->fetchALL(PDO::FETCH_ASSOC);
            $this->dbh->commit();
        } catch(PDOException $e) {
            $this->dbh->rollback();
            echo $e->getCode() . ' ' . $e->getMessage();
        }
        return $data;
    }

    public function getPasswd($username) {
        $sql = "SELECT passwd FROM users WHERE username = :username";
        $data = null;
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute([":username"=> $username]);
            $data = $sth->fetchColumn();
            $this->dbh->commit();
        } catch(PDOException $e) {
            $this->dbh->rollback();
            echo $e->getCode() . ' ' . $e->getMessage();
        }
        return $data;
    }

    public function getDetailPathologie($sql, $id) {
        $data = null;
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute([':id' => $id]);
            $data = $sth->fetch(PDO::FETCH_ASSOC);
            $this->dbh->commit();
        } catch(PDOException $e) {
            $this->dbh->rollback();
            echo $e->getCode() . ' ' . $e->getMessage();
        }
        return $data;
    }

    public function getPDO() {
        return $this->dbh;
    }
    
}