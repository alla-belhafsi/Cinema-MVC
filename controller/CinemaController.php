<?php

// Un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Controller;

// Utilisation du "use" pour accéder à la classe Connect
use Model\Connect;

class CinemaController {
    // Lister les Réalisateurs/Réalisatrices
    public function listRealisateurs() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteLR = $pdo->query("
        SELECT 
            realisateur.id_realisateur,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            personne.dateNaissance AS dateNaissance,
            personne.sexe
            FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            ORDER BY personne.dateNaissance DESC
        ");
        
        // Redirection vers la page de la liste des réalisateurs
        require "view/realisateur/listRealisateurs.php";
    }

    public function casting($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On excécute la première requête  
        $requeteCasting = $pdo->prepare("
        SELECT
            film.id_film,
            film.id_realisateur,
            film.titre AS titre,
            film.note AS note,
            film.synopsis AS synopsis,
            DATE_FORMAT(film.dateParution, '%Y') AS anneeSortie,
            TIME_FORMAT(SEC_TO_TIME(film.durer*60),'%H:%i') AS dureeFilm,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur
        FROM film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE film.id_film = :id_film
        ");

        // Liaison du paramètre id_film et exécution de la requête
        $requeteCasting->bindParam('id_film', $id);
        $requeteCasting->execute();

        // Récupération de l'information 
        $casting = $requeteCasting->fetch();

        // On exécute la deuxième requête acteur et son role ==================
        $requeteRole = $pdo->prepare("
        SELECT 
            film.id_film,
            film.id_realisateur,
            acteur.id_acteur AS id_acteur,
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            role.nom AS role,
            personne.sexe AS sexe
        FROM casting
        INNER JOIN film ON casting.id_film = film.id_film
        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
        INNER JOIN role ON casting.id_role = role.id_role
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        WHERE film.id_film = :id_film
        ");

        // Liaison du paramètre :id_film et exécution de la requête
        $requeteRole->bindParam('id_film', $id);
        $requeteRole->execute();

        // Récupération de tous les informations
        $roles = $requeteRole->fetchAll();

        // Redirection vers la page du casting d'un film
        require "view/film/casting.php";
    }

    // Lister les filmographies
    public function listFilmographieR($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteFGR = $pdo->prepare("
        SELECT 
            film.id_film AS id_film,
            film.titre AS film,
            TIME_FORMAT(SEC_TO_TIME(film.durer*60),'%H:%i') AS dureeFilm,
            CONCAT(personne.prenom, ' ', personne.nom) AS realisateur,
            DATE_FORMAT(film.dateParution, '%Y') AS dateSortie,
            GROUP_CONCAT(genres_film.libelle SEPARATOR ' - ') AS genres
        FROM film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        INNER JOIN (
            SELECT 
                id_film,
                genre.libelle
                FROM posseder
            INNER JOIN genre ON posseder.id_genre = genre.id_genre) AS genres_film ON film.id_film = genres_film.id_film
            WHERE realisateur.id_realisateur = :id_realisateur
            GROUP BY film.id_film
            ");

        // Liaison du paramètre :id_realisateur et exécution de la requête
        $requeteFGR->bindParam('id_realisateur', $id);
        $requeteFGR->execute();
        
        // Redirection vers la page de la liste des films d'un réalisateur
        require "view/realisateur/listFilmographieR.php";
    }

    public function formRealisateur($id) {
        // On se connecte
        $pdo = Connect::seConnecter();
    
        // Récupération des données actuelles du réalisateur
        $requeteIR = $pdo->prepare("
        SELECT 
            prenom, 
            nom, 
            dateNaissance, 
            sexe,
            realisateur.id_realisateur
        FROM personne
        INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        WHERE id_realisateur = :id_realisateur
        ");

        // Liaison des paramètres pour la requête et exécution
        $requeteIR->bindParam('id_realisateur', $id);
        $requeteIR->execute();

        // Récupération de l'information
        $IR = $requeteIR->fetch();

        // Redirection vers la page du formulaire pré-rempli du réalisateur
        require "view/realisateur/formRealisateur.php";
    }

    // Ajout d'un réalisateur et son identité (personne) dans la BDD (ADD)
    public function ARealisateur() {
        // On se connecte
        $pdo = Connect::seConnecter();

        if (isset($_POST['ajouter'])) {
            // Sanitize les données du formulaire avant de les utiliser
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Préparation de la requête SQL avec des paramètres nommés
            $requeteAReal = $pdo->prepare("
            INSERT INTO personne (prenom, nom, dateNaissance, sexe)
            VALUES (:prenom, :nom, :dateNaissance, :sexe)
            ");

            // Liaison des paramètres pour la requête et éxecution
            $requeteAReal->bindParam('prenom', $prenom);
            $requeteAReal->bindParam('nom', $nom);
            $requeteAReal->bindParam('dateNaissance', $dateNaissance);
            $requeteAReal->bindParam('sexe', $sexe);
            $requeteAReal->execute();

            // Récupération de l'ID généré automatiquement (AUTO_INCREMENT)
            $id_personne = $pdo->lastInsertId();

            // Insertion dans la table 'realisateur'
            $requeteRealisateur = $pdo->prepare("
            INSERT INTO realisateur (id_personne)
            VALUES (:id_personne)
            ");

            // Liaison du paramètre pour l'ID personne et exécution
            $requeteRealisateur->bindParam('id_personne', $id_personne);
            $requeteRealisateur->execute();

            // Redirection vers la page de confirmation
            require "view/confirmation/confirmation.php";
        }

        // Redirection vers le formulaire vierge pour ajouter un Réalisateur
        require "view/realisateur/addRealisateur.php";
    }
    
    // Modification d'un réalisateur dans la BDD (UPDATE)
    public function URealisateur($id) {
        // On se connecte
        $pdo = Connect::seConnecter();
    
        if (isset($_POST['modifier'])) {
            // Sanitize les données du formulaire avant de les utiliser
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Exécution de la requête de mise à jour
            $requeteUR = $pdo->prepare("
            UPDATE personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            SET 
              prenom = :prenom, 
              nom = :nom, 
              dateNaissance = :dateNaissance,
              sexe = :sexe
            WHERE id_realisateur = :id_realisateur
            ");

            // Liaison des paramètres pour la mise à jour 
            $requeteUR->bindParam('prenom', $prenom);
            $requeteUR->bindParam('nom', $nom);
            $requeteUR->bindParam('dateNaissance', $dateNaissance);
            $requeteUR->bindParam('sexe', $sexe);
            $requeteUR->bindParam('id_realisateur', $id);
            $requeteUR->execute();
    
            // Redirection vers la page de confirmation
            require "view/confirmation/confirmation.php";
        }
        
        // Redirection vers la page du formulaire pré-rempli du réalisateur
        require "view/realisateur/formRealisateur.php";
    }

    // Quand projet touche à la fin, prévoir un DELETE ON CASCADE en option
    // Supprimer un réalisateur dans la BDD (DELETE) [Option clé étrangère nullable]
    public function DRealisateur($id) {
        // On se connecte
        $pdo = Connect::seConnecter();
    
        $requeteSetNull = $pdo->prepare("
        UPDATE film
        SET id_realisateur = NULL
        WHERE id_realisateur = :id_realisateur
        ");
            
        // Liaison des paramètres pour la mise à jour
        $requeteSetNull->bindParam('id_realisateur', $id);
        $requeteSetNull->execute();

        // Suppression du réalisateur dans la table realisateur
        $requeteLastDel = $pdo->prepare("
        DELETE 
            realisateur, 
            personne 
        FROM realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE id_realisateur = :id_realisateur
        ");

        // Liaison des paramètres pour la mise à jour 
        $requeteLastDel->bindParam('id_realisateur', $id);
        $requeteLastDel->execute();

        // Redirection vers la page de confirmation
        require "view/confirmation/confirmation.php";
    }
}