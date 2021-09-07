<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // Profesional
    $router->post('crearProfesional', 'Profesional\ProfesionalController@store');
    $router->post('actualizarProfesional', 'Profesional\ProfesionalController@update');
    $router->get('profesional', 'Profesional\ProfesionalController@index');

    //Direcciones
    $router->get('direcciones', 'Direccion\DireccionController@index');
    $router->post('crearDireccion', 'Direccion\DireccionController@store');
    $router->get('direcciones/{id_direccion}', 'Direccion\DireccionController@direccion');
    $router->post('actualizarDirecciones', 'Direccion\DireccionController@update');

    //Paises, Provincias, Ciudad
    $router->get('paises', 'Paises\PaisController@index');
    $router->get('provincias/{id_pais}', 'Provincia\ProvinciaController@index');
    $router->get('ciudades/{id_provincia}', 'Ciudad\CiudadController@index');

    // Pagos
    $router->post('crearPagos', 'PagosController@store');

    // Productos
    $router->post('crearServicios', 'Servicio\ServicioController@store');
    $router->post('actualizarServicios', 'Servicio\ServicioController@update');
    $router->get('servicios', 'Servicio\ServicioController@index');
    $router->get('servicios/{id_servicio}', 'Servicio\ServicioController@servicio');

    // Tipos de Servicio
    $router->get('tiposServicio', 'TipoServicio\TipoServicioController@index');

    // Clasificaciones
    $router->get('clasificaciones', 'Clasificacion\ClasificacionController@index');
    $router->get('subclasificaciones/{id_clasificacion}', 'Subclasificacion\SubclasificacionController@index');
    $router->get('categorias/{id_subclasificacion}', 'Categoria\CategoriaController@index');
    //$router->get('categorias', 'Servicio\ServicioController@index');


    // Autenticación
    $router->get('autenticar', 'Autenticacion\AutenticacionController@autenticar');
});

