<?php


namespace semestralkaweb\MVC;


class RedirectResult implements IActionResult
{
    /** @var string $url */
    private $url;

    /**
     * RedirectResult constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }


    public function execute(): void
    {
        header("Location: " . $this->url);
        die();
    }
}