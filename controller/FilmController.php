<?php

// Un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Controller;

// Utilisation du "use" pour accéder à la classe Connect
use Model\Connect;

class FilmController {
    // Lister les films
    public function listFilms() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteLF = $pdo->query("
        SELECT 
            id_film,
            film.id_realisateur,
            film.titre,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            TIME_FORMAT(SEC_TO_TIME(film.durer*60),'%H:%i') AS dureeHeure,
            DATE_FORMAT(film.dateParution, '%Y') AS dateSortie
        FROM film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ORDER BY film.dateParution DESC;");
        
        // Redirection vers la page de la liste des films
        require "view/listFilms.php";
    } 
}