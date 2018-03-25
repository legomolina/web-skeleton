<?php

session_start();

require __DIR__ . "/../vendor/autoload.php";

$app = new Slim\App(App\Config\Config::getSlimConfig());

$container = $app->getContainer();

\App\Config\Config::setConfig();
\App\Config\Config::configureEloquent($container);

\App\Config\Config::loadControllers($container);

$container["csrf"] = function() {
    $guard = new \Slim\Csrf\Guard();
    $guard->setPersistentTokenMode(true);
    return $guard;
};

$container["debug"] = function($container) {
    return $container["settings"]["debug"];
};

$container["view"] = function($container) {
    $view = new Slim\Views\Twig(__DIR__ . "/../resources/views", [
        "auto_reload" => true,
        "cache" => "../cache/views"
    ]);

    $view->addExtension(new Slim\Views\TwigExtension($container->router, $container->request->getUri()));

    $view->getEnvironment()->addGlobal("debug", $container["settings"]["debug"]);

    return $view;
};

$app->add($container->csrf);

require __DIR__ . "/../app/routes.php";