<?php

// un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Controller;

// 'utilisation du "use" pour accéder à la classe Connect
use Model\Connect;

class CinemaController {
    // Lister les films
    public function listFilms() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requete = $pdo->query("
        SELECT 
            film.titre,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            TIME_FORMAT(SEC_TO_TIME(film.durer*60),'%H:%i') AS dureeHeure,
            DATE_FORMAT(film.dateParution, '%Y') AS dateSortie
        FROM film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ORDER BY film.dateParution DESC;");
        
        require "view/listFilms.php";
    } 
        
    // Lister les acteurs/actrices
    public function listActeurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requete = $pdo->query("
        SELECT
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            DATE_FORMAT(personne.dateNaissance, '%d-%m-%Y') AS dateNaissance,
            personne.sexe
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        ORDER BY personne.dateNaissance DESC");

        require "view/listActeurs.php";
    }

    public function listRealisateurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requete = $pdo->query("
        SELECT
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            DATE_FORMAT(personne.dateNaissance, '%d-%m-%Y') AS dateNaissance,
            personne.sexe
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        ORDER BY personne.dateNaissance ASC;");

        require "view/listRealisateurs.php";
    }
}