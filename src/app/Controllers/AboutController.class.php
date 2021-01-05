<?php

namespace semestralkaweb\Controllers;

use semestralkaweb\MVC\ABaseController;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\ViewResult;

class AboutController extends ABaseController
{
    public function index(): IActionResult
    {
        return $this->viewResult("About", array("Title" => "O konferenci"));
    }
}