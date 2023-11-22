<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

    
<h1>Les Films</h1>
</head>
<body>
    <a href='index.php'><b>MENU</b></a>
    <p> Il y a <?= $requete->rowCount() ?> films</p>
    <table>
        <thead>
            <tr class="column">
                <th class="column">Titre</th>
                <th class="column">Réalisateur</th>
                <th class="column">Durée</th>
                <th class="column">Date de Sortie</th>
            </tr>
        </thead>
        <tbody>
            <!-- On fetchAll car un ensemble de résultats est attendu (plusieurs lignes sur HeidiSQL) -> retourne un tableau de tableaux associatifs -->
            <?php foreach ($requete->fetchAll() as $film) { ?>
                <tr>
                    <td class="column"><?= $film['titre'] ?></td>
                    <td class="column"><?= $film['realisateur'] ?></td>
                    <td class="tableCenter"><?= $film['dureeHeure'] ?></td>
                    <td class="tableCenter"><?= $film['dateParutionFormat'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
 
