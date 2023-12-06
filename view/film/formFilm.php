<?php 
ob_start();
?>

    <h1 class="title">Modifier le film <?= $IFilm['film'] ?></h1>

    <!-- Formulaire pré-rempli pour modifier un film -->
    <form class='fill-correctly formular' action="index.php?action=URole&id=<?= $id ?>" method="POST">
        <div class="form-container">
            <div class="form-column">

                <label for="nom">Film
                    <input type="text" class="filmInput" id="nom" name="nom" value="<?= $IFilm['film'] ?>">
                </label>
        
                <label for="duree">Durée
                    <input type="number" id="duree" name="duree" value="<?= $IFilm['duree'] ?>">
                </label>
        
                <label for="sortie">Sortie
                    <input type="date" id="sortie" name="sortie" value="<?= date('Y-m-d', strtotime($Film['sortie'])) ?>">
                </label>
        
                <label for="note">Note
                    <input type="float" id="note" name="note" value="<?= $IFilm['note'] ?>">
                </label>
        
                <!-- Afficher le réalisateur de ce film -->
                <label  for="realisateur">Réalisateur
                    <select class="realSelect" id="realisateur" name="realisateur">
        
                        <!-- Option par défaut -->
                        <option value="<?= $IFilm['id_realisateur'] ?>">
                            <?= $IFilm['realisateur'] ?>
                        </option>
        
                        <!-- Remplacez les valeurs statiques par les valeurs issues dela base de données -->
                        <?php foreach($Reals AS $Real)
        
                            // Vérifie si le réalisateur par défaut est présent dans la séléction pour ne pas l'afficher en double lors du déroulement de la liste
                            if ($Real['id_realisateur'] !== $IReal['id_realisateur']) { ?>
                                <option value="<?= $Real['id_realisateur'] ?>">
                                    <?= $Real['realisateur'] ?>
                                </option>
        
                        <?php } ?>
                    </select>
                </label>

            </div>

            <div class="synopsis-column">

                <label for="synopsis">Synopsis
                    <textarea class="realSelect auto-resize" id="synopsis" name="synopsis"><?= $IFilm['synopsis'] ?></textarea>
                </label>

            </div>
        </div>
        


        <label>
            <input class="buttonModif" type="submit" name= "modifier" value="Modifier">
        </label>
        
    </form>

<?php
$content = ob_get_clean();
$tabTitle = "Paramètres du rôle";
require_once "view/template/templateParam.php";
?>