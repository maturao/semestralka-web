<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\IActionResult;


/**
 * Controller, ktery vraci domovskou stranku webu
 * @package semestralkaweb\Controllers
 */
class HomeController extends ADBController
{
    /**
     * Vychozi akce, vrati domovskou stranku
     * @return IActionResult About view
     */
    public function index(): IActionResult
    {
        return $this->viewResultDB("About", "O konferenci");
    }
}