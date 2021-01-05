<?php

namespace semestralkaweb;

class Utils
{
    public static function getOrDefault(array $array, string $key, string $default): string
    {
        if (empty($array[$key])) {
            return $default;
        }
        return $array[$key];
    }

    public static function httpNotFound()
    {
        http_response_code(404);
        die();
    }
}