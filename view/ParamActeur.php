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

$showFormFilled = true;

$showFormBlank = false;

$paramTitle = " Paramètres de l'acteur";

$action = "UActeur";

$value = $IA;

$query = ob_get_clean();
require_once "templateParam.php"; 

?>

</body>
</html>