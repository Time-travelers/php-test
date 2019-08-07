<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/4/16
 * Time: 9:21
 */

var_dump(empty(0.00));

die;
class Foo {
    function __construct() {
        $this->bar = new Bar($this);
    }
}

class Bar {
    function __construct($foo) {
        $this->foo = $foo;
    }
}
$obj = new Foo();
for ($i = 0; $i < 100; $i++) {

    $obj = new Foo();

//    $obj->__destruct();

    unset($obj);

    echo memory_get_usage(), "
";
}


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
    $db->query("select * from table");
    echo "m2:".memory_get_usage()."
";
    usleep(10000);
}