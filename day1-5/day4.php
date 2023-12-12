<?php

$input = file ( __DIR__ . '/input-day4.txt' );

$fully_contained = $overlap = 0;

foreach ( $input as $pair )
{
    $pair = explode ( ',', $pair );

    foreach ( $pair as &$elf )
        $elf = explode ( '-', $elf );

    if (    ( $pair [ 0 ][ 0 ] >= $pair [ 1 ][ 0 ] && $pair [ 0 ][ 1 ] <= $pair [ 1 ][ 1 ] )
         || ( $pair [ 0 ][ 0 ] <= $pair [ 1 ][ 0 ] && $pair [ 0 ][ 1 ] >= $pair [ 1 ][ 1 ] ) )
    {
        $fully_contained++;
        $overlap++;
    }
    elseif (    ( $pair [ 0 ][ 1 ] >= $pair [ 1 ][ 0 ] && $pair [ 0 ][ 1 ] <= $pair [ 1 ][ 1 ] )
             || ( $pair [ 1 ][ 1 ] >= $pair [ 0 ][ 0 ] && $pair [ 1 ][ 1 ] <= $pair [ 0 ][ 1 ] ) )
        $overlap++;
}

echo "Le nombre de paires d'assignments où une plage est entièrement contenue dans l'autre est: $fully_contained\n";
echo "Le nombre de paires d'assignments où les plages se chevauchent est: $overlap\n";
?>

