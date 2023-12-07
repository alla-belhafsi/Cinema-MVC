<?php 
ob_start(); 
?>

    <div class='listHeader'>   
        <div>
            <h1 class='title'>La liste des réalisateurs et réalisatrices</h1>
        </div>
        <div>
            <p class= 'counter'> Il y a <b><?= $requeteLR->rowCount() ?></b> réalisateurs et réalisatrices</p>
        </div>
        <div class= 'add'>
            <p>Ajouter un Réalisateur ou une Réalisatrice 
                <a href='index.php?action=ARealisateur'> 
                    <ion-icon name='videocam-outline'></ion-icon>
                </a>
            </p>
        </div>
    </div> 
    <table class='table'>
        <thead>
            <tr>
                <th>Réalisateur</th>
                <th>Date de naissance</th>
                <th>Sexe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requeteLR->fetchAll() as $personne) { ?>
                <tr>
                    <td class='column'>
                        <a class='columna' href='index.php?action=listFilmographieR&id=<?= $personne['id_realisateur'] ?>'><?= $personne['realisateur'] ?></a>
                    </td>
                    <td class='tableCenter'>
                        <?= date('d-m-Y', strtotime($personne['dateNaissance'])) ?>
                    </td>
                    <td class='tableCenter'>
                        <?= $personne['sexe'] ?>
                    </td>
                    <td class='tableCenterUD'>
                        <a class='columna' href='index.php?action=formRealisateur&id=<?= $personne['id_realisateur'] ?>'>
                            <ion-icon name='settings-outline'></ion-icon>
                        </a>
                    </td>
                    <td class='tableCenterUD'>
                        <a class='delete-something columna' href='index.php?action=DRealisateur&id=<?= $personne['id_realisateur'] ?>'>
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
require_once "view/template/template.php";
?>