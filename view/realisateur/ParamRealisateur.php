<?php 
ob_start(); 
$isAdd = true;
?>

    <h1 class="title">Paramètres du réalisateur</h1><br>
    <!-- Formulaire prérempli pour la modification d'un réalisateur(UPDATE)-->
    <form class='formular' action="index.php?action=<?= $isAdd ? 'A' : 'U' ?>Realisateur&id=<?= $id ?>" method="POST">
        
        <label for="prenom">Prénom
            <input type="text" id="prenom" name="prenom" value="<?= $IR['prenom'] ?>">
        </label>

        <label for="nom">Nom
            <input type="text" id="nom" name="nom" value="<?= $IR['nom'] ?>">
        </label>
        
        <label for="dateNaissance">Date de naissance
            <input type="date" id="dateNaissance" name="dateNaissance" value="<?= date('Y-m-d', strtotime($IR['dateNaissance'])) ?>">
        </label>
        
        <label for="sexe">Sexe
            <input type="text" id="sexe" name="sexe" value="<?= $IR['sexe'] ?>">
        </label>
            
        <label>
            <input type='submit' name= 'modifier' value='Modifier'>   
        </label>
        
        <label>
            <!--button type="submit"><?= '' // $isAdd ? 'Créer ce réalisateur' : 'Mettre à jour ce réalisateur' ?></button-->
            <button type="submit">Enregistrer</button>
        </label>  

    </form> 

<?php
$content = ob_get_clean();
$tabTitle = "Paramètres du réalisateur";
require_once "view/template/templateParam.php";
?>