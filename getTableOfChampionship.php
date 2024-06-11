<?php
include('connect.php');

$league = $_POST['league'];

$cursor = $games_collection->find(['league' => $league]);

$gamesTable = array();

echo "<h2>Таблиця чемпіонату для ліги \"$league\"</h2>";
echo "<table border='1'>";
echo "<tr><th>Ліга</th><th>Дата</th><th>Місце проведення</th><th>Команди</th><th>Переможець</th></tr>";

foreach ($cursor as $document) {
    $teams = $document["teams"];
    echo "<tr>";
    echo "<td>" . $document['league'] . "</td>";
    echo "<td>" . $document['date'] . "</td>";
    echo "<td>" . $document['location'] . "</td>";
    echo "<td>" . $teams[0] . ", " . $teams[1] . "</td>";
    echo "<td>" . $document['winner'] . "</td>";
    echo "</tr>";

    $gamesTable[] = $document;
}

echo "</table>";

echo "<script> localStorage.setItem('gamesTable', '" . json_encode($gamesTable) . "');</script>";
?>