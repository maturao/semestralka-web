<?php


namespace semestralkaweb\MVC;


/**
 * Základní třída pro controllery
 * @package semestralkaweb\MVC
 */
abstract class ABaseController
{
    /**
     * Vráti výsledek, který renderuje twig view
     * @param string $view soubor view bez pripony (.twig)
     * @param array $data data pro view
     * @return ViewResult view vysledek
     */
    protected function viewResult(string $view, array $data): ViewResult
    {
        return new ViewResult($view, $data);
    }
}