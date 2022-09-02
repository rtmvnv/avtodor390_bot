<?php

namespace Rtmvnv\AutodorBot;

class Helpers
{
    public static function print_json($value, $return = false)
    {
        $result = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($return) {
            return $result;
        } else {
            echo $result;
        }
    }

    public static function object_merge($arg1, $arg2)
    {
        $array = (object)array_merge((array)$arg1, (array)$arg2);
        return json_decode(json_encode($array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), FALSE);
    }
}
