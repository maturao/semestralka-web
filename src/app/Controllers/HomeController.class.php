<?php

namespace semestralkaweb\Controllers;

use semestralkaweb\MVC\ABaseController;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\IActionResult;

class HomeController extends ADBController
{
    public function index(): IActionResult
    {
        return $this->viewResultDB("About", "O konferenci");
    }
}