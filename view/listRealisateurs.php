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

$liste = '<table>'; // Initialise la variable pour la liste des réalisateurs


$liste .= '
<thead>
    <tr>
        <th>Nom du réalisateur</th>
        <th>Date de naissance</th>
        <th>Sexe</th>
    </tr>
</thead>
<tbody>';


foreach ($requeteLR->fetchAll() as $realisateur) { 
    
        $liste .=
            "<tr>
                <td class='column'><a href='index.php?action=casting&id=".$realisateur['id_realisateur']."'>".$realisateur['realisateur']."</a></td>
                <td class='tableCenter'>". date('d-m-Y', strtotime($realisateur['dateNaissance'])) ."</td>

                <td class='tableCenter'>".$realisateur['sexe']."</td>
            </tr>";
}
$liste .= "</tbody>
</table>";


$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>