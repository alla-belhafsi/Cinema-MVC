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

$showIconMenu = false;

$tabTitle = "Acteurs";

$title = "
<div class='title'>La liste des acteurs et actrices</div>";

$counter = "
<p class= 'counter'> Il y a <b>".$requeteLA->rowCount()."</b> acteurs et actrices<br></p>
<div class= 'add'>
    
    <p>Ajouter un acteur ou une actrice <a href='index.php?action=AActeur&id=".$AActeur['id_acteur']."'> 
        <ion-icon name='person-add-outline'></ion-icon>
    </a></p><br><br>
</div>";

$list = "
<table class='table'>
        <thead>
            <tr>
                <th>Acteur</th>
                <th>Date de Naissance</th>
                <th>SEXE</th>
            </tr>
        </thead>
        <tbody>";
            foreach ($requeteLA->fetchAll() as $personne) { 
                $list .=
                "<tr>
                    <td class='column' id='selectCase'><a class='columna' href='index.php?action=listFilmographieA&id=".$personne['id_acteur']."'>".$personne['acteur']."</a><br></td>
                    <td class='tableCenter'>".$personne['dateNaissance']."</td>
                    <td class='tableCenter'>".$personne["sexe"]."</td>
                    <td class='tableCenterUD'>
                        <a class='columna' href='index.php?action=formActeur&id=".$personne['id_acteur']."'>
                            <ion-icon name='settings-outline'></ion-icon>
                        </a>
                    </td>
                </tr>";
            } 
$list .= "</tbody>
</table>";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>