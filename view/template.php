<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/style.css">

    <title><?= $titre ?></title>
    <div>
    
    </div>
</head>
<body>
    <div>
        <a href='index.php'><b>MENU</b></a>
        <h1><?= $titre ?></h1>
        <p><?= $type ?></p>
        <?= $requete ?> 
        <?= $liste ?>
    </div>
</body>
</html>

