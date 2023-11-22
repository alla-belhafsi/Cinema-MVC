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
        $listFilms = $pdo->query("
        SELECT titre, 
            DATE_FORMAT(film.dateParution, '%Y') AS dateSortie 
        FROM film");
        
        require "view/listFilms.php";
    }

    // CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
    //         DATE_FORMAT(personne.dateNaissance, '%d-%m-%Y') AS dateNaissance

    // Lister les acteurs/actrices
    public function listActeurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $listActeurs = $pdo->query("
        SELECT *
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne");

        require "view/listActeurs.php";
    }
}