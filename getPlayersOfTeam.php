<?php
include('connect.php');

$team = $_POST['team'];

$cursor = $teams_collection->findOne(['name' => $team]);

$players = $cursor['players'];

echo "<h2>Склад команди \"$team\":</h2>";
echo "<ul>";
foreach ($players as $player) {
    echo "<li>$player</li>";
}
echo "</ul>";

echo "<script> localStorage.setItem('players', '" . json_encode($players) . "');</script>";
?>