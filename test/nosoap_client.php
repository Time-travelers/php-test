<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/11/5
 * Time: 9:51
 */
try {
    $client = new SoapClient(null, [
        'location' => 'http://ceshi.com/nosoap_service.php',
        'uri' => 'http://ceshi.com/nosoap_service'
    ]);

    $result =  $client->__soapCall('greet', [
        new SoapParam('Suhua', 'name')
    ]);
    printf("Result = %s", $result);
    $result =  $client->__soapCall('hello', [
            new SoapParam('xwsh', 'name')
        ]);

    printf("Result = %s", $result);
} catch (Exception $e) {
    printf("Message = %s",$e->__toString());
}