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
        require "view/film/listFilms.php";
    }

    public function formFilm($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteIFilm = $pdo->prepare("
        SELECT 
            film.id_film AS id_film,
            film.id_realisateur AS id_realisateur,
            film.note AS note,
            film.titre AS film,
            film.synopsis AS synopsis,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            film.durer AS durer,
            film.dateParution AS dateParution
        FROM film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE film.id_film = :id_film
        ");

        // Liaison des paramètres pour la requête et exécution
        $requeteIFilm->bindParam('id_film', $id);
        $requeteIFilm->execute();
        
        // Récupération de l'information
        $IFilm = $requeteIFilm->fetch();

        // Récupération des données actuelles des réalisateurs
        $requeteIReal = $pdo->query("
        SELECT
            realisateur.id_realisateur AS id_realisateur,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur
        FROM realisateur
        INNER JOIN personne on realisateur.id_personne = personne.id_personne
        ORDER BY realisateur ASC
        ");

        // Récupération de tous les informations
        $Reals = $requeteIReal->fetchAll();
        
        // Redirection vers la page de la liste des films
        require "view/film/formFilm.php";
    }

    public function UFilm($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        if (isset($_POST['modifier'])) {
            // Sanitize les données du formulaire avant de les utiliser
            $film = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $durer = filter_input(INPUT_POST, 'durer', FILTER_SANITIZE_NUMBER_INT);
            $dateParution = filter_input(INPUT_POST, 'dateParution', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $idRealisateur = filter_input(INPUT_POST, 'id_realisateur', FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //var_dump($note);die;
            // Exécution de la requête de mise à jour (ajouter update afficheFilm)
            $requeteUF = $pdo->prepare("
            UPDATE film
            SET
              titre = :titre,
              durer = :durer,
              dateParution = :dateParution,
              note = :note,
              id_realisateur = :id_realisateur,
              synopsis = :synopsis
            WHERE id_film = :id_film
            ");

            // Liaison des paramètres pour la mise à jour 
            $requeteUF->bindParam('id_film', $id);
            $requeteUF->bindParam('titre', $film);
            $requeteUF->bindParam('durer', $durer);
            $requeteUF->bindParam('dateParution', $dateParution);
            $requeteUF->bindParam('note', $note);
            $requeteUF->bindParam('id_realisateur', $idRealisateur);
            $requeteUF->bindParam('synopsis', $synopsis);
            $requeteUF->execute();

            // Redirection vers la page de confirmation
            require "view/confirmation/confirmation.php";
        }

        // Redirection vers la page du formulaire pré-rempli du film
        require "view/film/formFilm.php";
    }

    public function DFilm() {
        // On se connecte 
        $pdo = Connect::seConnecter();

        // Suppression du film dans la table film ainsi que dans la table casting
        $requeteRoleCastDel = $pdo->prepare("
        DELETE 
            film,
            casting
        FROM casting
        INNER JOIN film ON casting.id_film = film.id_film
        WHERE casting.id_film = :id_film
        ");

        // bind les paramètres
    }
}