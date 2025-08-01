<?php

namespace App;

class ScoreCount
{
    public static function countAll(array $cards): array
    {
        $scores = [];
        $total = 0;

        foreach ($cards as $value) {
            $scoreCard = self::countScore($value);
            $scores[] = $scoreCard;

            $total += $scoreCard['score'];
        }

        $scores[] = ['total_score' => $total];

        return $scores;
    }

    public static function countScore(array $card): array
    {
        $winning = $card['winning'];
        $yours = $card['yours'];

        $matchCount = count(array_intersect($winning, $yours));


        return [
            'card' => $card['card'],
            'score' => self::getPoints($matchCount),
        ];
    }

    public static function getPoints(int $matches): int
    {
        if($matches === 0){
            return 0;
        }

        $points = 1;

        for ($i = 1; $i < $matches; $i++) {
            $points = $points * 2;
        }

        return $points;
    }
}