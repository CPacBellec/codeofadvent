<?php

$input = file_get_contents("input-day9.txt");
$moves = explode("\n", $input);

// Initial position of head and tail
$head = [0, 0];
$tail = [0, 0];

// Visited positions
$visited = ["0,0" => true];

foreach ($moves as $move) {
    list($direction, $steps) = sscanf($move, "%s %d");

    for ($i = 0; $i < $steps; $i++) {
        // Update head position based on the move
        switch ($direction) {
            case 'U':
                $head[1]--;
                break;
            case 'D':
                $head[1]++;
                break;
            case 'L':
                $head[0]--;
                break;
            case 'R':
                $head[0]++;
                break;
        }

        // Check if head and tail are adjacent
        if (abs($head[0] - $tail[0]) <= 1 && abs($head[1] - $tail[1]) <= 1) {
            $tail = $head; // Move tail to head
        } else {
            // Move tail diagonally towards head
            $tail[0] += ($head[0] - $tail[0]) <=> 0;
            $tail[1] += ($head[1] - $tail[1]) <=> 0;
        }

        // Mark the visited position
        $visited["$tail[0],$tail[1]"] = true;
    }
}

// Count the number of unique visited positions
$count = count($visited);
echo "Number of positions visited at least once: $count\n";



