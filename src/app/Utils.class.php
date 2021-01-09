<?php


namespace semestralkaweb;


/**
 * Trida s uzitecnymi funkcemi
 * @package semestralkaweb
 */
class Utils
{
    /**
     * Vrati z pole hodnotu pod klicem, a nebo vychozi hodnotu
     * @param $array
     * @param $key
     * @param $default
     * @return mixed
     */
    public static function getOrDefault($array, $key, $default)
    {
        if (empty($array[$key])) {
            return $default;
        }
        return $array[$key];
    }

    /**
     * Vyplni atributy tridy prijatymi hodnotami z http requestu
     * @param string $class trida pro vyplneni dat
     * @return mixed
     */
    public static function fillFromRequest(string $class)
    {
        $object = new $class();
        foreach (get_object_vars($object) as $key => $val) {
            $object->$key = self::getOrDefault($_REQUEST, $key, null);
        }
        return $object;
    }
}