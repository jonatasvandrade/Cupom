<?php

require_once __DIR__ . '/TimeParser.php';

class StopCalculator
{
    public function calculate(string $mglt, string $consumables, int $distance): int
    {
        if ($mglt === 'unknown' || $consumables === 'unknown') {
            return 0;
        }

        $hours = TimeParser::toHours($consumables);
        if (!$hours) return 0;

        $range = (int)$mglt * $hours;
        return (int)floor($distance / $range);
    }
}
