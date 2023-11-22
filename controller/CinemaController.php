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
        SELECT titre, 
            DATE_FORMAT(film.dateParution, '%Y') AS dateSortie 
        FROM film");
        
        require "view/listFilms.php";
    }
}