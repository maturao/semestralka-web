<?php

namespace semestralkaweb;

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

    private function getActionResult(): IActionResult
    {
        $controllerName = Utils::getOrDefault($_GET, "controller", "Home");
        $controllerClassName = $controllerName . "Controller";
        $controllerFullClassName = "\\semestralkaweb\\Controllers\\" . $controllerClassName;

        if (!class_exists($controllerFullClassName)) {
            return new NotFoundResult();
        }

        $controller = new $controllerFullClassName();
        $action = strtolower(Utils::getOrDefault($_GET, "action", "index"));

        if (!method_exists($controller, $action)) {
            return new NotFoundResult();
        }

        $reflectionMethod = new ReflectionMethod($controller, $action);

        if (!$reflectionMethod->isPublic()) {
            return new NotFoundResult();
        }

        return $controller->$action();
    }
}


