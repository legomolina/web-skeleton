<?php

namespace App\Controllers;


interface RenderableController
{
    public function render($request, $response);
}