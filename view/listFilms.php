<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

<!-- On démarre la capture de sortie -->
<?php ob_start(); ?>
    <title>Liste des films</title>
</head>
<body>
    <h1>Liste des films</h1>
    <table>
        <thead>
            <tr class="twoColumns">
                <th class="twoColumns">Titre</th>
                <th class="twoColumns">Date de Sortie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requete->fetchAll() as $film) { ?>
                <tr>
                    <td class="twoColumns"><?= $film['titre'] ?></td>
                    <td class="tableCenter"><?= $film['dateSortie'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
 <!-- Récupération du contenu de la capture de sortie dans une variable -->
<?php $content = ob_get_clean();
require "view/template.php";
