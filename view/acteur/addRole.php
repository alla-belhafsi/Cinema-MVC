<?php 
ob_start(); 
?>

    <h1 class="title">Ajouter un nouveau rôle</h1>
    <!-- Formulaire vierge pour ajouter un rôle -->
    <form class='fill-correctly formular' action="index.php?action=ARole" method="POST">
        
        <label for="nom">Rôle
            <input type="text" id="nom" name="nom" value="">
        </label>

        <!-- Attribuer un acteur à ce role -->
        <label for="acteur">Acteur
            <select id="acteur" name="acteur">
                <!-- Option par défaut -->
                <option value="">Sélectionnez un acteur</option>

                <!-- Remplacez les valeurs statiques par les valeurs issues de la base de données -->
                <?php foreach ($listActs as $act) { ?>
                    <option value="<?= $act['id_acteur'] ?>"><?= $act['acteur'] ?></option>
                <?php } ?>
                
            </select>
        </label>
        
        <!-- Attribuer un film à ce role -->
        <label for="film">Film
            <select id="film" name="film">
                <!-- Option par défaut -->
                <option value="">Sélectionnez un film</option>
                <!-- Remplacez les valeurs statiques par les valeurs issues de la base de données -->
                <?php foreach ($listFilms as $film) { ?>
                    <option value="<?= $film['id_film'] ?>"><?= $film['film'] ?></option>
                <?php } ?>
            </select>
        </label>
            
        <label>
            <input type="submit" name= "ajouter" value="Ajouter">
        </label>
        
    </form>

<?php
$content = ob_get_clean();
$tabTitle = "Ajouter un rôle";
require_once "view/template/templateParam.php";
?>