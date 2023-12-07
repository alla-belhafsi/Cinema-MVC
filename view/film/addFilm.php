<?php 
ob_start();
?>

    <h1 class="title">Ajouter un film</h1>

    <!-- Formulaire vierge pour ajouter un film -->
    <form class='formular' action="index.php?action=AFilm" method="POST">
        <div class="form-container">
            <div class="form-column">

                <label for="film">Film
                    <input type="text" class="filmInput" id="film" name="titre" value="">
                </label>
                
                <label for="durer">Durée (en minutes)
                    <input type="number" id="durer" name="durer" value="">
                </label>
        
                <label for="dateParution">Sortie
                    <input type="date" id="dateParution" name="dateParution" value="">
                </label>
                
                <!-- Saisir une note en décimale grâce à step et délimiter le champ d'action avec min/max -->
                <label for="note">Note
                    <input type="number" step="0.1" min="0" max="5" id="note" name="note" value="">
                </label>
        
                <!-- Séléction du réalisateur de ce film -->
                <label  for="realisateur">Réalisateur
                    <select class="realSelect" id="realisateur" name="id_realisateur">

                        <!-- Option par défaut -->
                        <option value="">Sélectionnez un réalisateur</option>
                        
                        <?php foreach ($listReals as $real) { ?>
                            <!-- Séléction du réalisateur pour l'attribuer au film -->
                            <option value="">
                                <?= $real['realisateur'] ?>
                            </option>
                        <?php } ?>    

                    </select>
                </label>

                <!-- Sélection du genre avec une option "Autre" -->
                <label for="id_genre">Genre
                    <select class="realSelect" id="id_genre" name="id_genre">
                        <option value="">Sélectionnez un genre</option>
                        <?php foreach ($listGenres as $genre) { ?>
                            <option value="<?= $genre['id_genre'] ?>">
                                <?= $genre['genre'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </label>

            </div>

            <div class="synopsis-column">

                <label for="afficheFilm">Affiche du film
                    <textarea type="text" class="realSelect auto-resize" id="afficheFilm" name="afficheFilm"></textarea>
                </label>

                <label for="synopsis">Synopsis
                    <textarea class="realSelect auto-resize" id="synopsis" name="synopsis"></textarea>
                </label>

            </div>
        </div>
        
        <label>
            <input class="buttonModif" type="submit" name= "ajouter" value="Ajouter">
        </label>
        
    </form>

<?php
$content = ob_get_clean();
$tabTitle = "Ajouter un film";
require_once "view/template/templateParam.php";
?>