<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="container2">
<?php

$showIconMenu = false;

$tabTitle = "Films";

$title = "<div class='title'>La liste des Films</div>";

$counter = "<p class= 'counter'> Il y a <b>".$requeteLF->rowCount()."</b> Films<br><br></p>";

$list = "
<table class='table'>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Réalisateur</th>
            <th>Durée</th>
            <th>Date de Sortie</th>
        </tr>
    </thead>
    <tbody>";
        foreach ($requeteLF->fetchAll() as $film) { 
            $list .= "
            <tr>
                <td class='column' id='selectCase'><a class='columna' href='index.php?action=casting&id=".$film['id_film']."'>".$film['titre']."</a><br></td>
                <td class='column' id='selectCase'>".$film['realisateur']."</td>
                <td class='tableCenter'>".$film['dureeHeure']."</td>
                <td class='tableCenter'>".$film['dateSortie']."</td>
            </tr>";
        }
$list .= "</tbody>
</table>";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>