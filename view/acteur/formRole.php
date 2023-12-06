<?php 
ob_start(); 
// $isAdd = true;
?>

    <h1 class="title">Modifier le rôle de <?= $IRole['role'] ?></h1>
    <!-- Formulaire pré-rempli pour ajouter un rôle -->
    <form class='fill-correctly formular' action="index.php?action=URole&id=<?= $id ?>" method="POST">
        
        <label for="nom">Rôle
            <input type="text" id="nom" name="nom" value="<?= $IRole['role'] ?>">
        </label>

        <!-- Attribuer un acteur à ce role -->
        <label for="acteur">Acteur
            <select id="acteur" name="acteur">

                <!-- Option par défaut -->
                <option value="<?= $IRole['id_acteur'] ?>">
                    <?= $IRole['acteur'] ?>
                </option>

                <!-- Remplacez les valeurs statiques par les valeurs issues dela base de données -->
                <?php foreach($Acts AS $Act)

                    // Vérifie si l'acteur par défaut est présent dans la séléction pour ne pas l'afficher en double lors du déroulement de la liste
                    if ($Act['id_acteur'] !== $IRole['id_acteur']) { ?>
                        <option value="<?= $Act['id_acteur'] ?>">
                            <?= $Act['acteur'] ?>
                        </option>

                <?php } ?>
            </select>
        </label>

        <!-- Attribuer un film à ce role -->
        <label for="film">Film
            <select id="film" name="film">

                <!-- Option par défaut -->
                <option value="<?= $IRole['id_film'] ?>">
                    <?= $IRole['film'] ?>
                </option>

                <!-- Remplacez les valeurs statiques par les valeurs issues de la base de données -->
                <?php foreach($Films AS $Film)
                   
                    // Vérifie si le film par défaut est présent dans la séléction pour ne pas l'afficher en double lors du déroulement de la liste
                    if($Film['id_film'] !== $IRole['id_film']) { ?>
                    <option value="<?= $Film['id_film'] ?>">
                        <?= $Film['film'] ?>
                    </option>
                    
                <?php } ?>
            </select>
        </label>
            
        <label>
            <input type="submit" name= "modifier" value="Modifier">
        </label>
        
    </form>

<?php
$content = ob_get_clean();
$tabTitle = "Paramètres du rôle";
require_once "view/template/templateParam.php";
?>