<?php

return [
    'payment' => [
        'public_key' =>  env('MASTER_PUBLIC_KEY', ''),
        'secret_key' => env('MASTER_SECRET_KEY', ''),
        'encryption_key' => env('MASTER_ENCRYPTION')
    ]
];