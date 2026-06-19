<?php
require_once 'libs/router/router.php';
require_once 'app/controllers/issues-api.controller.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('issues', 'GET', 'IssuesApiController', 'getIssues');
$router->addRoute('issues/:id', 'GET', 'IssuesApiController', 'getIssueById');
$router->addRoute('issues/:id', 'DELETE', 'IssuesApiController', 'removeIssue');
$router->addRoute('issues', 'POST', 'IssuesApiController', 'insertIssue');
$router->addRoute('issues/:id', 'PUT', 'IssuesApiController', 'updateIssue');
$router->addRoute('issues/:id', 'PATCH', 'IssuesApiController', 'patchIssue');

// rutea según recurso y método de la solicitud
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

