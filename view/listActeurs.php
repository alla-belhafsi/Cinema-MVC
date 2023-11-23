<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

</head>
<body>
<?php ob_start(); 

$titre = "La liste des acteurs et actrices";

$type = "<p> Il y a ".$requete->rowCount()." acteurs et actrices</p>";

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
            foreach ($requete->fetchAll() as $personne) { 
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