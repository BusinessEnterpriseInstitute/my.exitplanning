<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto NL;
        }
        self::$constCacheArray = array();
        NL:
        $dT = get_called_class();
        if (array_key_exists($dT, self::$constCacheArray)) {
            goto bM;
        }
        $k2 = new ReflectionClass($dT);
        self::$constCacheArray[$dT] = $k2->getConstants();
        bM:
        return self::$constCacheArray[$dT];
    }
    public static function isValidName($lX, $l4 = false)
    {
        $do = self::getConstants();
        if (!$l4) {
            goto kb;
        }
        return array_key_exists($lX, $do);
        kb:
        $q6 = array_map("\x73\164\x72\x74\157\154\x6f\167\x65\162", array_keys($do));
        return in_array(strtolower($lX), $q6);
    }
    public static function isValidValue($e1, $l4 = true)
    {
        $Vv = array_values(self::getConstants());
        return in_array($e1, $Vv, $l4);
    }
}
