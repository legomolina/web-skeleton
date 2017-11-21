<?php

namespace app\controllers;


abstract class Controller
{
    /**
     * @var $slimApp References to slim app instance
     */
    protected $slimApp;

    /**
     * Controller constructor.
     * @param $app
     */
    public function __construct($app)
    {
        // Create a reference to Slim App to work with its methods.
        $this->slimApp = $app;
    }
}
