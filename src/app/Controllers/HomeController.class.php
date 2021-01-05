<?php

namespace semestralkaweb\Controllers;

use semestralkaweb\MVC\ABaseController;
use semestralkaweb\MVC\IActionResult;

class HomeController extends ABaseController
{
    public function index() : IActionResult
    {
        echo "Index stranka";
    }
}