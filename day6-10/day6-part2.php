<?php

// Fonction pour détecter le début du message
function findStartOfMessage($datastream) {
    $length = strlen($datastream);

    for ($i = 13; $i < $length; $i++) {
        $chars = str_split(substr($datastream, $i - 13, 14));

        // Vérifie si les quatorze caractères sont tous différents
        if (count(array_unique($chars)) === 14) {
            return $i + 1; // Retourne la position du début du message
        }
    }

    return -1; // Retourne -1 si aucun début de message n'est trouvé
}

// Lecture du contenu du fichier
$inputFile = 'input-day6.txt';
$datastream = file_get_contents($inputFile);

// Appel de la fonction pour trouver le début du message
$result = findStartOfMessage($datastream);

// Affichage du résultat
echo "Nombre de caractères avant le début du message : $result\n";

?>

