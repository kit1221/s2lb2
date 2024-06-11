<?php
include('connect.php');

$team = $_POST['team'];

$cursor = $games_collection->find(['teams' => $team]);

$games = array();

echo "<h2>Список ігор, у яких брала участь команда \"$team\":</h2>";
echo "<ul>";
foreach ($cursor as $document) {
    echo "<li>{$document['league']} - {$document['date']} - {$document['location']} - Переможець: {$document['winner']}</li>";
    $games[] = $document;
}
echo "</ul>";

echo "<script> localStorage.setItem('games', '" . json_encode($games) . "');</script>";
?>