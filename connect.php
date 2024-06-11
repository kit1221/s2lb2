<?php 

require_once __DIR__."/vendor/autoload.php";
$teams_collection = (new MongoDB\Client)->championship->teams;
$games_collection = (new MongoDB\Client)->championship->games;

?>