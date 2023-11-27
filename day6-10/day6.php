<?php

// Fonction pour détecter le début du paquet
function findStartOfPacket($datastream) {
    $length = strlen($datastream);

    for ($i = 3; $i < $length; $i++) {
        $chars = str_split(substr($datastream, $i - 3, 4));

        // Vérifie si les quatre caractères sont tous différents
        if (count(array_unique($chars)) === 4) {
            return $i + 1; // Retourne la position du début du paquet
        }
    }

    return -1; // Retourne -1 si aucun début de paquet n'est trouvé
}

// Lecture du contenu du fichier
$inputFile = 'input-day6.txt';
$datastream = file_get_contents($inputFile);

// Appel de la fonction pour trouver le début du paquet
$result = findStartOfPacket($datastream);

// Affichage du résultat
echo "Nombre de caractères avant le début du paquet : $result\n";

?>
