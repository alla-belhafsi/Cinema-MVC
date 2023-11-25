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
        case "listRealisateurs" : $ctrlCinema->listRealisateurs($id); break;
        case "casting" : $ctrlCinema->casting($id); break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
<?php ob_start(); ?>

<div></div>
</head>
<body class="container">
    <div></div>
</body>
<?php

$titre = "Application Cinema";

$type = "";

$liste = "";

$requete = ob_get_clean();

require_once "view/template.php";
?>   

</html>


<!-- $navbar = "
<div class='menu'>
    <div class='eye' id='toggle'>
        <span href='#'><ion-icon name='eye-outline'></ion-icon></span>
    </div>
    <ul class='menu-list'>
        <li class='icon' style='--i:1;--clr:#1877f2'>
            <a href='index.php?action=casting'><ion-icon name='videocam-outline'></ion-icon>Castings</a>
        </li>
        <li class='icon' style='--i:2;--clr:#1877f2'>
            <a href='index.php?action=listActeurs'><ion-icon name='star-outline' class='icon'></ion-icon></ion-icon>Acteurs</a>
        </li>
        <li class='icon' style='--i:3;--clr:#1877f2'>
            <a href='index.php?action=listFilms'><ion-icon name='film-outline'></ion-icon>Films</a>
        </li>
        <li class='icon' style='--i:4;--clr:#1877f2'>
            <a href='index.php?action=listRealisateurs'><ion-icon name='people-outline'></ion-icon></ion-icon>Réalisateurs</a>
        </li>
    </ul>
</div>
"; -->