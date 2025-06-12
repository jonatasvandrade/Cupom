<?php

require_once __DIR__ . '/src/StarshipFetcher.php';
require_once __DIR__ . '/src/StopCalculator.php';

$distance = (int)($argv[1] ?? 0);
if ($distance <= 0) {
    echo "Informe a distância em MGLT como argumento. Ex: php swapi.php 1000000\n";
    exit(1);
}

$fetcher = new StarshipFetcher();
$calculator = new StopCalculator();

$starships = $fetcher->fetchAll();

foreach ($starships as $ship) {
    $stops = $calculator->calculate($ship['MGLT'], $ship['consumables'], $distance);
    echo "- {$ship['name']}: $stops\n";
}
