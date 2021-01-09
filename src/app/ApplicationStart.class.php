<?php

namespace semestralkaweb;

use ReflectionException;
use ReflectionMethod;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\NotFoundResult;

/**
 * Vstupni bod webove aplikace.
 */
class ApplicationStart
{
    /**
     * Spusteni webove aplikace.
     */
    public function appStart()
    {
        $this->getActionResult()->execute();
    }

    /**
     * Vrati vysledek akce podle get parametru
     * @return IActionResult vysledek
     */
    private function getActionResult(): IActionResult
    {
        //zjistim nazev controlle
        $controllerName = Utils::getOrDefault($_GET, "controller", "Home");
        $controllerClassName = $controllerName . "Controller";
        //nazev tridy controlle
        $controllerFullClassName = "\\semestralkaweb\\Controllers\\" . $controllerClassName;

        if (!class_exists($controllerFullClassName)) {
            //controller neexustije
            return new NotFoundResult();
        }

        //vytvorim instanci controlleru
        $controller = new $controllerFullClassName();

        //zjistim nazev akce
        $action = strtolower(Utils::getOrDefault($_GET, "action", "index"));

        if (!method_exists($controller, $action)) {
            //akce neexistije
            return new NotFoundResult();
        }

        try {
            //zjistim, zda je akce verejna metoda controlleru
            $reflectionMethod = new ReflectionMethod($controller, $action);
            if (!$reflectionMethod->isPublic()) {
                //akce je neni verejna metoda
                return new NotFoundResult();
            }

            //spustim akci na controlleru
            return $controller->$action();

        } catch (ReflectionException $e) {
            echo "Reflection exceptsion<br/>";
            var_dump($e);
            die();
        }
    }
}


