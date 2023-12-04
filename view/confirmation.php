<?php 
ob_start(); 
?>

    <h1 class="title">Confirmation</h1>
    <h2 class="title">Les données ont été mises à jour avec succés.</h2>

<?php
$content = ob_get_clean();
require_once "templateParam.php";
?>