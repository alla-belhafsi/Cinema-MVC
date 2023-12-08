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

    public function AFilm() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute une première requête
        $listReals = $pdo->query("
        SELECT
            realisateur.id_realisateur AS id_realisateur,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur
        FROM realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ORDER BY realisateur ASC
        ");

        // On exécute une deuxième requête
        $listGenres = $pdo->query("
        SELECT
            genre.id_genre AS id_genre,
            genre.libelle AS genre
        FROM genre
        ORDER BY libelle ASC
        ");

        if (isset($_POST['ajouter'])) {
            //Sanitize les données du formulaire avant de les utiliser
            $id_realisateur = filter_input(INPUT_POST, 'realisateur', FILTER_SANITIZE_NUMBER_INT);
            
            // Vérification si les champs requis sont vides
            if (!empty($film) && !empty($dateParution) && !empty($durer) && !empty($synopsis) && !empty($note) && !empty($afficheFilm)) {
                // Sanitize les données du formulaire avant de les utiliser
                $film = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $dateParution = filter_input(INPUT_POST, 'dateParution', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $durer = filter_input(INPUT_POST, 'durer', FILTER_SANITIZE_NUMBER_INT);
                $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $afficheFilm = filter_input(INPUT_POST, 'afficheFilm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                // Récupération des valeurs du formulaire
                $film = $_POST['titre'];
                $dateParution = $_POST['dateParution'];
                $durer = $_POST['durer'];
                $synopsis = $_POST['synopsis'];
                $note = $_POST['note'];
                $afficheFilm = $_POST['afficheFilm'];
                
                // Préparation de la requête SQL avec des paramètres nommés
                $requeteAddFilm = $pdo->prepare("
                INSERT INTO film (titre, dateParution, durer, synopsis, note, afficheFilm)
                VALUES (:titre, :dateParution, :durer, :synopsis, :note, :afficheFilm)
                ");

                // Liaison des paramètres pour l'ajout et son exécution
                $requeteAddFilm->bindParam('titre', $film);
                $requeteAddFilm->bindParam('dateParution', $dateParution);
                $requeteAddFilm->bindParam('durer', $durer);
                $requeteAddFilm->bindParam('synopsis', $synopsis);
                $requeteAddFilm->bindParam('note', $note);
                $requeteAddFilm->bindParam('afficheFilm', $afficheFilm);
                $requeteAddFilm->execute();
            }

            // Récupération de l'ID généré automatiquement (AUTO_INCREMENT)
            $id_film = $pdo->lastInsertId();

            // Attribuer un réalisateur dans la table 'film' 
            $requeteAttrReal = $pdo->prepare("
            UPDATE film
            SET id_realisateur = :id_realisateur
            WHERE id_film = :id_film
            ");

            // Liaison des paramètres pour la mise à jour et son exécution
            $requeteAttrReal->bindParam('id_film', $id_film);
            $requeteAttrReal->bindParam('id_realisateur', $id_realisateur );
            $requeteAttrReal->execute();

            // Récupération de l'ID généré automatiquement (AUTO_INCREMENT)
            $id_film = $pdo->lastInsertId();
            
            // Récupérer la valeur de id_genre du formulaire
            $id_genre = filter_input(INPUT_POST, 'id_genre', FILTER_SANITIZE_NUMBER_INT);

            // Attribuer un genre dans la table 'posseder'
            $requeteAttrGenre = $pdo->prepare("
            INSERT INTO posseder (id_film, id_genre)
            VALUES (:id_film, :id_genre)
            ");

            // Liaison des paramètres pour l'ajout et son exécution
            $requeteAttrGenre->bindParam('id_film', $id_film);
            $requeteAttrGenre->bindParam('id_genre', $id_genre );
            $requeteAttrGenre->execute();

            // Redirection vers la page de confirmation
            require "view/confirmation/confirmation.php";
        }

        // Redirection vers la page du formulaire pré-rempli du film
        require "view/film/addFilm.php";
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

            // Liaison des paramètres pour la mise à jour et son exécution
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

    public function DFilm($id) {
        // On se connecte 
        $pdo = Connect::seConnecter();
        // Suppression de genre dans la table posseder
        $requeteGenre = $pdo->prepare("
        DELETE
        FROM posseder
        WHERE posseder.id_film = :id_film
        ");

        // Liaison des paramètres pour la suppression et son exécution
        $requeteGenre->bindParam('id_film', $id);
        $requeteGenre->execute();

        // Suppression du film dans la table casting
        $requeteCastDel = $pdo->prepare("
        DELETE
        FROM casting
        WHERE casting.id_film = :id_film
        ");

        // Liaison des paramètres pour la suppression et son exécution
        $requeteCastDel->bindParam('id_film', $id);
        $requeteCastDel->execute();

        // Suppression du film dans la table film
        $requeteFilmDel = $pdo->prepare("
        DELETE
        FROM film
        WHERE film.id_film = :id_film
        ");

        // Liaison des paramètres pour la suppression et son exécution
        $requeteFilmDel->bindParam('id_film', $id);
        $requeteFilmDel->execute();

        // Redirection vers la page de confirmation
        require "view/confirmation/confirmation.php";
    }
}