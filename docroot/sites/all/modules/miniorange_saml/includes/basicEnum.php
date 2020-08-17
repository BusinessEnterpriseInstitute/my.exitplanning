<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto JX;
        }
        self::$constCacheArray = array();
        JX:
        $eE = get_called_class();
        if (array_key_exists($eE, self::$constCacheArray)) {
            goto BC;
        }
        $yg = new ReflectionClass($eE);
        self::$constCacheArray[$eE] = $yg->getConstants();
        BC:
        return self::$constCacheArray[$eE];
    }
    public static function isValidName($hL, $YI = false)
    {
        $BO = self::getConstants();
        if (!$YI) {
            goto wR;
        }
        return array_key_exists($hL, $BO);
        wR:
        $nw = array_map("\163\164\x72\164\157\154\157\167\145\162", array_keys($BO));
        return in_array(strtolower($hL), $nw);
    }
    public static function isValidValue($gI, $YI = true)
    {
        $tx = array_values(self::getConstants());
        return in_array($gI, $tx, $YI);
    }
}
