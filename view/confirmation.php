<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Confirmation de la mise à jour</title>
</head>
<header>
    
</header>
<body>
    <div>
        <p>Les données ont été mises à jour avec succés.</p>
    </div>

<?php
$showIconMenu = false;

$tabTitle = "Confirmation de la mise à jour";

$title = "<div class='title'>Mise à jour effectuée</div>";

$counter = "";

$list = "";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>