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

$tabTitle = "Rôles";

$title = "<div class='title'>La liste des rôles</div>";

$counter = "<p class= 'counter'> Il y a <b>".$requeteRA->rowCount()."</b> rôles<br><br></p>";

$list = "
<table class='table'>
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Acteur</th>
            </tr>
        </thead>
        <tbody>";
            foreach ($requeteRA->fetchAll() as $roles) { 
                $list .=
                "<tr>
                    <td class='column'>".$roles['role']."</td>
                    <td class='column' id='selectCase'>
                        <a class='columna' href='index.php?action=listFilmographieA&id=".$roles['id_acteur']."'>".$roles['acteur']."</a><br>
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