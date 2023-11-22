<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

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
                    <td class="twoColumns"><?= $film['dateParution'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
