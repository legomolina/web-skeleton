<?php

namespace app\controllers;

use Psr\Http\Message\ServerRequestInterface as ReqInterface;
use Psr\Http\Message\ResponseInterface as ResInterface;

/**
 * Class ControlPanelController
 * @package Cocode\controllers
 */
class TestController extends Controller
{
    /**
     * Controller constructor.
     * @param $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
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
