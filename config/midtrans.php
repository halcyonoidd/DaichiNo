<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
];
