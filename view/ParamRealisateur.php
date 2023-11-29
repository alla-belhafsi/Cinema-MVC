<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<?php
?>
    <h1>Modifier un réalisateur</h1><br>
    
    <!-- Formulaire prérempli pour la modification -->
    <form action="index.php?action=UARealisateur&id=<?= $id ?>" method="POST">
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $IR['prenom'] ?>"><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $IR['nom'] ?>"><br><br>
        
        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" id="dateNaissance" name="dateNaissance" value="<?= date('Y-m-d', strtotime($IR['dateNaissance'])) ?>"><br><br>
        
        <label for="sexe">Sexe :</label>
        <input type="text" id="sexe" name="sexe" value="<?= $IR['sexe'] ?>"><br><br>
        
        <input type="submit" name= "modifier" value="Modifier">
        
    </form>
    
    <input type="submit" name= "supprimer" value="Supprimer">

<?php

$showIconMenu = false;

$tabTitle = "Paramètres du réalisateur";

$title = "<div class='title'>Paramètres du réalisateur</div>";

$counter = "";

$list = "";

$id = $_GET['id'];

$query = ob_get_clean();
require_once "template.php"; 
?>
</body>
</html>