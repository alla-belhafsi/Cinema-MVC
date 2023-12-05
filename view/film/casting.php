<?php require_once('view/functions/functionNote.php'); 
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
    
    <?php if ($roles) { // Vérifie si un résultat existe, alors afficher?>
        <div class="content">
        <p>Acteur et son rôle :</p>
        
         <?php foreach ($roles as $role) { ?>
            <p>
                <a class='columna' href='index.php?action=listFilmographieA&id=<?= $role['id_acteur'] ?>'><?= $role['acteur'] ?></a> dans le rôle de <?= $role['role'] ?>
            </p>
        <?php } ?>
        </div>
    <?php } ?>   
    
    <div class="contentSyn">
        <p>Synopsis :</p>
        <p><?= $casting['synopsis'] ?></p>
    </div>

<?php
$content = ob_get_clean();
$tabTitle = "Films";
$showIconMenu = false;
require_once "view/template/template.php";
?>