<?php

return [
    'taxonomy' => [
        'task_status' => 2000,
        'task_statuses' => [
            'created' => [
                "id" => 2001,
                "translations" => [
                    "hu" => "létrehozva",
                    "en" => "created"
                ]
            ],
            'processing' => [
                "id" => 2002,
                "translations" => [
                    "hu" => "feldolgozás alatt",
                    "en" => "processing"
                ]
            ],
            'success' => [
                "id" => 2003,
                "translations" => [
                    "hu" => "lezárva",
                    "en" => "success"
                ]
            ],
            'error' => [
                "id" => 2004,
                "translations" => [
                    "hu" => "hibás",
                    "en" => "error"
                ]
            ],
        ],
        'task_template_names' => 2500,
    ]
];
