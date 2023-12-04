<?php 
ob_start(); 
?>

    <h1 class='title'>La liste des acteurs et actrices</h1>

    <p class= 'counter'> Il y a <b><?= $requeteLA->rowCount() ?></b> acteurs et actrices</p>
    <div class= 'add'>
        <p>Ajouter un acteur ou une actrice 
            <a href='index.php?action=AActeur'> 
                <ion-icon name='person-add-outline'></ion-icon>
            </a>
        </p>
    </div>

    <table class='table'>
        <thead>
            <tr>
                <th>Acteur</th>
                <th>Date de Naissance</th>
                <th>SEXE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requeteLA->fetchAll() as $personne) { ?>
                <tr>
                    <td class='column' id='selectCase'>
                        <a class='columna' href='index.php?action=listFilmographieA&id=<?= $personne['id_acteur'] ?>'><?= $personne['acteur'] ?>
                        </a>
                    </td>
                    <td class='tableCenter'><?= $personne['dateNaissance'] ?></td>
                    <td class='tableCenter'><?= $personne["sexe"] ?></td>
                    <td class='tableCenterUD'>
                        <a class='columna' href='index.php?action=formActeur&id=<?= $personne['id_acteur'] ?>'>
                            <ion-icon name='settings-outline'></ion-icon>
                        </a>
                    </td>
                    <td class='tableCenterUD'>
                        <a class='delete-something columna' href='index.php?action=DActeur&id=<?= $personne['id_acteur'] ?>'>
                            <ion-icon name='trash-outline'></ion-icon>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
$content = ob_get_clean();
$tabTitle = "Acteurs";
$showIconMenu = false;
require_once "template.php";
?>