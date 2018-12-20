<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/12/10
 * Time: 9:42
 */

class Foo {
    public function PublicMethod(){

    }
    private function PrivateMethod(){

    }
    public static function PublicStaticMethod(){}
    private static function PrivateStaticMethod()
    {

    }
}
    $foo = new Foo();
$callbacks = array( array($foo, 'PublicMethod'), array($foo, 'PrivateMethod'), array($foo, 'PublicStaticMethod'), array($foo, 'PrivateStaticMethod'), array('Foo', 'PublicMethod'), array('Foo', 'PrivateMethod'), array('Foo', 'PublicStaticMethod'), array('Foo', 'PrivateStaticMethod'), );
var_dump(is_callable('PrivateMethod',true));

die;

foreach ($callbacks as $callback){
    var_dump($callback);
    var_dump(method_exists($callback[0], $callback[1]));
    var_dump(is_callable($callback));
    echo str_repeat('-', 10); echo '<br />';
}
