<?php 
ob_start(); 
?>

    <h1 class="title">Ajouter un nouveau acteur</h1>
    <!-- Formulaire vierge pour ajouter une personne (réalisateur ou acteur) -->
    <form class='formular' action="index.php?action=AActeur" method="POST">
        
        <label for="prenom">Prénom 
            <input type="text" id="prenom" name="prenom" value="">
        </label>

         <label for="nom">Nom 
            <input type="text" id="nom" name="nom" value="">
        </label>
            
         <label for="dateNaissance">Date de naissance 
            <input type="date" id="dateNaissance" name="dateNaissance" value="">
        </label>
        
        <label for="sexe">Sexe 
            <input type="text" id="sexe" name="sexe" value="">
        </label>
                
        <label>
            <input type="submit" name= "ajouter" value="Ajouter">
        </label>
        
        </form>

<?php
$content = ob_get_clean();
$tabTitle = "Ajouter un acteur";
require_once "view/template/templateParam.php";
?>