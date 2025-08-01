<?php
namespace App;

class CardFormat
{
    public static function format(array $lines): array
    {
        $cards = [];
        $pattern = '/Card\s+(\d+):\s+([\d\s]+)\s+\|\s+([\d\s]+)/';

        foreach ($lines as $line) {
            if (preg_match($pattern, $line, $matches)) {
                $cardNumber = (int) $matches[1];
                $winning = self::trimArray($matches[2]);
                $yours = self::trimArray($matches[3]);

                sort($winning);
                sort($yours);

                $cards[] = ['card' => $cardNumber, 'winning' => $winning, 'yours' => $yours];
            }
        }

        return $cards;
    }


    public static function trimArray(string $input): array
    {
        $raw = explode(' ', $input);
        $trimmed = array_map('trim', $raw);
        $filtered = array_filter($trimmed, fn($value) => $value !== '');

        return array_map('intval', array_values($filtered));
    }
}
