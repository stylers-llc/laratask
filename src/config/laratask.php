<?php

return [
    'taxonomy' => [
        'task_status' => 1000,
        'task_statuses' => [
            'created' => [
                "id" => 1001,
                "translations" => [
                    "hu" => "létrehozva",
                    "en" => "created"
                ]
            ],
            'processing' => [
                "id" => 1002,
                "translations" => [
                    "hu" => "feldolgozás alatt",
                    "en" => "processing"
                ]
            ],
            'success' => [
                "id" => 1003,
                "translations" => [
                    "hu" => "lezárva",
                    "en" => "success"
                ]
            ],
            'error' => [
                "id" => 1004,
                "translations" => [
                    "hu" => "hibás",
                    "en" => "error"
                ]
            ],
        ],
        'task_template_names' => 1100,
    ]
];