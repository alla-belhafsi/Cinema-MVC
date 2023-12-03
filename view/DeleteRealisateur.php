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

$paramTitle = " Supprimer un acteur";

$action = "DRealisateur";

$value = $IR;

$button = "<input type='submit' name= 'supprimer' value='Supprimer'>";

$query = ob_get_clean();
require_once "templateParam.php"; 

?>

</body>
</html>