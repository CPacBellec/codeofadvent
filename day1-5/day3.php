<?php

// Fonction pour calculer la priorité d'un élément
function calculatePriority($item) {
    $asciiValue = ord($item);
    if ($asciiValue >= ord('a') && $asciiValue <= ord('z')) {
        // Lowercase item
        return $asciiValue - ord('a') + 1;
    } elseif ($asciiValue >= ord('A') && $asciiValue <= ord('Z')) {
        // Uppercase item
        return $asciiValue - ord('A') + 27;
    }
    // Si l'élément n'est ni en minuscules ni en majuscules
    return 0;
}

// Fonction pour trouver l'élément commun entre trois compartiments
function findCommonItem($compartment1, $compartment2, $compartment3) {
    $commonItems = array_intersect(str_split($compartment1), str_split($compartment2), str_split($compartment3));
    return empty($commonItems) ? null : current($commonItems);
}

// Lire le contenu du fichier
$inputFile = "input-day3.txt";
$lines = file($inputFile, FILE_IGNORE_NEW_LINES);

// Initialiser la somme des priorités pour la première partie du puzzle
$totalPriorityPart1 = 0;

// Initialiser la somme des priorités pour la deuxième partie du puzzle
$totalPriorityPart2 = 0;

// Parcourir chaque ligne du fichier
foreach ($lines as $line) {
    // Diviser la ligne en deux compartiments
    $length = strlen($line) / 2;
    $compartment1 = substr($line, 0, $length);
    $compartment2 = substr($line, $length);

    // Trouver l'élément commun entre les deux compartiments
    $commonItem = array_intersect(str_split($compartment1), str_split($compartment2));

    // S'il y a un élément commun, calculer et ajouter la priorité pour la première partie
    if (!empty($commonItem)) {
        $priority = calculatePriority(current($commonItem));
        $totalPriorityPart1 += $priority;
    }
}

// Parcourir chaque groupe de trois lignes
for ($i = 0; $i < count($lines); $i += 3) {
    // Diviser chaque ligne en deux compartiments
    $compartment1 = $lines[$i];
    $compartment2 = $lines[$i + 1];
    $compartment3 = $lines[$i + 2];

    // Trouver l'élément commun entre les trois compartiments
    $commonItem = findCommonItem($compartment1, $compartment2, $compartment3);

    // S'il y a un élément commun, calculer et ajouter la priorité pour la deuxième partie
    if ($commonItem !== null) {
        $priority = calculatePriority($commonItem);
        $totalPriorityPart2 += $priority;
    }
}

// Afficher les résultats
echo "La somme des priorités pour la première partie est : " . $totalPriorityPart1 . PHP_EOL;
echo "La somme des priorités pour la deuxième partie est : " . $totalPriorityPart2 . PHP_EOL;
?>


