<?php

namespace semestralkaweb\Controllers;

use semestralkaweb\MVC\ABaseController;
use semestralkaweb\MVC\IActionResult;

class HomeController extends ABaseController
{
    public function index(): IActionResult
    {
        return $this->viewResult("About", array("Title" => "O konferenci"));
    }
}