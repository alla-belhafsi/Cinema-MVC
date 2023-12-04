<?php
ob_start();
?>
        <?= $content ?>
<?php
$showIconMenu = false;
$content = ob_get_clean();
require_once "template.php";
?>

    </body>
</html>