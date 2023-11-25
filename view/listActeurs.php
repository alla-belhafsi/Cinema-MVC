<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

</head>
<body>
<?php ob_start();

// $navbar = "
// <a href='index.php'><b>MENU</b></a>
// <a href='index.php?action=listFilms'><b>Les Films</b></a>
// <a href='index.php?action=listRealisateurs'><b>Les Réalisateurs</b></a>";

$titre = "La liste des acteurs et actrices";

$type = "<p> Il y a <b>".$requeteLA->rowCount()."</b> acteurs et actrices<br><br></p>";

$liste = "
<table>
        <thead>
            <tr class='column'>
                <th class='column'>Acteur</th>
                <th class='column'>Date de Naissance</th>
                <th class='column'>SEXE</th>
            </tr>
        </thead>
        <tbody>";
            foreach ($requeteLA->fetchAll() as $personne) { 
                $liste .=
                "<tr>
                    <td class='column'>".$personne["acteur"]."</td>
                    <td class='tableCenter'>".$personne['dateNaissance']."</td>
                    <td class='tableCenter'>".$personne["sexe"]."</td>
                </tr>";
            } 
$liste .= "</tbody>
</table>";

$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>