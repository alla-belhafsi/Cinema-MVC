<?php 
ob_start(); 
?>

    <h1 class="title">Ajouter un nouveau réalisateur</h1>
    <!-- Formulaire vide pour ajouter une personne (réalisateur ou acteur) -->
    <form action="index.php?action=ARealisateur" method="POST">
        
        <label for="prenom">Prénom :
            <input type="text" id="prenom" name="prenom" value="">
        </label>

         <label for="nom">Nom :
            <input type="text" id="nom" name="nom" value="">
        </label>
            
         <label for="dateNaissance">Date de naissance :
            <input type="date" id="dateNaissance" name="dateNaissance" value="">
        </label>
        
        <label for="sexe">Sexe :
            <input type="text" id="sexe" name="sexe" value="">
        </label>
                
        <label>
            <input type="submit" name= "ajouter" value="Ajouter">
        </label>
        
        </form>

<?php
$content = ob_get_clean();
$tabTitle = "Ajouter un réalisateur";
require_once "view/template/templateParam.php";
?>