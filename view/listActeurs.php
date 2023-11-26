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

$titre = "<div class='title'>La liste des acteurs et actrices</div>";

$compteur = "<p class= 'counter'> Il y a <b>".$requeteLA->rowCount()."</b> acteurs et actrices<br><br></p>";

$liste = "
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