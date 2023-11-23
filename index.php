<?php 

use Controller\CinemaController;


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php ob_start(); ?>

<div></div>
</head>
<body>
    <div></div>
</body>
<?php

$navbar = "";

$titre = "Application Cinema";

$type = "";

$liste = "
   <a href='index.php?action=listFilms'><b>Les Films</b></a>
   <a href='index.php?action=listActeurs'><b>Les Acteurs</b></a>
   <a href='index.php?action=listRealisateurs'><b>Les Réalisateurs</b></a>
";

$requete = ob_get_clean();

require_once "view/template.php";
?>   

</html>

