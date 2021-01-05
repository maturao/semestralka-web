<?php


namespace semestralkaweb\MVC;


class ErrorMessages
{
    private $messages = array();

    private static $instance = null;

    private function __construct()
    {
    }

    public static function instance(): ErrorMessages
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function addMessage(string $message)
    {
        array_push($this->messages, $message);
    }

    public function messageCount(): int
    {
        return count($this->messages);
    }

    public function popMessages(): array
    {
        $copy = $this->messages;
        $this->messages = array();
        return $copy;
    }
}