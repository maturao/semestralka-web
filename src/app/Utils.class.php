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

    public static function fillFromRequest(string $class)
    {
        $object = new $class();
        foreach (get_object_vars($object) as $key => $val) {
            $object->$key = self::getOrDefault($_REQUEST, $key, null);
        }
        return $object;
    }

    public static function link(?string $controller, ?string $action): string
    {
        if ($controller == null) {
            $controller = "";
        }

        if ($action == null) {
            $action = "";
        }

        return "./index.php?controller=$controller&action=$action";
    }
}