<?php
/*
*@author:xu.weishuai
*@Time:2019/11/20 19:55
*/

class BitMap
{
    public static $map = [];

    public static function setValue($value) {
        $index = self::getIndex($value);
        if (isset(self::$map[$index])) {
            self::$map[$index] |= 1 << ($value & 31);
        } else {
            self::$map[$index] = 1 << ($value & 31);
        }
    }

    public static function haxValue($value) {
        $index = self::getIndex($value);
        return isset(self::$map[$index]) ? (self::$map[$index] & (1 << ($value  & 31))) == (1 << ($value  & 31)) : false;
    }

    public static function display()
    {
        $keys = array_keys(self::$map);
        foreach ($keys as $key) {
            print "map index: {$key}, bit:";
            $temp = self::$map[$key];
            $bit_str = '';
            for ($i = 0; $i <= 31; $i++) {
                $bit_str = (1 & $temp) . $bit_str;
//                echo $bit_str;
//                echo '<br>';
                $temp >>= 1;
            }
            echo "{$bit_str}\n";

        }

    }

    private static function getIndex($value) {
        return $value >> 5;
    }
}


$list = [1, 3, 3, 7, 25, 88, 0];
foreach ($list as $value) {
    BitMap::setValue($value);
}

BitMap::display();

var_dump(BitMap::haxValue(87));
var_dump(BitMap::haxValue(88));
var_dump(BitMap::haxValue(89));

echo 1 << (4& 31);
echo '<br>';
echo 1 << (3& 31);
echo '<br>';
echo 1 << (2& 31);
echo '<br>';
echo 1 << (1);
