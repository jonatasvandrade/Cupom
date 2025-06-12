<?php

class TimeParser
{
    public static function toHours(string $time): ?int
    {
        $parts = explode(' ', strtolower(trim($time)));
        if (count($parts) < 2) return null;

        $value = (int)$parts[0];
        $unit = $parts[1];

        return match ($unit) {
            'day', 'days' => $value * 24,
            'week', 'weeks' => $value * 7 * 24,
            'month', 'months' => $value * 30 * 24,
            'year', 'years' => $value * 365 * 24,
            default => null
        };
    }
}
