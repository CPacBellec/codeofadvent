<?php

$rucksacks = file ( __DIR__ . '/input-day3.txt', FILE_IGNORE_NEW_LINES );

$prio_sum = 0;

foreach ( $rucksacks as &$rucksack )
{
    $compartment_size = strlen ( $rucksack ) / 2;

    $compartments = str_split ( $rucksack, $compartment_size );

    // items comptés une seule fois même si ils apparaissent plusieurs fois...

    $content = str_split ( $compartments [ 0 ] );

    $content = array_unique ( $content );

    foreach ( $content as $item )
        if ( strpos ( $compartments [ 1 ], $item ) !== false )
            $prio_sum += getPriority ( $item );
}

echo "Résultat réponse 1: $prio_sum\n";

$badge_sum = 0;

while ( count ( $rucksacks ) )
{
    $group = [
        array_pop ( $rucksacks ),
        array_pop ( $rucksacks ),
        array_pop ( $rucksacks )
    ];

    // sort by rucksack size to compare the fewest items
    usort ( $group, function ( $a, $b ){
        return strlen ( $a ) > strlen ( $b );
    });

    for ( $i = 0; $i < strlen ( $group [ 0 ] ); $i++ )
        if (    strpos ( $group [ 1 ], $group [ 0 ][ $i ] ) !== false
             && strpos ( $group [ 2 ], $group [ 0 ][ $i ] ) !== false )
        {
            $badge_sum += getPriority ( $group [ 0 ][ $i ] );
            break;
        }
}

echo "Résultat réponse 2: $badge_sum\n";

function getPriority ( $item )
{
    $val = ord ( $item );

    // ASCII lowercase: 97-122, uppercase: 65 - 90
    return ( $val > 90 ) ? $val - 96 : $val - 38;
}