<?php

namespace App\Controllers;

use Slim\Router;
use Slim\Views\Twig;

/**
 * @property Twig view
 * @property Router router
 * @property boolean debug
 */

abstract class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if($this->container->$property) {
            return $this->container->$property;
        }

        return null;
    }

    protected function renderTemplate($response, $templateName, $data = [])
    {
        return $this->view->render($response, $templateName . ".twig", $data);
    }
}