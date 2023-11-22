<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Liste des films</title>
</head>
<body>
    <h1>Liste des films</h1>

    <div class="twoColumns">
        <?php foreach ($films as $film): ?>
            <?= $film['titre'] ?> - Date de parution : <?= $film['dateParution'] ?>
        <?php endforeach; ?>
    </div>
</body>
</html>
