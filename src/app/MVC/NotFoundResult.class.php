<?php


namespace semestralkaweb\MVC;


class NotFoundResult implements IActionResult
{
    public function execute(): void
    {
        http_response_code(404);
        die();
    }
}