<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../public/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
    
    <?php if ($showForm) { ?>
    <h1 class="title"><?= $paramTitle ?></h1><br>
    <!-- Formulaire prérempli pour la modification -->
    <form action="index.php?action=<?= $action ?>&id=<?= $id ?>" method="POST">
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $value['prenom'] ?>"><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $value['nom'] ?>"><br><br>
        
        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" id="dateNaissance" name="dateNaissance" value="<?= date('Y-m-d', strtotime($value['dateNaissance'])) ?>"><br><br>
        
        <label for="sexe">Sexe :</label>
        <input type="text" id="sexe" name="sexe" value="<?= $value['sexe'] ?>"><br><br>
        
        <input type="submit" name= "modifier" value="Modifier">
        
    </form>
    
    <input type="submit" name= "supprimer" value="Supprimer">
    <?php } else { ?>
        <?php } ?>
        <?= $query ?>
        
        <?php
        
        $id = $_GET['id'];
        
        $showIconMenu = false;
        
        $tabTitle = "Paramètres";
        
        $title = "";
        
        $counter = "";
        
        $list = ""; 

        $query = ob_get_clean();
        require_once "template.php";
        ?>
        </body>
        </html>