<?php

return [

    /*
    |--------------------------------------------------------------------------
    | URL local
    |--------------------------------------------------------------------------
    |
    | Este valor corresponde al url al cual acudir para obtener tokens para
    | app móvil. En el caso de estar sobre el contenedor usar el nombre del
    | servicio web.
    |
    */
    'local_url' => env('LOCAL_URL', 'http://nginx'),

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | Este valor corresponde al id de cliente que se utiliza para generar
    | api tokens para usuarios de la app móvil.
    |
    */
    'client_id' => env('CLIENT_ID', '3'),

    /*
    |--------------------------------------------------------------------------
    | Client Secret
    |--------------------------------------------------------------------------
    |
    | Este valor corresponde a la clave secreta que se utiliza para generar
    | api tokens para usuarios de la app móvil.
    |
    */
    'client_secret' => env('CLIENT_SECRET', '1234'),

    /*
    |--------------------------------------------------------------------------
    | URL Externo / paths
    |--------------------------------------------------------------------------
    |
    | Este valor corresponde a la url externa a la cual direccionar peticiones
    | posteriores de los servicios prestados, y paths de acceso a los diferentes
    | servicios.
    |
    */
    'external_url' => env('EXTERNAL_URL', 'http://nginx'),
    'secure_path' => env('SECURE_PATH', '/api'),
    'image_path' => env('IMAGE_PATH', '/img'),
    'verify_path' => env('VERIFY_PATH', '/verify'),

];
