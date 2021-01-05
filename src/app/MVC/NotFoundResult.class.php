<?php


namespace semestralkaweb\MVC;


use semestralkaweb\Utils;


class NotFoundResult implements IActionResult
{
    public function execute(): void
    {
        Utils::httpNotFound();
    }
}