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
$titre = "Casting";
$type = "";
$liste = ""; // Initialisation de la variable $liste
echo "<a href='index.php?action=casting&id=" . $film['id_film'] . "'>".$film['titre']."</a><br>";
echo "Durée : ".$film['dureeFilm'] . "<br>";
echo "Réalisateur : <a href='index.php?action=listRealisateurs&id=" . $film['id_realisateur'] . "'>".$realisateur['realisateur']."</a><br>";
echo "Année de sortie : ".$film['anneeSortie'] . "<br>";
echo "Note : " . afficherEtoiles($film['note']) . "<br>";
echo "<br>Acteur et son rôle :<br>";
foreach ($requeteRole->fetchAll() as $roles) {
    echo $roles['acteur'] . " dans le rôle de " . $roles['role'] . "<br>";
}
echo "<br>Synopsis :<br>".$film['synopsis'];

echo $liste; // Affichage de la liste complète


$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>
