<?php 
ob_start();
?>

    <h1 class="title">Modifier le film <?= $IFilm['film'] ?></h1>

    <!-- Formulaire pré-rempli pour modifier un film -->
    <form class='formular' action="index.php?action=UFilm&id=<?= $id ?>" method="POST">
        <div class="form-container">
            <div class="form-column">

                <label for="film">Film
                    <input type="text" class="filmInput" id="film" name="titre" value="<?= $IFilm['film'] ?>">
                </label>
                
                <label for="durer">Durée (en minutes)
                    <input type="number" id="durer" name="durer" value="<?= $IFilm['durer'] ?>">
                </label>
        
                <label for="sortie">Sortie
                    <input type="date" id="dateParution" name="dateParution" value="<?= date('Y-m-d', strtotime($IFilm['dateParution'])) ?>">
                </label>
                
                <!-- Afficher la note en décimale grâce à step et délimiter le champ d'action avec min/max -->
                <label for="note">Note
                    <input type="number" step="0.1" min="0" max="5" id="note" name="note" value="<?= $IFilm['note'] ?>">
                </label>
        
                <!-- Afficher le réalisateur de ce film -->
                <label  for="realisateur">Réalisateur
                    <select class="realSelect" id="realisateur" name="id_realisateur">
        
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