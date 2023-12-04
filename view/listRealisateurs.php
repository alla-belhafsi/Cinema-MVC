<?php 
ob_start(); 
?>

    <h1 class='title'>La liste des réalisateurs et réalisatrices</h1>

    <p class= 'counter'> Il y a <b><?= $requeteLR->rowCount() ?></b> réalisateurs et réalisatrices</p>
    <div class= 'add'>
        <p>Ajouter un Réalisateur ou une Réalisatrice 
            <a href='index.php?action=ARealisateur'> 
                <ion-icon name='person-add-outline'></ion-icon>
            </a>
        </p>
    </div>

    <table class='table'>
        <thead>
            <tr>
                <th>Nom du réalisateur</th>
                <th>Date de naissance</th>
                <th>Sexe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requeteLR->fetchAll() as $realisateur) { ?>
                <tr>
                    <td class='column'>
                        <a class='columna' href='index.php?action=listFilmographieR&id=<?= $realisateur['id_realisateur'] ?>'><?= $realisateur['realisateur'] ?></a>
                    </td>
                    <td class='tableCenter'>
                        <?= date('d-m-Y', strtotime($realisateur['dateNaissance'])) ?>
                    </td>
                    <td class='tableCenter'>
                        <?php $realisateur['sexe'] ?>
                    </td>
                    <td class='tableCenterUD'>
                        <a class='columna' href='index.php?action=formRealisateur&id=<?= $realisateur['id_realisateur'] ?>'>
                            <ion-icon name='settings-outline'></ion-icon>
                        </a>
                    </td>
                    <td class='tableCenterUD'>
                        <a class='delete-something columna' href='index.php?action=DRealisateur&id=<?= $realisateur['id_realisateur'] ?>'>
                            <ion-icon name='trash-outline'></ion-icon>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
$content = ob_get_clean();
$tabTitle = "Réalisateurs";
$showIconMenu = false;
require_once "template.php";
?>