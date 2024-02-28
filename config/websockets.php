<?php

return [

    /*
    |--------------------------------------------------------------------------
    | WebSocket Server Host
    |--------------------------------------------------------------------------
    |
    | This defines the host address on which the WebSocket server will run.
    | By default, it will run on the localhost. If you want to make it
    | publicly accessible, specify the IP address or domain name.
    |
    */

    'host' => env('LARAVEL_WEBSOCKETS_HOST', 'localhost'),

    /*
    |--------------------------------------------------------------------------
    | WebSocket Server Port
    |--------------------------------------------------------------------------
    |
    | This defines the port on which the WebSocket server will listen for
    | incoming connections. You can change this port if it conflicts
    | with other services running on the same server.
    |
    */

    'port' => env('LARAVEL_WEBSOCKETS_PORT', 6001),

    /*
    |--------------------------------------------------------------------------
    | Enable SSL
    |--------------------------------------------------------------------------
    |
    | If you want to enable SSL for secure WebSocket connections, set this
    | option to true. Make sure to provide the SSL certificate and key
    | files in the appropriate locations for secure connections.
    |
    */

    'ssl' => env('LARAVEL_WEBSOCKETS_SSL', false),

    /*
    |--------------------------------------------------------------------------
    | WebSocket SSL Certificate Path
    |--------------------------------------------------------------------------
    |
    | If SSL is enabled, provide the path to the SSL certificate file.
    | This file should contain the SSL certificate for secure
    | WebSocket connections.
    |
    */

    'ssl_cert_path' => env('LARAVEL_WEBSOCKETS_SSL_CERT_PATH', ''),

    /*
    |--------------------------------------------------------------------------
    | WebSocket SSL Key Path
    |--------------------------------------------------------------------------
    |
    | If SSL is enabled, provide the path to the SSL key file.
    | This file should contain the SSL private key for secure
    | WebSocket connections.
    |
    */

    'ssl_key_path' => env('LARAVEL_WEBSOCKETS_SSL_KEY_PATH', ''),

    /*
    |--------------------------------------------------------------------------
    | Enable WebSocket API
    |--------------------------------------------------------------------------
    |
    | If you want to enable the WebSocket API for your application, set this
    | option to true. This will enable the broadcasting of events
    | to WebSocket clients.
    |
    */

    'api_enabled' => env('LARAVEL_WEBSOCKETS_API_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | WebSocket API Port
    |--------------------------------------------------------------------------
    |
    | If the WebSocket API is enabled, this defines the port on which the API
    | server will listen for incoming connections. You can change
    | this port if it conflicts with other services.
    |
    */

    'api_port' => env('LARAVEL_WEBSOCKETS_API_PORT', 8080),

    /*
    |--------------------------------------------------------------------------
    | Enable Presence Channels
    |--------------------------------------------------------------------------
    |
    | If you want to enable presence channels for WebSocket connections,
    | set this option to true. Presence channels allow you to
    | track users and their activity on the channel.
    |
    */

    'presence_enabled' => env('LARAVEL_WEBSOCKETS_PRESENCE_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Presence Channel Redis Connection
    |--------------------------------------------------------------------------
    |
    | If presence channels are enabled, specify the Redis connection
    | to use for presence channel tracking.
    |
    */

    'presence_redis_connection' => env('LARAVEL_WEBSOCKETS_PRESENCE_REDIS_CONNECTION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Enable Statistics Tracking
    |--------------------------------------------------------------------------
    |
    | If you want to enable statistics tracking for WebSocket connections,
    | set this option to true. This will track various metrics
    | related to WebSocket connections and events.
    |
    */

    'statistics_enabled' => env('LARAVEL_WEBSOCKETS_STATISTICS_ENABLED', false),

];
