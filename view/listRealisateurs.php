<!DOCTYPE html>
<html lang="en">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="container2">
<?php ob_start();

$navbar = "
<nav class='navbar'>
    <h1 class='leftNav'><a href='index.php'>CINEFYLE</a></h1>
    <mid class='midNav'>
        <ul class=midMidNav'>
            <a href='index.php?action=listFilms'>FILMS</a>
            <a href='index.php?action=listActeurs'>ACTEURS</a>
            <a href='index.php?action=listRealisateurs'>RÉALISATEURS</a>
            <a href='#'>RÔLES</a>
        </ul>
    </mid>
    <right class='rightNav'>
        <ul class='rightRightNav'>
            <i class='fa-brands fa-twitter' style='color: #C49C5F;'></i>
            <i class='fa-brands fa-facebook-f' style='color: #C49C5F;'></i>
            <i class='fa-brands fa-instagram' style='color: #C49C5F;'></i>
        </ul>
    </right>    
</nav>
";

$titre = "<div class='title'>La liste des réalisateurs et réalisatrices</div>";

$compteur = "<p class= 'counter'> Il y a <b>".$requeteLR->rowCount()."</b> réalisateurs et réalisatrices<br><br></p>";

$liste = "<table class='table'>"; // Initialise la variable pour la liste des réalisateurs


$liste .= "
<thead>
    <tr>
        <th>Nom du réalisateur</th>
        <th>Date de naissance</th>
        <th>Sexe</th>
    </tr>
</thead>
<tbody>";
foreach ($requeteLR->fetchAll() as $realisateur) { 
    $liste .="
    <tr>
        <td class='column'><a class='columna' href='index.php?action=casting&id=".$realisateur['id_realisateur']."'>".$realisateur['realisateur']."</a></td>
        <td class='tableCenter'>". date('d-m-Y', strtotime($realisateur['dateNaissance'])) ."</td>
        <td class='tableCenter'>".$realisateur['sexe']."</td>
    </tr>";
}
$liste .= "
</tbody>
</table>";

$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>