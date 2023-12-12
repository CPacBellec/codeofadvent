<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des jours</title>
</head>
<body>
    <h1>Liste des jours</h1>
    <h2>Jour 1 à 5</h2>
    <?php 
    for ($i = 1; $i <= 5; $i++)
    echo "<li><a href='day1-5/day{$i}.php'>Jour{$i}</a></li>"
    ?>
    <h2>Jour 6 à 10</h2>
    <?php 
    for ($i = 6; $i <= 10; $i++)
    echo "<li><a href='day6-10/day{$i}.php'>Jour{$i}</a></li>"
    ?>
    <h2>Jour 11 à 12</h2>
    <?php 
    for ($i = 11; $i <= 12; $i++)
    echo "<li><a href='day11-15/day{$i}.php'>Jour{$i}</a></li>"
    ?>
</body>
</html>