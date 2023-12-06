<?php

// Un namespace permettant de catégoriser virtuellement (dans un espace de nom la classe en question)
namespace Controller;

// Utilisation du "use" pour accéder à la classe Connect
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
        
        // Redirection vers la page de la liste des acteurs
        require "view/acteur/listActeurs.php";
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
        ");

        // Liaison du paramètre :id_acteur et exécution de la requête
        $requeteFGA->bindParam('id_acteur', $id);
        $requeteFGA->execute();
        
        // Redirection vers la page de la liste des films d'un acteur
        require "view/acteur/listFilmographieA.php";
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

        // Liaison des paramètres pour la requête et exécution
        $requeteIA->bindParam('id_acteur', $id);
        $requeteIA->execute();

        // Récupération de l'information
        $IA = $requeteIA->fetch();

        // Redirection vers la page du formulaire pré-rempli de l'acteur
        require "view/acteur/formActeur.php";
    }

    // Ajout d'un acteur et son identité (personne) dans la BDD (ADD)
    public function AActeur() {
        // On se connecte
        $pdo = Connect::seConnecter();

        if (isset($_POST['ajouter'])) {
            // Sanitize les données du formulaire avant de les utiliser
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Préparation de la requête SQL avec des paramètres nommés
            $requeteAA = $pdo->prepare("
            INSERT INTO personne (prenom, nom, dateNaissance, sexe)
            VALUES (:prenom, :nom, :dateNaissance, :sexe)
            ");

            // Liaison des paramètres pour la requête et exécution
            $requeteAA->bindParam('prenom', $prenom);
            $requeteAA->bindParam('nom', $nom);
            $requeteAA->bindParam('dateNaissance', $dateNaissance);
            $requeteAA->bindParam('sexe', $sexe);
            $requeteAA->execute();

            // Récupération de l'ID généré automatiquement
            $id_personne = $pdo->lastInsertId();

            // Insertion dans la table 'acteur'
            $requeteActeur = $pdo->prepare("
                INSERT INTO acteur (id_personne)
                VALUES (:id_personne)
            ");

            // Liaison du paramètre pour l'ID personne et exécution
            $requeteActeur->bindParam('id_personne', $id_personne);
            $requeteActeur->execute();
    
            // Redirection vers la page de confirmation de l'ajout
            require "view/confirmation/confirmation.php";
        }
        
        // Redirection vers le formulaire vierge pour ajouter un Acteur
        require "view/acteur/addActeur.php";
    }

    // Modification d'un acteur dans la BDD (UPDATE)
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
            require "view/confirmation/confirmation.php";
        }
        
        // Redirection vers la page du formulaire pré-rempli de l'acteur
        require "view/acteur/formActeur.php";
    }

    public function DActeur($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        // Suppression de l'acteur, de son rôle et de son film dans la table casting ainsi que du rôle, dans la table role
        $requeteRoleCastDel = $pdo->prepare("
        DELETE 
            role,
            casting
        FROM casting
        INNER JOIN role ON casting.id_role = role.id_role
        WHERE id_acteur = :id_acteur
        ");

        // Liaison des paramètres pour la mise à jour 
        $requeteRoleCastDel->bindParam('id_acteur', $id);
        $requeteRoleCastDel->execute();

        // Suppression de l'acteur dans la table acteur
        $requeteFinalDel = $pdo->prepare("
        DELETE 
            acteur,
            personne
        FROM acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        WHERE id_acteur = :id_acteur
        ");

        // Liaison des paramètres pour la mise à jour 
        $requeteFinalDel->bindParam('id_acteur', $id);
        $requeteFinalDel->execute();

        // Redirection vers la page de confirmation de la suppression
        require "view/confirmation/confirmation.php";
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
        role.nom AS role,
        role.id_role AS id_role
        FROM casting
        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN role ON casting.id_role = role.id_role
        ");

        // Récupération des résultats avec fetch
        $listRoles = $requeteRA->fetchAll();
        
        // Redirection vers la page de la liste des rôles
        require "view/acteur/roles.php";
    }

    public function formRole($id) {
        // On se connecte
        $pdo = Connect::seConnecter();
    
        // Récupération des données actuelles du rôle
        $requeteIRole = $pdo->prepare("
        SELECT 
            film.titre AS film,
            film.id_film AS id_film,
            acteur.id_acteur AS id_acteur,
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur,
            role.nom AS role,
            role.id_role AS id_role
        FROM casting
        INNER JOIN film ON casting.id_film = film.id_film
        INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
        INNER JOIN role ON casting.id_role = role.id_role
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        WHERE role.id_role = :id_role
        ");

        // Liaison des paramètres pour la requête et exécution
        $requeteIRole->bindParam('id_role', $id);
        $requeteIRole->execute();

        // Récupération de l'information
        $IRole = $requeteIRole->fetch();

        // Récupération des données actuelles des acteurs
        $requeteIAct = $pdo->query("
        SELECT
            acteur.id_acteur AS id_acteur,
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur
        FROM acteur
        INNER JOIN personne on acteur.id_personne = personne.id_personne
        ");

        // Récupération de tous les informations
        $Acts = $requeteIAct->fetchAll(); 

        // Récuperation des données actuelles des films
        $requeteIFilm = $pdo->query("
        SELECT
            film.titre AS film,
            film.id_film AS id_film
        FROM film
        ");

        // Récupération de tous les informations
        $Films = $requeteIFilm->fetchAll();

        // Redirection vers la page du formulaire pré-rempli du rôle
        require "view/acteur/formRole.php";
    }

    // Ajout d'un rôle, le relier à son acteur et à son film
    public function ARole() {
        // On se connecte
        $pdo = Connect::seConnecter();
        
        // On exécute une première requête
        $listActs = $pdo->query("
        SELECT
            acteur.id_acteur AS id_acteur,
            CONCAT(personne.prenom, ' ', personne.nom) AS acteur
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ");
            
            // On exécute une deuxième requête
            $listFilms = $pdo->query("
            SELECT
            film.id_film AS id_film,
            film.titre AS film
            FROM film
            ");
            
            if (isset($_POST['ajouter'])) {
                // Sanitize les données du formulaire avant de les utiliser
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                // Vérification si les champs requis sont vides
                if (!empty($nom)) {
                    // Sanitize les données du formulaire avant de les utiliser
                    $id_acteur = filter_input(INPUT_POST, 'acteur', FILTER_SANITIZE_NUMBER_INT);
                    $film = filter_input(INPUT_POST, 'film', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    // Récupération des valeurs du formulaire
                    $nom = $_POST['nom'];
                    $id_acteur = $_POST['acteur'];
                    $film = $_POST['film'];
                    
                    // Préparation de la requête SQL avec des paramètres nommés
                    $requeteAddRole = $pdo->prepare("
                    INSERT INTO role (nom)
                    VALUES (:nom)
                ");

                // Liaison des paramètres pour la requête et exécution
                $requeteAddRole->bindParam('nom', $nom);
                $requeteAddRole->execute();
            } 

            // Récupération de l'ID généré automatiquement (AUTO_INCREMENT)
            $id_role = $pdo->lastInsertId();

            // Insertion dans la table 'casting'
            $requeteAttrRole = $pdo->prepare("
            INSERT INTO casting (id_role, id_acteur, id_film)
            VALUES (:id_role, :id_acteur, :id_film)
            ");

            // Liaison des paramètres pour la requête et exécution
            $requeteAttrRole->bindParam('id_role', $id_role);
            $requeteAttrRole->bindParam('id_acteur', $id_acteur);
            $requeteAttrRole->bindParam('id_film', $film);
            $requeteAttrRole->execute();

            // Redirection vers le formulaire vierge pour ajouter un Rôle
            require "view/confirmation/confirmation.php";
        }

        // Redirection vers le formulaire vierge pour ajouter un Rôle et le relier avec l'acteur et le film souhaité
        require "view/acteur/addRole.php";
    }

    public function URole($id) {
        // On se connecte
        $pdo = Connect::seConnecter();

        if (isset($_POST['modifier'])) {
            // Sanitize les données du formulaire avant de les utiliser
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id_acteur = filter_input(INPUT_POST, 'acteur', FILTER_SANITIZE_NUMBER_INT);
            $id_film = filter_input(INPUT_POST, 'film', FILTER_SANITIZE_NUMBER_INT);

            // Exécution de la première requête de mise à jour du rôle
            $requeteURole = $pdo->prepare("
            UPDATE role
            SET role.nom = :nom
            WHERE role.id_role = :id_role
            ");

            // Liaison des paramètres pour la mise à jour
            $requeteURole->bindParam('id_role', $id);
            $requeteURole->bindParam('nom', $nom);
            $requeteURole->execute();
            
            // Exécution de la deuxième requête de mise à jour de la table casting
            $requeteUCast = $pdo->prepare("
            UPDATE casting
            SET  
                casting.id_acteur = :id_acteur,
                casting.id_film = :id_film
            WHERE casting.id_role = :id_role
            ");
            
            // Liaison des paramètres pour la mise à jour
            $requeteUCast->bindParam('id_role', $id);
            $requeteUCast->bindParam('id_acteur', $id_acteur);
            $requeteUCast->bindParam('id_film', $id_film);
            $requeteUCast->execute();

            // Redirection vers la page de confirmation
            require "view/confirmation/confirmation.php";
        }

        // Redirection vers la page du formulaire pré-rempli du réalisateur
        require "view/acteur/formRole.php";
    }
}