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

// $id = (isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["film"])) ? $_GET["film"] : null;
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        
        case "listFilms" : $ctrlFilm->listFilms(); break;
        case "listActeurs" : $ctrlActeur->listActeurs(); break;
        case "roles" : $ctrlActeur->roles(); break;
        case "listFilmographieA" : $ctrlActeur->listFilmographieA($id); break;
        case "formActeur" : $ctrlActeur->formActeur($id); break;
        case "AActeur" : $ctrlActeur->AActeur(); break;
        case "UActeur" : $ctrlActeur->UActeur($id); break;
        case "DActeur" : $ctrlActeur->DActeur($id); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "listFilmographieR" : $ctrlCinema->listFilmographieR($id); break;
        case "formRealisateur" : $ctrlCinema->formRealisateur($id); break;
        case "ARealisateur" : $ctrlCinema->ARealisateur(); break;
        case "URealisateur" : $ctrlCinema->URealisateur($id); break;
        case "DRealisateur" : $ctrlCinema->DRealisateur($id); break;
        case "confirmation" : $ctrlCinema->confirmation(); break;
        case "casting" : $ctrlCinema->casting($id); break;
    }
} else {
    // HOME PAGE //

    // Afficher le Menu d'icônes et le fond d'écran seulement à la Page d'accueil
    $showIconMenu = true;

    // Afficher le titre de l'onglet
    $tabTitle = "CINEFYLE";
    
    require_once "view/template.php";
}
?>