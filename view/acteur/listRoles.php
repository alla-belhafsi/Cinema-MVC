<?php 
ob_start(); 
?>

    <div class='listHeader'>
        <div>
            <h1 class='title'>La liste des rôles</h1>
        </div>
        <div>
            <p class= 'counter'> Il y a <b><?= $requeteRA->rowCount() ?></b> rôles</p>
        </div>
        <div class= 'add'>
            <p>Ajouter un rôle
                <a href='index.php?action=ARole'> 
                <ion-icon id='iconMask' class="fa-solid fa-masks-theater"></ion-icon>
                </a>
            </p>
        </div>
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Acteur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listRoles as $roles) { ?>
                <tr>

                    <td class='column'>
                        <?= $roles['role'] ?>
                    </td>

                    <td class='column' id='selectCase'>
                        <a class='columna' href='index.php?action=listFilmographieA&id=<?= $roles['id_acteur'] ?>'>
                            <?= $roles['acteur'] ?>
                        </a>
                    </td>

                    <td class='tableCenterUD'>
                        <a class='columna' href='index.php?action=formRole&id=<?= $roles['id_role'] ?>'>
                            <ion-icon name='settings-outline'></ion-icon>
                        </a>
                    </td>

                    <td class='tableCenterUD'>
                        <a class='delete-something columna' href='index.php?action=DRole&id=<?= $roles['id_role'] ?>'>
                            <ion-icon name='trash-outline'></ion-icon>
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
require_once "view/template/template.php";
?>