<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h1 class="title">Confirmation</h1>
    <h2 class="title"><br><br>Les données ont été mises à jour avec succés.</h2>

<?php

$showForm = false;

$query = ob_get_clean();
require_once "templateParam.php";
?>
</body>
</html>