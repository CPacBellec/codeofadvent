<?php
$input = file ( __DIR__ . '/input-day12.txt', FILE_IGNORE_NEW_LINES );

$map = [];
$start = $end = [];
$lowest = [];

foreach ( $input as $y => $row )
{
    foreach ( str_split ( $row ) as $x => $elevation )
    {
        switch ( $elevation )
        {
            case 'S':
                $start = [ $x, $y ];
                $map [ $y ][ $x ] = ord ( 'a' );
                break;

            case 'E':
                $end = [ $x, $y ];
                $map [ $y ][ $x ] = ord ( 'z' );
                break;

            // for part 2
            case 'a':
                $lowest[] = [ $x, $y ];
                // no break

            default:
                $map [ $y ][ $x ] = ord ( $elevation );
                break;
        }
    }
}

$path_1 = pathfinder ( $start, [ $end ] );
$path_2 = pathfinder ( $end, $lowest, 'down' );

echo 'Réponse première partie: ' . ( count ( $path_1 ) - 1 ) . "\n";
echo 'Réponse deuxième partie: ' . ( count ( $path_2 ) - 1 ) . "\n";

function pathfinder ( $start, $end, $direction = 'up' )
{
    $queue = new SplQueue();

    $queue -> enqueue ( [ $start ] );

    $checked [ implode ( '|', $start ) ] = true;

    while ( $queue -> count() > 0 )
    {
        $path = $queue -> dequeue();

        $cell = end ( $path );

        if ( reached_target ( $cell, $end ) )
            return $path;

        foreach ( get_adjacent ( $cell [ 0 ], $cell [ 1 ], $direction ) as $adjacent )
        {
            if ( !isset ( $checked [ implode ( '|', $adjacent ) ] ) )
            {
                $checked [ implode ( '|', $adjacent ) ] = true;

                $new_path   = $path;
                $new_path[] = $adjacent;

                $queue -> enqueue ( $new_path );
            }
        };
    }

    return false;
}
/**
 * return adjacent cells
 *
 * @param int $x
 * @param int $y
 * @param string $direction up|down
 *
 * @return array of x|y
 */
function get_adjacent ( $x, $y, $direction )
{
    global $map;

    $adjacent = [];

    if ( $direction == 'up' )
    {
        $max_next_height = $map [ $y ][ $x ] + 1;

        if ( isset ( $map [ $y ][ $x - 1 ] ) && $map [ $y ][ $x - 1 ] <= $max_next_height )
            $adjacent[] = [ $x - 1, $y ];

        if ( isset ( $map [ $y - 1 ][ $x ] ) && $map [ $y - 1 ][ $x ] <= $max_next_height )
            $adjacent[] = [ $x, $y - 1 ];

        if ( isset ( $map [ $y ][ $x + 1 ] ) && $map [ $y ][ $x + 1 ] <= $max_next_height )
            $adjacent[] = [ $x + 1, $y ];

        if ( isset ( $map [ $y + 1 ][ $x ] ) && $map [ $y + 1 ][ $x ] <= $max_next_height )
            $adjacent[] = [ $x, $y + 1 ];
    }
    else
    {
        $min_next_height = $map [ $y ][ $x ] - 1;

        if ( isset ( $map [ $y ][ $x - 1 ] ) && $map [ $y ][ $x - 1 ] >= $min_next_height )
            $adjacent[] = [ $x - 1, $y ];

        if ( isset ( $map [ $y - 1 ][ $x ] ) && $map [ $y - 1 ][ $x ] >= $min_next_height )
            $adjacent[] = [ $x, $y - 1 ];

        if ( isset ( $map [ $y ][ $x + 1 ] ) && $map [ $y ][ $x + 1 ] >= $min_next_height )
            $adjacent[] = [ $x + 1, $y ];

        if ( isset ( $map [ $y + 1 ][ $x ] ) && $map [ $y + 1 ][ $x ] >= $min_next_height )
            $adjacent[] = [ $x, $y + 1 ];
    }

    return $adjacent;
}
/**
 * 
 *
 * @param array $cell x|y
 * @param array $targets array of x|y
 *
 * @return bool target reached
 */
function reached_target ( $cell, $targets )
{
    foreach ( $targets as $target )
        if ( $cell [ 0 ] === $target [ 0 ] && $cell [ 1 ] === $target [ 1 ] )
            return true;

    return false;
}