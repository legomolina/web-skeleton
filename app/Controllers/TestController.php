<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\RenderableController;


class TestController extends Controller implements RenderableController
{
    public function render($request, $response)
    {
        return $this->renderTemplate($response, "view");
    }
}