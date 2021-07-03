<?php

return [
    'dev_server' => env('VITE_DEV_SERVER', 'local' === env('APP_ENV')),
    'dev_server_url' => env('VITE_DEV_SERVER_URL', 'http://localhost'),
];
