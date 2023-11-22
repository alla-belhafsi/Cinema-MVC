<?php

// un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Controller;

// 'utilisation du "use" pour accéder à la classe Connect
use Model\Connect;

class CinemaController {
    // Lister les films
    public function listFilms() {
        // On démarre la capture de sortie
        ob_start();
        
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requete = $pdo->query("
            SELECT titre, dateParution
            FROM film
        ");
        // On relie par un "require" la vue qui nous intéresse
        require "../view/listFilms.php";

        // Récupération du contenu de la capture de sortie dans une variable
        $listFilms = ob_get_clean();
    }
}