<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="container2">
<?php

$showIconMenu = false;

$tabTitle = "Réalisateurs";

$title = "<div class='title'>La liste des réalisateurs et réalisatrices</div>";

$counter = "<p class= 'counter'> Il y a <b>".$requeteLR->rowCount()."</b> réalisateurs et réalisatrices<br><br></p>";

$list = "<table class='table'>"; // Initialise la variable pour la liste des réalisateurs


$list .= "
<thead>
    <tr>
        <th>Nom du réalisateur</th>
        <th>Date de naissance</th>
        <th>Sexe</th>
    </tr>
</thead>
<tbody>";
foreach ($requeteLR->fetchAll() as $realisateur) { 
    $list .="
    <tr>
        <td class='column'>
            <a class='columna' href='index.php?action=listFilmographieR&id=".$realisateur['id_realisateur']."'>".$realisateur['realisateur']."</a></td>
        <td class='tableCenter'>
            ". date('d-m-Y', strtotime($realisateur['dateNaissance'])) ."
        </td>
        <td class='tableCenter'>
            ".$realisateur['sexe']."
        </td>
        <td class='tableCenterUD'>
            <a class='columna' href='index.php?action=UDRealisateurs&id=".$realisateur['id_realisateur']."'>
                <ion-icon name='settings-outline'></ion-icon>
            </a>
        </td>
    </tr>";
}
$list .= "
</tbody>
</table>";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>