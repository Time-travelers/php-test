<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/11/16
 * Time: 14:29
 */

try {
    $client = new SoapClient('hello.wsdl');
    $result =  $client->__soapCall('greet', [
        ['name' => 'Suhua']
    ]);
    printf("Result = %s", $result->greetReturn);
} catch (Exception $e) {
    printf("Message = %s",$e->__toString());
}