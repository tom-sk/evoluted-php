<?php

use App\ScoreCount;

test('getPoints returns 0 when no matches', function () {
    expect(ScoreCount::getPoints(0))->toBe(0);
});

test('getPoints returns score for matches', function () {
    expect(ScoreCount::getPoints(1))->toBe(1)
        ->and(ScoreCount::getPoints(2))->toBe(2)
        ->and(ScoreCount::getPoints(3))->toBe(4)
        ->and(ScoreCount::getPoints(4))->toBe(8);
});

test('countScore calculates score correctly from card data', function () {
    $card = [
        'card' => 5,
        'winning' => [7, 14, 21, 28],
        'yours' => [14, 21, 35, 42],
    ];

    $result = ScoreCount::countScore($card);

    expect($result)->toBe([
        'card' => 5,
        'score' => 2, // 2 matches: 14 and 21 → 2 points
    ]);
});

test('countAll tallies scores and total', function () {
    $cards = [
        [
            'card' => 1,
            'winning' => [1, 2, 3],
            'yours' => [3, 4, 5],
        ],
        [
            'card' => 2,
            'winning' => [10, 20, 30],
            'yours' => [10, 20],
        ],
        [
            'card' => 3,
            'winning' => [100, 200],
            'yours' => [300],
        ],
    ];

    $result = ScoreCount::countAll($cards);

    expect($result)->toHaveCount(4)
        ->and($result[0]['card'])->toBe(1)
        ->and($result[0]['score'])->toBe(1)
        ->and($result[1]['card'])->toBe(2)
        ->and($result[1]['score'])->toBe(2)
        ->and($result[2]['card'])->toBe(3)
        ->and($result[2]['score'])->toBe(0)
        ->and($result[3]['total_score'])->toBe(3);
});
