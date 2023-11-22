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
        $query = $pdo->query("SELECT titre, dateParution FROM film");
        $films = $query->fetchAll();

        // On démarre la capture de sortie
        ob_start();

        // Inclusion de la vue avec les données
        require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'listFilms.php';

        // Récupération du contenu de la capture de sortie dans une variable
        $content = ob_get_clean();

        // Inclusion du template pour afficher le contenu
        require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'template.php';
    }
}