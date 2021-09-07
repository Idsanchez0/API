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

];
