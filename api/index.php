<?php

use Controllers\ColorController;
use Http\Router;

//only used for development purposes, dangerous to leave on at all times
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

spl_autoload_register();
$router = new Router();

$router->get('/color', [ColorController::class, 'getColors']);
$router->get('/color/id/:id', [ColorController::class, 'getColorById']);
$router->get('/color/name/:name', [ColorController::class, 'getColorByName']);
$router->get('/color/code/:code', [ColorController::class, 'getColorByCode']);

$router->delete('/color/code/:code', [ColorController::class, 'deleteColorByCode']);
$router->delete('/color/name/:name', [ColorController::class, 'deleteColorByName']);
$router->delete('/color/id/:id', [ColorController::class, 'deleteColorById']);
$router->post('/color', [ColorController::class, 'saveColor']);

$router->resolve();
