<?php
// Étape 1 : Lire le contenu du fichier
$input = file_get_contents("input-day8.txt");
$lines = explode("\n", $input);

// Étape 2 : Transformer les données en tableau bidimensionnel
$grid = [];
foreach ($lines as $line) {
    $grid[] = str_split(trim($line));
}

// Fonction pour vérifier si un arbre est visible dans une direction donnée
function isVisible($row, $col, $dir, $grid) {
    $height = $grid[$row][$col];

    switch ($dir) {
        case 'up':
            for ($i = $row - 1; $i >= 0; $i--) {
                if ($grid[$i][$col] >= $height) {
                    return false;
                }
            }
            break;
        case 'down':
            for ($i = $row + 1; $i < count($grid); $i++) {
                if ($grid[$i][$col] >= $height) {
                    return false;
                }
            }
            break;
        case 'left':
            for ($j = $col - 1; $j >= 0; $j--) {
                if ($grid[$row][$j] >= $height) {
                    return false;
                }
            }
            break;
        case 'right':
            for ($j = $col + 1; $j < count($grid[0]); $j++) {
                if ($grid[$row][$j] >= $height) {
                    return false;
                }
            }
            break;
    }

    return true;
}

// Étape 3 : Parcourir chaque arbre dans la grille et compter les arbres visibles
$totalVisibleTrees = 0;
for ($row = 0; $row < count($grid); $row++) {
    for ($col = 0; $col < count($grid[0]); $col++) {
        $visible = isVisible($row, $col, 'up', $grid) ||
                   isVisible($row, $col, 'down', $grid) ||
                   isVisible($row, $col, 'left', $grid) ||
                   isVisible($row, $col, 'right', $grid);

        if ($visible) {
            $totalVisibleTrees++;
        }
    }
}

// Étape 4 : Afficher le résultat
echo "Le nombre total d'arbres visibles depuis l'extérieur de la grille est : " . $totalVisibleTrees . PHP_EOL;

?>






