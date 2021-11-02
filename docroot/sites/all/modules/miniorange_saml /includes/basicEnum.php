<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto Bj;
        }
        self::$constCacheArray = array();
        Bj:
        $hL = get_called_class();
        if (array_key_exists($hL, self::$constCacheArray)) {
            goto HI;
        }
        $RI = new ReflectionClass($hL);
        self::$constCacheArray[$hL] = $RI->getConstants();
        HI:
        return self::$constCacheArray[$hL];
    }
    public static function isValidName($Z5, $yA = false)
    {
        $Dh = self::getConstants();
        if (!$yA) {
            goto K5;
        }
        return array_key_exists($Z5, $Dh);
        K5:
        $Ob = array_map("\163\x74\x72\164\157\x6c\x6f\167\x65\x72", array_keys($Dh));
        return in_array(strtolower($Z5), $Ob);
    }
    public static function isValidValue($Y_, $yA = true)
    {
        $Mb = array_values(self::getConstants());
        return in_array($Y_, $Mb, $yA);
    }
}
