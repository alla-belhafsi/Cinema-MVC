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
        $requeteLF = $pdo->query("
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
        $requeteLA = $pdo->query("
        SELECT
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            DATE_FORMAT(personne.dateNaissance, '%d-%m-%Y') AS dateNaissance,
            personne.sexe
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        ORDER BY personne.dateNaissance DESC");

        require "view/listActeurs.php";
    }
    
    // Lister les Réalisateurs/Réalisatrices
    public function listRealisateurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteLR = $pdo->query("
        SELECT
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            DATE_FORMAT(personne.dateNaissance, '%d-%m-%Y') AS dateNaissance,
            personne.sexe
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        ORDER BY personne.dateNaissance ASC;");

        require "view/listRealisateurs.php";
    }

    public function casting() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On excécute la première requête titre ============================
        $requeteFilm = $pdo->prepare("
        SELECT 
            film.titre AS titre, 
            film.note AS note,
            DATE_FORMAT(film.dateParution, '%Y') AS anneeSortie,
            TIME_FORMAT(SEC_TO_TIME(film.durer*60),'%H:%i') AS dureeFilm
        FROM film
        WHERE film.id_film = 2");// ne renvoie qu'une seule ligne

        $requeteFilm->execute();

        // Récupération du titre du film
        $film = $requeteFilm->fetch();
        
        // On exécute la deuxième requête Réalisateur =======================
        $requeteRealisateur = $pdo->query("
        SELECT
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
        WHERE film.id_film = 2");// ne renvoie qu'une seule ligne

        $requeteRealisateur->execute();

        // Récupération de l'identité du Réalisateur
        $realisateur = $requeteRealisateur->fetch();

        // On exécute la troisième requête acteur et role ==================
        $requeteCasting = $pdo->prepare("
        SELECT 
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            role.nom AS role,
            personne.sexe AS sexe
        FROM casting
        INNER JOIN film ON casting.id_film = film.id_film
        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN role ON casting.id_role = role.id_role
        WHERE film.id_film = 2");// renvoie potentiellement plusieurs lignes

        $requeteCasting->execute();


        require "view/casting.php";
    }
}