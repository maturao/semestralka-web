<?php

namespace semestralkaweb;

class Utils
{
    public static function getOrDefault(array $array, string $key, ?string $default): ?string
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

    public static function fillFromRequest(string $class)
    {
        $object = new $class();
        foreach (get_object_vars($object) as $key => $val) {
            $object->$key = self::getOrDefault($_REQUEST, $key, null);
        }
        return $object;
    }

}