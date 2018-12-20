<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/11/5
 * Time: 9:51
 */
function greet($param)
{
    $value = 'Hello '.$param;
    return new SoapParam($value, 'greetReturn');
}
function hello($param)
{
    $value = 'Hello '.$param;
    return new SoapParam($value, 'helloReturn');
}


$server = new SoapServer(null, [
    'uri' => 'http://ceshi.com/nosoap_service'
]);

$server->addFunction('hello');
$server->addFunction('greet');
$server->handle();