<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php

$showForm = true;

$paramTitle = " Paramètres de l'acteur";

$action = "UAActeur";

$value = $IA;

$query = ob_get_clean();
require_once "templateParam.php"; 

?>

</body>
</html>