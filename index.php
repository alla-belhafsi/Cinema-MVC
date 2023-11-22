<?php

use Controller\CinemaController;
use Model\Connect;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Project Cinema</title>
</head>
<body> 
    <a href='index.php?action=listFilms'><b>Les Films</b></a>
    <a href='index.php?action=listActeurs'><b>Les Acteurs</b></a>
</body>
</html>