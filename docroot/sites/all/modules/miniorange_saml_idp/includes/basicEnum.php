<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto WF;
        }
        self::$constCacheArray = array();
        WF:
        $Ah = get_called_class();
        if (array_key_exists($Ah, self::$constCacheArray)) {
            goto Po;
        }
        $pi = new ReflectionClass($Ah);
        self::$constCacheArray[$Ah] = $pi->getConstants();
        Po:
        return self::$constCacheArray[$Ah];
    }
    public static function isValidName($nA, $u9 = false)
    {
        $Zg = self::getConstants();
        if (!$u9) {
            goto IT;
        }
        return array_key_exists($nA, $Zg);
        IT:
        $BH = array_map("\x73\x74\162\164\157\154\x6f\167\x65\162", array_keys($Zg));
        return in_array(strtolower($nA), $BH);
    }
    public static function isValidValue($zf, $u9 = true)
    {
        $QZ = array_values(self::getConstants());
        return in_array($zf, $QZ, $u9);
    }
}
