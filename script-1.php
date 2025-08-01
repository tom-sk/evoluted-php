<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\CardFormat;

$file = file('input.txt');

$step1 = CardFormat::format($file);

file_put_contents('output.json', json_encode($step1, JSON_PRETTY_PRINT));