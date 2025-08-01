<?php

use App\CardFormat;

test('trimArray removes empty strings and trims whitespace', function () {
    $input = ' 12  34  56   ';
    $result = CardFormat::trimArray($input);

    expect($result)->toBe([12, 34, 56]);
});

test('format returns parsed card data from input lines', function () {
    $lines = [
        'Card 1: 17 41 48 83 86 | 6 9 17 31 48 53 83 86',
        'Card 2: 13 16 20 32 61 | 17 19 24 30 32 61 68 82'
    ];

    $result = CardFormat::format($lines);

    expect($result)->toHaveCount(2)
        ->and($result[0]['card'])->toBe(1)
        ->and($result[0]['winning'])->toBe([17, 41, 48, 83, 86])
        ->and($result[0]['yours'])->toBe([6, 9, 17, 31, 48, 53, 83, 86])
        ->and($result[1]['card'])->toBe(2)
        ->and($result[1]['winning'])->toBe([13, 16, 20, 32, 61])
        ->and($result[1]['yours'])->toBe([17, 19, 24, 30, 32, 61, 68, 82]);

});
