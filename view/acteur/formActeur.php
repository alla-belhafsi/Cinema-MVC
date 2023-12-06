<?php 
ob_start(); 
// $isAdd = true;
?>

    <h1 class="title">Paramètres de l'acteur</h1><br>
    <!-- Formulaire prérempli pour la modification d'un acteur(UPDATE) -->
    <form class='formular' action="index.php?action=UActeur&id=<?= $id ?>" method="POST">
        
        <label for="prenom">Prénom 
            <input type="text" id="prenom" name="prenom" value="<?= $IA['prenom'] ?>">
        </label>

        <label for="nom">Nom 
            <input type="text" id="nom" name="nom" value="<?= $IA['nom'] ?>">
        </label>
        
        <label for="dateNaissance">Date de naissance 
            <input type="date" id="dateNaissance" name="dateNaissance" value="<?= date('Y-m-d', strtotime($IA['dateNaissance'])) ?>">
        </label>
        
        <label for="sexe">Sexe 
            <input type="text" id="sexe" name="sexe" value="<?= $IA['sexe'] ?>">
        </label>
            
        <label>
            <input type='submit' name= 'modifier' value='Modifier'>   
        </label>
        
        <!-- <label>
            <button type="submit"><?= '' // $isAdd ? 'Créer cet Acteur' : 'Mettre à jour cet Acteur' ?></button
            <button type="submit">Enregistrer</button>
        </label>    -->

    </form> 

<?php
$content = ob_get_clean();
$tabTitle = "Paramètres de l'acteur";
require_once "view/template/templateParam.php";
?>