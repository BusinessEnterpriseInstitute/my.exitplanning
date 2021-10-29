<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto ht;
        }
        self::$constCacheArray = array();
        ht:
        $Y_ = get_called_class();
        if (array_key_exists($Y_, self::$constCacheArray)) {
            goto ww;
        }
        $xz = new ReflectionClass($Y_);
        self::$constCacheArray[$Y_] = $xz->getConstants();
        ww:
        return self::$constCacheArray[$Y_];
    }
    public static function isValidName($wL, $vo = false)
    {
        $PQ = self::getConstants();
        if (!$vo) {
            goto fp;
        }
        return array_key_exists($wL, $PQ);
        fp:
        $Ty = array_map("\163\164\x72\164\x6f\154\x6f\x77\x65\x72", array_keys($PQ));
        return in_array(strtolower($wL), $Ty);
    }
    public static function isValidValue($ar, $vo = true)
    {
        $nJ = array_values(self::getConstants());
        return in_array($ar, $nJ, $vo);
    }
}
