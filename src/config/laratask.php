<?php

return [
    'taxonomy' => [
        'task_status' => 400,
        'task_statuses' => [
            'created' => [
                "id" => 401,
                "translations" => [
                    "hu" => "létrehozva",
                    "en" => "created"
                ]
            ],
            'processing' => [
                "id" => 402,
                "translations" => [
                    "hu" => "feldolgozás alatt",
                    "en" => "processing"
                ]
            ],
            'success' => [
                "id" => 403,
                "translations" => [
                    "hu" => "lezárva",
                    "en" => "success"
                ]
            ],
            'error' => [
                "id" => 404,
                "translations" => [
                    "hu" => "hibás",
                    "en" => "error"
                ]
            ],
        ],
    ]
];