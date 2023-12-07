<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tabTitle ?></title> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    
    <!-- Condition: Si c'est la page d'accueil alors afficher les icônes -->
    <?php if ($showIconMenu) { ?>
        <div class='menu'>
            <div class='eye' id='toggle'>
                <span href='#'>
                    <ion-icon name='eye-outline'></ion-icon>
                </span>
            </div>
            <ul class='menu-list'>
                <li class='icon'  style='--i:1;--'>
                    <a class='iconContent' href='index.php?action=listRoles'><ion-icon id='iconMask' class="fa-solid fa-masks-theater"></ion-icon>Rôles</a>
                </li>
                <li class='icon' style='--i:2;--'>
                    <a class='iconContent' href='index.php?action=listActeurs'><ion-icon name='star-outline' ></ion-icon>Acteurs</a>
                </li>
                <li class='icon' style='--i:3;--'>
                    <a class='iconContent' href='index.php?action=listFilms'><ion-icon name='film-outline'></ion-icon>Films</a>
                </li>
                <li class='icon' id='iconReal' style='--i:4;--'>
                    <a class='iconContent' href='index.php?action=listRealisateurs'><ion-icon name='videocam-outline'></ion-icon>Réalisateurs</a>
                </li>
            </ul>
        </div>
        <div class='home-background'>
            <img src='public/img/Home-background.jpg' alt='background-image'>
        </div>
    <!-- Condition: Sinon afficher la barre de navigation -->
    <?php } else { ?>
        <nav class='navbar'>
            <h1 class='leftNav'><a href='index.php'>CINEFYLE</a></h1>
            <mid class='midNav'>
                <ul class='midMidNav'>
                    <a href='index.php?action=listFilms'>FILMS</a>
                    <a href='index.php?action=listActeurs'>ACTEURS</a>
                    <a href='index.php?action=listRealisateurs'>RÉALISATEURS</a>
                    <a href='index.php?action=listRoles'>RÔLES</a>
                </ul>
            </mid>
            <right class='rightNav'>
                <ul class='rightRightNav'>
                    <i class='fa-brands fa-twitter'></i>
                    <i class='fa-brands fa-facebook-f'></i>
                    <i class='fa-brands fa-instagram'></i>
                </ul>
            </right>    
        </nav>
        <?php } ?>
        
        <?= $content ?>
    
    <script src="public/js/script.js"></script>
</body>
</html>