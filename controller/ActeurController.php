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

    // Lister les rôles
    public function roles() {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteRA = $pdo->query("
        SELECT DISTINCT
            acteur.id_acteur AS id_acteur, 
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            role.nom AS role
        FROM casting
        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN role ON casting.id_role = role.id_role
        ");

        require "view/roles.php";
    }

    // Lister les filmographies
    public function listFilmographieA($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        // On exécute la requête
        $requeteFGA = $pdo->prepare("
        SELECT 
            film.id_film AS id_film,
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
        $requeteFGA->bindParam('id_acteur', $id);
        $requeteFGA->execute();

        require "view/listFilmographieA.php";
    }

    public function formActeur($id) {
        // On se connecte
        $pdo = Connect::seConnecter();
    
        // Récupération des données actuelles du réalisateur
        $requeteIA = $pdo->prepare("
        SELECT 
            prenom, 
            nom, 
            dateNaissance, 
            sexe,
            acteur.id_acteur
        FROM personne
        INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        WHERE id_acteur = :id_acteur
        ");
        $requeteIA->bindParam('id_acteur', $id);
        $requeteIA->execute();
        $IA = $requeteIA->fetch();

        // Redirection vers la page des paramètres du réalisateur
        require "view/ParamActeur.php";
    }

    // Modification ou ajout d'un acteur dans la BDD (UPDATE & ADD)
    public function UActeur($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        if (isset($_POST['modifier'])) {
            // Sanitize les données du formulaire avant de les utiliser
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Exécution de la requête de mise à jour
            $requeteUA = $pdo->prepare("
            UPDATE personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            SET 
              prenom = :prenom, 
              nom = :nom, 
              dateNaissance = :dateNaissance,
              sexe = :sexe
            WHERE id_acteur = :id_acteur
            ");

            // Liaison des paramètres pour la mise à jour 
            $requeteUA->bindParam('prenom', $prenom);
            $requeteUA->bindParam('nom', $nom);
            $requeteUA->bindParam('dateNaissance', $dateNaissance);
            $requeteUA->bindParam('sexe', $sexe);
            $requeteUA->bindParam('id_acteur', $id);
            $requeteUA->execute();
    
            // Redirection vers la page de confirmation
            require "view/confirmation.php";
        }
        
        // Redirection vers la page des paramètres du réalisateur
        require "view/ParamActeur.php";
    }
}