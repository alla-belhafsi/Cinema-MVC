<?php require_once('functionNote.php'); 

ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body class="list-content">
        <div class="content">
            <h2><a class='columna' href='index.php?action=casting&id=<?= $film['id_film'] ?>'><?= $film['titre'] ?></a></h2>
            <p>Durée : <?= $film['dureeFilm'] ?></p>
            <p>Réalisateur : <a class='columna' href='index.php?action=listFilmographieR&id=<?= $film['id_realisateur'] ?>'><?= $realisateur['realisateur'] ?></a></p>
            <p>Année de sortie : <?= $film['anneeSortie'] ?></p>
            <p>Note : <?= afficherEtoiles($film['note']) ?></p>
        </div>
        
        <div class="content">
            <p>Acteur et son rôle :</p>
            <?php foreach ($requeteRole as $roles) { ?>
                <p><a class='columna' href='index.php?action=listFilmographieA&id=<?= $roles['id_acteur'] ?>'><?= $roles['acteur'] ?></a> dans le rôle de <?= $roles['role'] ?></p>
            <?php } ?>
        </div>
        
        <div class="contentSyn">
            <p>Synopsis :</p>
            <p><?= $film['synopsis'] ?></p>
        </div>

<?php
$showIconMenu = false;

$tabTitle = "Casting";

$title = "<div class='title'>Casting</div>";

$counter = "";

$list = "";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>