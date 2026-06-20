<?php
require_once 'libs/router/router.php';
require_once 'app/controllers/viajes-api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('viajes', 'GET', 'ViajesApiController', 'getViajes');
$router->addRoute('viajes/:id', 'GET', 'ViajesApiController', 'getViajeById');
$router->addRoute('viajes/:id', 'DELETE', 'ViajesApiController', 'removeViaje');
$router->addRoute('viajes', 'POST', 'ViajesApiController', 'insertViaje');
$router->addRoute('viajes/:id', 'PUT', 'ViajesApiController', 'updateViaje');
$router->addRoute('viajes/:id', 'PATCH', 'ViajesApiController', 'patchViaje');

// rutea según recurso y método de la solicitud
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

