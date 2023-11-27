<?php

// Fonction pour vérifier si deux plages se chevauchent
function doRangesOverlap($range1, $range2) {
    list($start1, $end1) = explode('-', $range1);
    list($start2, $end2) = explode('-', $range2);

    return $start1 <= $end2 && $end1 >= $start2;
}

// Fonction pour vérifier si une plage est entièrement contenue dans une autre
function isFullyContained($range1, $range2) {
    list($start1, $end1) = explode('-', $range1);
    list($start2, $end2) = explode('-', $range2);

    return ($start1 >= $start2 && $end1 <= $end2) || ($start2 >= $start1 && $end2 <= $end1);
}

// Lire le fichier d'entrée
$inputFile = 'input-day4.txt';
$lines = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Initialiser les compteurs
$fullyContainedCount = 0;
$overlappingPairsCount = 0;

// Parcourir chaque paire d'assignments
foreach ($lines as $line) {
    // Diviser la ligne en deux paires
    list($range1, $range2) = explode(',', $line);

    // Vérifier si une plage est entièrement contenue dans l'autre
    if (isFullyContained($range1, $range2) || isFullyContained($range2, $range1)) {
        $fullyContainedCount++;
    }

    // Vérifier si les plages se chevauchent
    if (doRangesOverlap($range1, $range2)) {
        $overlappingPairsCount++;
    }
}

// Afficher les résultats
echo "Le nombre de paires d'assignments où une plage est entièrement contenue dans l'autre est : $fullyContainedCount\n";
echo "Le nombre de paires d'assignments où les plages se chevauchent est : $overlappingPairsCount\n";

?>

