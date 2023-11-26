<!DOCTYPE html>
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

$titre = "<div class='title'>La liste des Films</div>";

$compteur = "<p class= 'counter'> Il y a <b>".$requeteLF->rowCount()."</b> Films<br><br></p>";

$liste = "
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
            $liste .= "
            <tr>
                <td class='column' id='selectCase'><a class='columna' href='index.php?action=casting&id=".$film['id_film']."'>".$film['titre']."</a><br></td>
                <td class='column' id='selectCase'>".$film['realisateur']."</td>
                <td class='tableCenter'>".$film['dureeHeure']."</td>
                <td class='tableCenter'>".$film['dateSortie']."</td>
            </tr>";
        }
$liste .= "</tbody>
</table>";

$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>