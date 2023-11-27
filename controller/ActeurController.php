<?php

// un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Controller;

// 'utilisation du "use" pour accéder à la classe Connect
use Model\Connect;

class ActeurController {
    // Lister les acteurs/actrices
    public function listActeurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteLA = $pdo->query("
        SELECT
            acteur.id_acteur AS id_acteur,
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            DATE_FORMAT(personne.dateNaissance, '%d-%m-%Y') AS dateNaissance,
            personne.sexe
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        ORDER BY personne.dateNaissance DESC");

        require "view/listActeurs.php";
    }

    // Lister les filmographies
    public function listFilmographieA($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteFGA = $pdo->prepare("
        SELECT 
            film.titre AS film,
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            role.nom AS role,
            DATE_FORMAT(film.dateParution, '%Y') AS dateSortie
        FROM casting
        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN role ON casting.id_role = role.id_role
        INNER JOIN film ON casting.id_film = film.id_film
        WHERE acteur.id_acteur = :id_acteur
        ");// ne renvoie qu'une seule ligne

        // Liaison du paramètre :id_film et exécution de la requête
        $requeteFGA->bindParam(':id_acteur', $id);
        $requeteFGA->execute();

        require "view/listFilmographieA.php";
    }
}