<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/4/16
 * Time: 9:21
 */


//class Foo {
//    function __construct() {
//        $this->bar = new Bar($this);
//    }
//    public function e($a){
//        $this->a=$a;
//    }
//}
//
//class Bar {
//    function __construct($foo) {
//        $this->foo = $foo;
//    }
//    public function e($a){
//        $this->a=$a;
//    }
//}
//$obj = new Foo();
//
//for ($i = 0; $i < 100; $i++) {
//
//    $obj = new Foo();
//
//
////    $obj->__destruct();
//
////    unset($obj);
//
//    echo memory_get_usage(), "
//";
//}
//die;

class db
{
    public $sql;

    public function query($sql)
    {
        $this->sql[] = $sql;
    }
}

$db = new db();
while(1) {
    echo "m1:".memory_get_usage()."
";
    echo "m1:".memory_usage()."
";
    $db->query("select * from table");
    echo "m2:".memory_get_usage()."
";
    echo "m2:".memory_usage()."
";
    usleep(10000);
}

