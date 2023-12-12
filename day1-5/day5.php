<?php

$input = file_get_contents ( __DIR__ . '/input-day5.txt' );

list ( $configuration, $procedure ) = explode ( "\n\n", $input );

// get the stacks as strings of characters

$configuration = explode ( "\n", $configuration );

array_pop ( $configuration ); 

$stacks1 = [];

while ( $row = array_pop ( $configuration ) )
{
    $crates = str_split ( $row, 4 );

    foreach ( $crates as $i => $crate )
        if ( preg_match ( '~^\[([A-Z])]~', $crate, $match ) )
            $stacks1 [ $i ][] = $match [ 1 ];
}


$stacks2 = $stacks1;

$tasks = [];

$procedure = explode ( "\n", $procedure );

foreach ( $procedure as $task )
{
    preg_match ( '~^move (\d+) from (\d+) to (\d+)~', $task, $matches );

    $crates_to_move = [];

    for ( $i = 0; $i < $matches [ 1 ]; $i++ )
    {
        $stacks1 [ $matches [ 3 ] - 1 ][] = array_pop ( $stacks1 [ $matches [ 2 ] - 1 ] );

        $crates_to_move[] = array_pop ( $stacks2 [ $matches [ 2 ] - 1 ] );
    }

    while ( $ctm = array_pop ( $crates_to_move ) )
        $stacks2 [ $matches [ 3 ] - 1 ][] = $ctm;
}

$top_crates1 = getTopCrates ( $stacks1 );
$top_crates2 = getTopCrates ( $stacks2 );

echo "Réponse première partie : $top_crates1\n";
echo "Réponse deuxième partie : $top_crates2\n";

function getTopCrates ( $stacks )
{
    $top_crates = '';

    foreach ( $stacks as $stack )
        $top_crates .= end ( $stack );

    return $top_crates;
}
