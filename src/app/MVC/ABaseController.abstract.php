<?php


namespace semestralkaweb\MVC;


abstract class ABaseController
{
    protected function viewResult(string $view, array $data): ViewResult
    {
        return new ViewResult($view, $data);
    }
}