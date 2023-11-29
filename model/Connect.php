<?php

// un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Model;

// La classe est abstraite car on n'instanciera jamais la classe Connect puisqu'on aura seulement besoin d'accéder à la méthode "seConnecter"
abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema_env_dev";
    const USER = "root";
    const PASS = "";

    public static function seConnecter() {
        try {
            // La présence d'un "\" devant PDO indiquant au framework que PDO est une classe native et non une classe du projet
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch(\PDOException $ex) {
            return $ex->getMessage();
        }
    }
}