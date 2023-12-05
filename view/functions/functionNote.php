<?php

function afficherEtoiles($note) {
    $noteArrondie = floor($note); // Partie entière de la note
    $decimal = $note - $noteArrondie; // Partie décimale de la note

    $etoiles = "";

    // Remplir les étoiles pleines
    for ($i = 0; $i < $noteArrondie; $i++) {
        $etoiles .= "<span class='etoile active'>&#9733;</span>";
    }

    // Ajouter une étoile partielle (selon la partie décimale)
    if ($decimal > 0) {
        $etoiles .= "<span class='etoile active' style='width:" . ($decimal * 100) . "%;'>&#9733;</span>";
    }

    // Remplir les étoiles vides restantes
    for ($i = ceil($note); $i < 5; $i++) {
        $etoiles .= "<span class='etoile'>&#9734;</span>";
    }

    return $etoiles;
}

// Une fonction qui est arrondi pour afficher que des étoiles entièrement remplies ou vides

// function afficherEtoiles($note) {
//     $noteArrondie = round($note); // Arrondir la note

//     $etoiles = "";
//     for ($i = 0; $i < 5; $i++) {
//         if ($i < $noteArrondie) {
//             $etoiles .= "<span class='etoile active'>&#9733;</span>"; // Étoile pleine
//         } else {
//             $etoiles .= "<span class='etoile'>&#9734;</span>"; // Étoile vide
//         }
//     }

//     return $etoiles;
// }


