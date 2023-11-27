<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php foreach ($requeteFG->fetchAll() as $castings) { ?>
        <div class="content">
            <h2><a class='columna' href='index.php?action=casting&id=<?= $castings['id_film'] ?>'><?= $castings['film'] ?></a></h2>
            <p>Dans le rôle de <?= $castings['role'] ?></p>
            <p>Année de sortie : <?= $castings['dateSortie'] ?><br><br></p>
        </div>
   <?php } ?>   

<?php
          
$showIconMenu = false;

$tabTitle = "Filmographie";

$title = "<div class='title'>Filmographie</div>";

$counter = "";

$list = "";

$query = ob_get_clean();
require_once "template.php";
?>
</body>
</html>