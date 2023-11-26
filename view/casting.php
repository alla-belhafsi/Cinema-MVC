<?php require_once('functionNote.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="container2">
<?php ob_start();

$navbarOne = "";

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

$liste = ""; // Initialisation de la variable $liste
echo "<a class='columna' href='index.php?action=casting&id=" . $film['id_film'] . "'>".$film['titre']."</a><br>";
echo "Durée : ".$film['dureeFilm'] . "<br>";
echo "Réalisateur : <a class='columna' href='index.php?action=listRealisateurs&id=" . $film['id_realisateur'] . "'>".$realisateur['realisateur']."</a><br>";
echo "Année de sortie : ".$film['anneeSortie'] . "<br>";
echo "Note : " . afficherEtoiles($film['note']) . "<br>";
echo "<br>Acteur et son rôle :<br>";
foreach ($requeteRole->fetchAll() as $roles) {
    echo $roles['acteur'] . " dans le rôle de " . $roles['role'] . "<br>";
}
echo "<br>Synopsis :<br>".$film['synopsis'];

echo $liste; // Affichage de la $liste complète

$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>
