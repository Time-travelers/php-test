<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/3
 * Time: 15:17
 */



interface Idemo{

    function add($a,$b);
    function jian($a,$b);

}
class demo implements Idemo {
    private static $intance;

//    private function __construct()
//    {
//
//    }

    public static function getIntance(){
        if(!(self::$intance instanceof Idemo)){
            self::$intance=new self;
        }
        return  self::$intance;

    }


    function add($a,$b){
        return $a+$b;
    }

    function jian($a,$b){
        return $a-$b;
    }
}

$c['a']=1;
$c['b']=3;
$demo=demo::getIntance();
//$dd=new demo();
echo $demo->add($c['a'],$c['b']);
echo '<pre>';
var_dump($c);


?>