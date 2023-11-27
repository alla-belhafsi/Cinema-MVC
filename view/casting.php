<?php require_once('functionNote.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<?php ob_start();

$background = "
<div class='home-background'>
    <img src='public/img/Home-background.jpg' alt='background-image'>
</div>
";

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

$titre = "<div class='title'>Casting</div>";

$compteur = "";

$liste = "
<a class='columna' href='index.php?action=casting&id=" . $film['id_film'] . "'>".$film['titre']."</a><br>
<p>Durée : ".$film['dureeFilm'] . "</p>
<p>Réalisateur : <a class='columna' href='index.php?action=listRealisateurs&id=" . $film['id_realisateur'] . "'>".$realisateur['realisateur']."</a></p>
<p>Année de sortie : ".$film['anneeSortie'] . "</p>
<p>Note : " . afficherEtoiles($film['note']) . "</p><br>
<p>Acteur et son rôle : </p>";

foreach ($requeteRole->fetchAll() as $roles) {
    $liste .= "<p>" . $roles['acteur'] . " dans le rôle de " . $roles['role'] . "</p>";
}

$liste .= "<br><p>Synopsis :</p><p>" . $film['synopsis'] . "</p>";



$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>
