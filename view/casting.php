<?php require_once('functionNote.php'); 
ob_start(); 
?>

    <div class="content">
        <h1 class='title'>
            <a class='columna' href='index.php?action=casting&id=<?= $casting['id_film'] ?>'><?= $casting['titre'] ?></a>
        </h1>
        <p>Durée : <?= $casting['dureeFilm'] ?></p>
        <p>Réalisateur : 
            <a class='columna' href='index.php?action=listFilmographieR&id=<?= $casting['id_realisateur'] ?>'><?= $casting['realisateur'] ?></a>
        </p>
        <p>Année de sortie : <?= $casting['anneeSortie'] ?></p>
        <p>Note : <?= afficherEtoiles($casting['note']) ?></p>
    </div>
        
    <div class="content">
        <p>Acteur et son rôle :</p>
         <?php foreach ($requeteRole as $role) { ?>
            <p>
                <a class='columna' href='index.php?action=listFilmographieA&id=<?= $role['id_acteur'] ?>'><?= $role['acteur'] ?></a> dans le rôle de <?= $role['role'] ?>
            </p>
        <?php } ?>
    </div>
        
    <div class="contentSyn">
        <p>Synopsis :</p>
        <p><?= $casting['synopsis'] ?></p>
    </div>

<?php
$content = ob_get_clean();
$tabTitle = "Films";
$showIconMenu = false;
require_once "template.php";
?>