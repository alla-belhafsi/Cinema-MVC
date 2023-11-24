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
echo $film['titre'] . "<br>"; // Ajout du titre du film à la liste
echo "Durée : ".$film['dureeFilm'] . "<br>";
echo "Réalisateur : ".$realisateur['realisateur'] . "<br>";
echo "Année de sortie : ".$film['anneeSortie'] . "<br>";
echo "Note : " . afficherEtoiles($film['note']) . "<br>";
echo "Acteur et son rôle :<br>";
foreach ($requeteCasting->fetchAll() as $casting) {
    echo $casting['acteur'] . " dans le rôle de " . $casting['role'] . "<br>"; // Ajout des détails du casting à la liste
}

echo $liste; // Affichage de la liste complète



$requete = ob_get_clean();

require_once "template.php";
?>
</body>
</html>
