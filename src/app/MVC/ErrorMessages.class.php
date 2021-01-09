<?php


namespace semestralkaweb\MVC;


/**
 * Trida pro ukladani chybovych hlasek
 * @package semestralkaweb\MVC
 */
class ErrorMessages
{
    /** @var array chybove hlasky */
    private $messages = array();

    /** @var ErrorMessages|null singleton instance */
    private static $instance = null;

    /**
     * Vrati singleton instanci teto tridy
     * @return ErrorMessages singleton
     */
    public static function instance(): ErrorMessages
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Ulozi chybovou hlasku
     * @param string $message chybova hlaska
     */
    public function addMessage(string $message)
    {
        array_push($this->messages, $message);
    }

    /**
     * Vrati pocet chybovych hlasek
     * @return int pocet chybovych hlasek
     */
    public function messageCount(): int
    {
        return count($this->messages);
    }

    /**
     * Vrati vsechny chybove hlasky a zaroven vycisti
     * je smaze z teto tridy
     * @return array
     */
    public function popMessages(): array
    {
        $copy = $this->messages;
        $this->messages = array();
        return $copy;
    }
}