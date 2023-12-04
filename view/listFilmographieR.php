<?php 
ob_start(); 
$count = 0; // Initialisation du compteur
?>

    <?php foreach ($requeteFGR->fetchAll() as $film) { 
        if ($count === 0) { ?> 
        <!-- Vérifie si le compteur est à 0 (premier film) -->
            <h1 class='title'>Filmographie de  <?= $film['realisateur'] ?></h1>
        <?php }
        $count++; ?>
        <div class="content">
            <h2>
                <a class='columna' href='index.php?action=casting&id=<?= $film['id_film'] ?>'><?= $film['film'] ?></a>
            </h2>
            <p>Genre : <?= $film['genres'] ?></p>
            <p>Durée : <?= $film['dureeFilm'] ?></p>
            <p>Année de sortie : <?= $film['dateSortie'] ?></p>
        </div>
    <?php } ?>

<?php
$content = ob_get_clean();
$tabTitle = "Filmographie";
$showIconMenu = false;
require_once "template.php";
?>