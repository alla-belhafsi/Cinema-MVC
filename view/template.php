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
<div>
<div class='menu'>
    <div class='eye' id='toggle'>
        <span href='#'><ion-icon name='eye-outline'></ion-icon></span>
    </div>
    <ul class='menu-list'>
        <li class='icon' style='--i:1;--clr:#1877f2'>
            <a href='index.php?action=casting'><ion-icon name='videocam-outline'></ion-icon>Castings</a>
        </li>
        <li class='icon' style='--i:2;--clr:#1877f2'>
            <a href='index.php?action=listActeurs'><ion-icon name='star-outline' class='icon'></ion-icon></ion-icon>Acteurs</a>
        </li>
        <li class='icon' style='--i:3;--clr:#1877f2'>
            <a href='index.php?action=listFilms'><ion-icon name='film-outline'></ion-icon>Films</a>
        </li>
        <li class='icon' style='--i:4;--clr:#1877f2'>
            <a href='index.php?action=listRealisateurs'><ion-icon name='people-outline'></ion-icon></ion-icon>Réalisateurs</a>
        </li>
    </ul>
</div>
        </div>
        <p><?= $type ?></p>
        <?= $requete ?> 
        <?= $liste ?>
        <script src="public/js/script.js"></script>
    </div>
</body>
</html>
