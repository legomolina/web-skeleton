<?php

namespace app\controllers;

use Psr\Http\Message\ServerRequestInterface as ReqInterface;
use Psr\Http\Message\ResponseInterface as ResInterface;

/**
 * Class ControlPanelController
 * @package Cocode\controllers
 */
class TestController
{
    /**
     * @var $slimApp References to slim app instance
     */
    private $slimApp;

    /**
     * ControlPanelController constructor.
     * @param $app
     */
    public function __construct($app)
    {
        // Create a reference to Slim App to work with its methods.
        $this->slimApp = $app;
    }

    /**
     * @param ReqInterface $request
     * @param ResInterface $response
     * @param $arguments
     * @return mixed
     */
    public function testMethod(ReqInterface $request, ResInterface $response, $arguments)
    {
        return $this->slimApp->view->render($response, 'view.php');
    }
}