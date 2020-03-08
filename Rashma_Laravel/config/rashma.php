<?php

return [
    'rootProfileId' => 1,
    'account' => [
        '98' => [
            'walletUnits' => [
                "id" => 1,
                "name" => "toman",
                'deposit' => 1000,
                "bank" => [
                    ["id" => 1, "name" => "melli", "icon" => "", "isAvailable" => true],
                ],
            ],
            'quizGrade' => [
                ['id' => 1, 'price' => 1000],
                ['id' => 2, 'price' => 2000],
                ['id' => 3, 'price' => 3000],
                ['id' => 4, 'price' => 4000],
                ['id' => 5, 'price' => 5000],
                ['id' => 6, 'price' => 6000],
                ['id' => 6, 'price' => 7000],
                ['id' => 7, 'price' => 8000],
                ['id' => 8, 'price' => 9000],
                ['id' => 10, 'price' => 10000],
            ],
        ],
        '90' => [
            'lang' => ['id' => 1, 'name' => 'tr'],
            'deposit' => 5,
            'walletUnits' => [
                "id" => 1,
                "name" => "lire",
                "bank" => [],
            ],
            'quizGrade' => [
                ['id' => 1, 'price' => 2],
                ['id' => 2, 'price' => 4],
                ['id' => 3, 'price' => 6],
                ['id' => 4, 'price' => 8],
                ['id' => 5, 'price' => 10],
                ['id' => 6, 'price' => 12],
                ['id' => 6, 'price' => 14],
                ['id' => 7, 'price' => 16],
                ['id' => 8, 'price' => 18],
                ['id' => 10, 'price' => 20],
            ],
        ],
        '00' => [
            'lang' => ['id' => 3, 'name' => 'en'],
            'deposit' => 1,
            'walletUnits' => [
                "id" => 3,
                "name" => "dolar",
                "bank" => [],
            ],
            'quizGrade' => [
                ['id' => 1, 'price' => 1],
                ['id' => 2, 'price' => 2],
                ['id' => 3, 'price' => 3],
                ['id' => 4, 'price' => 4],
                ['id' => 5, 'price' => 5],
                ['id' => 6, 'price' => 6],
                ['id' => 6, 'price' => 7],
                ['id' => 7, 'price' => 8],
                ['id' => 8, 'price' => 9],
                ['id' => 10, 'price' => 10],
            ],
        ],
    ],

    "unitDeposit" => [
        1 => 1000,
        2 => 2,
        3 => 1,
    ],

    "licenceGrade" => [
        ["id" => 1, "name" => "a"],
        ["id" => 2, "name" => "b"],
        ["id" => 3, "name" => "c"],
        ["id" => 4, "name" => "d"],
        ["id" => 5, "name" => "e"],
    ],

    "experienceGrade" => [
        ["id" => 1, "name" => "amateur"],
        ["id" => 2, "name" => "junior"],
        ["id" => 3, "name" => "medior"],
        ["id" => 4, "name" => "senior"],
    ],

    'transactionCallback' => '/transaction/cashIn/?callbackKey=',
];
