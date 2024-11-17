<?php 
require_once 'libs/router.php';
require_once 'app/controllers/clientes.controller.php';

$router = new Router();

#                   ENDPOINT   |   VERBO    |    CONTROLLER    |    METODO  
$router->addRoute('clientes',      'GET',    'ClientController', 'GetAllClientes');  
$router->addRoute('clientes/:id',  'GET',    'ClientController', 'GetClientesById');  
$router->addRoute('clientes',      'POST',    'ClientController', 'CreateClient');
$router->addRoute('clientes/:id',  'PUT',    'ClientController', 'updateClient');  

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
