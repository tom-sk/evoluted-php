<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\ScoreCount;

$json = file_get_contents('output.json');
$cards = json_decode($json, true);
$step2 = ScoreCount::countAll($cards);

file_put_contents('score.json', json_encode($step2, JSON_PRETTY_PRINT));