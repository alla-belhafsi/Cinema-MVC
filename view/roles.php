<?php 
ob_start(); 
?>

    <h1 class='title'>La liste des rôles</h1>

    <p class= 'counter'> Il y a <b><?= $requeteRA->rowCount() ?></b> rôles</p>";

    <table class='table'>
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Acteur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requeteRA->fetchAll() as $roles) { ?>
                <tr>
                    <td class='column'><?= $roles['role'] ?></td>
                    <td class='column' id='selectCase'>
                        <a class='columna' href='index.php?action=listFilmographieA&id=<?= $roles['id_acteur'] ?>'><?= $roles['acteur'] ?>
                        </a>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>


<?php
$content = ob_get_clean();
$tabTitle = "Rôles";
$showIconMenu = false;
require_once "template.php";
?>