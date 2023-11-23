<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/style.css">
    <div><?= $navbar ?></div>
    <title><?= $titre ?></title>
    <div>
    
    </div>
</head>
<body>
    <div>
        <h1><?= $titre ?></h1>
        <p><?= $type ?></p>
        <?= $requete ?> 
        <?= $liste ?>
    </div>
</body>
</html>

