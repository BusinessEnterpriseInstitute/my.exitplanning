<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto a0;
        }
        self::$constCacheArray = array();
        a0:
        $q7 = get_called_class();
        if (array_key_exists($q7, self::$constCacheArray)) {
            goto Og;
        }
        $TZ = new ReflectionClass($q7);
        self::$constCacheArray[$q7] = $TZ->getConstants();
        Og:
        return self::$constCacheArray[$q7];
    }
    public static function isValidName($nP, $Um = false)
    {
        $ml = self::getConstants();
        if (!$Um) {
            goto XL;
        }
        return array_key_exists($nP, $ml);
        XL:
        $Vx = array_map("\163\164\162\164\157\154\157\x77\145\162", array_keys($ml));
        return in_array(strtolower($nP), $Vx);
    }
    public static function isValidValue($uo, $Um = true)
    {
        $JB = array_values(self::getConstants());
        return in_array($uo, $JB, $Um);
    }
}
