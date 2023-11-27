<?php 

use Controller\CinemaController;
use Controller\ActeurController;
use Controller\FilmController;


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();
$ctrlFilm = new FilmController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["film"])) ? $_GET["film"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        
        case "listFilms" : $ctrlFilm->listFilms($id); break;
        case "listActeurs" : $ctrlActeur->listActeurs($id); break;
        case "listFilmographie" : $ctrlActeur->listFilmographie($id); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs($id); break;
        case "casting" : $ctrlCinema->casting($id); break;
    }
}
?>

<?php ob_start(); 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
<title><?= $tabTitle ?></title>
<body>

</body>
</html>

<?php
// Afficher le Menu d'icônes et le fond d'écran seulement à la Page d'accueil
$showIconMenu = true;

// Afficher le titre de l'onglet
$tabTitle = "CINEFYLE";

$query = ob_get_clean();
require_once "view/template.php";