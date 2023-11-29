<?php ob_start(); 

$FGR = $requeteFGR->fetchAll(); // Stocker les détails des films dans une variable séparée
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>
        <?php foreach ($FGR as $films) { ?>
            <div class="content">
                <h2><a class='columna' href='index.php?action=casting&id=<?= $films['id_film'] ?>'><?= $films['film'] ?></a></h2>
                <p>Genre : <?= $films['genres'] ?></p>
                <p>Durée : <?= $films['dureeFilm'] ?></p>
                <p>Année de sortie : <?= $films['dateSortie'] ?></p>
            </div>
        <?php } ?>
<?php
$showIconMenu = false;

$tabTitle = "Filmographie";

$title = "<div class='title'>Filmographie de ".$films['realisateur']."</div>";

$counter = "";

$list = "";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>
