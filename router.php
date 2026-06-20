<?php
require_once 'libs/router/router.php';
require_once 'app/controllers/viajes-api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('viajes', 'GET', 'ViajesApiController', 'getViajes');
$router->addRoute('viajes/:id', 'GET', 'ViajesApiController', 'getViajeById');
$router->addRoute('viajes/:id', 'DELETE', 'viajes-api.controller', 'removeViaje');
$router->addRoute('viajes', 'POST', 'viajes-api.controller', 'insertViaje');
$router->addRoute('viajes/:id', 'PUT', 'viajes-api.controller', 'updateViaje');
$router->addRoute('viajes/:id', 'PATCH', 'viajes-api.controller', 'patchViaje');

// rutea según recurso y método de la solicitud
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

