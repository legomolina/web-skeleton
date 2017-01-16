<?php

use MyApp\Utils;
use MyApp\Controllers;

session_start();

require '../vendor/autoload.php';
require '../app/utilsInclude.php';
require '../app/controllers/TestController.php';

include '../app/config/constants.php';

$config = require '../app/config/config.php';

$app = new \Slim\App($config);

//Make the Database connection and make $connection var global so it will be accessible with 'global $connection;'
$DBconnection = new Utils\DBConnection(
    array(
        "dbHost" => DB_HOST,
        "dbPassword" => DB_PASS,
        "dbUser" => DB_USER,
        "dbName" => DB_NAME
    )
);
$connection = $DBconnection->mysqlConnection();

require '../app/routesInclude.php';

//Dependency injection via Slim Container
$container = $app->getContainer();

//Renden views
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../app/views/');
};

//Test controller
$container['TestController'] = function($container) {
    return new Controllers\TestController();
};

$app->run();