<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/style.css">
    
    <title><?= $titre ?></title>
    <div>
    
    </div>
</head>
<body>
    <div>
        <h1 class="title"><?= $titre ?></h1>
        <p><?= $type ?></p>
        <?= $requete ?> 
        <?= $liste ?>
        <script src="../public/js/script.js"></script>
    </div>
</body>
</html>

