<?php


namespace semestralkaweb\MVC;


/**
 * Vysledek akce controlleru
 * @package semestralkaweb\MVC
 */
interface IActionResult
{
    /**
     * Spusti vysledek
     */
    public function execute(): void;
}