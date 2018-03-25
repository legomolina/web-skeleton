<?php

namespace App\Config;

use Illuminate\Database\Capsule\Manager;


class Config
{
    public static function getSlimConfig()
    {
        return [
            "settings" => [
                "displayErrorDetails" => Constants::DISPLAY_ERROR_DETAILS,
                "determineRouteBeforeAppMiddleware" => Constants::DETERMINE_ROUTE_BEFORE_APP_MIDDLEWARE,
                "debug" => true,
                "db" => [
                    "driver" => Constants::DB_DRIVER,
                    "host" => Constants::DB_HOST,
                    "database" => Constants::DB_NAME,
                    "username" => Constants::DB_USER,
                    "password" => Constants::DB_PASS,
                    "charset" => Constants::DB_CHARSET,
                    "collation" => Constants::DB_COLLATE
                ]
            ]
        ];
    }

    public static function setConfig()
    {
    }

    public static function configureEloquent($container)
    {
        $capsule = new Manager();
        $capsule->addConnection($container["settings"]["db"]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $container["db"] = function () use ($capsule) {
            return $capsule;
        };
    }

    public static function loadControllers($container)
    {
        $path = __DIR__ . "/../Controllers";
        $controllers = self::scanDirectoryRecursive($path);
        self::includeControllers($container, $controllers, "");
    }

    private static function scanDirectoryRecursive($path)
    {
        $files = [];
        $entries = array_slice(scandir($path), 2);

        foreach ($entries as $entry) {
            if (is_dir($path . "/" . $entry)) {
                $files[$entry] = self::scanDirectoryRecursive($path . "/" . $entry);
            } else {
                $files[] = $entry;
            }
        }

        return $files;
    }

    private static function includeControllers($container, $controllers, $namespace)
    {
        foreach ($controllers as $ns => $controller) {
            if (is_array($controller)) {
                self::includeControllers($container, $controller, "$namespace\\$ns");
            } else {
                $controllerName = pathinfo($controller, PATHINFO_FILENAME);
                $class = "\\App\\Controllers$namespace\\$controllerName";

                $container[$controllerName] = function ($container) use ($class) {
                    return new $class($container);
                };
            }
        }
    }
}