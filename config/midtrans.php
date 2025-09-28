<?php

return [
    'is_production' => (bool) env('MIDTRANS_IS_PRODUCTION', false),
    'server_key'    => env('MIDTRANS_SERVER_KEY'),
    'client_key'    => env('MIDTRANS_CLIENT_KEY'),
    'sanitize'      => (bool) env('MIDTRANS_SANITIZE', true),
    'enable_3ds'    => (bool) env('MIDTRANS_3DS', true),
];
