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
            film.id_film as id_film,
            film.titre,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            TIME_FORMAT(SEC_TO_TIME(film.durer*60),'%H:%i') AS dureeHeure,
            DATE_FORMAT(film.dateParution, '%Y') AS dateParutionFormat
        FROM film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_personne
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ");
        
        require "view/listFilms.php";
    } 
        
    // Lister les acteurs/actrices
    public function listActeurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requete = $pdo->query("
        SELECT *
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne");

        require "view/listActeurs.php";
    }
}