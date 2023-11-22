<!DOCTYPE html>
<html lang="en">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

</head>
<?php ob_start(); ?>
<body>
    <table>
        <thead>
            <tr class="column">
                <th class="column">Réalisateur</th>
                <th class="column">Date de Naissance</th>
                <th class="column">SEXE</th>
            </tr>
        </thead>
        <tbody>
            <!-- On fetchAll car un ensemble de résultats est attendu (plusieurs lignes sur HeidiSQL) -> retourne un tableau de tableaux associatifs -->
            <?php foreach ($requete->fetchAll() as $personne) { ?>
                <tr> 
                <?php 
                $dateNaissance = $personne["dateNaissance"]; 
                $dateObj = new DateTime($dateNaissance);
                $dateFormatee = $dateObj->format('d-m-Y'); ?>
                    <td class="column"><?= $personne["prenom"]." ".$personne["nom"] ?></td>
                    <td class="tableCenter"><?= $dateFormatee ?></td>
                    <td class="tableCenter"><?= $personne["sexe"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php 
$dateNaissance = $personne["dateNaissance"]; 
$dateObj = new DateTime($dateNaissance);
$dateFormatee = $dateObj->format('d-m-Y'); 
$titre = "La liste des réalisateurs et réalisatrices";
$type = "<p> Il y a ".$requete->rowCount()." réalisateurs et réalisatrices</p>";
$requete = ob_get_clean();

require_once "template.php";
?>