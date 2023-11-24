<!DOCTYPE html>
<html lang="en">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

</head>
<body>
<?php ob_start();

$titre = "La liste des réalisateurs et réalisatrices";

$type = "<p> Il y a <b>".$requeteLR->rowCount()."</b> réalisateurs et réalisatrices<br><br></p>";

$liste = "
<table>
    <thead>
        <tr class='column'>
            <th class='column'>Réalisateur</th>
            <th class='column'>Date de Naissance</th>
            <th class='column'>SEXE</th>
        </tr>
        </thead>
        <tbody>";
            foreach ($requeteLR->fetchAll() as $personne) { 
                $liste .=
                "<tr> 
                    <td class='column'>".$personne['realisateur']."</td>
                    <td class='tableCenter'>".$personne['dateNaissance']."</td>
                    <td class='tableCenter'>".$personne['sexe']."</td>
                </tr>";
            }
$liste .= "</tbody>
</table>";

$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>