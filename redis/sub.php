<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/9/17
 * Time: 17:15
 */
#subscribe客服端 sub.php
$redis = new \Redis();
$res = $redis->pconnect('127.0.0.1', 6379);
$redis->setOption(Redis::OPT_READ_TIMEOUT, -1);
$key = 'first';
#这里的subscribe是一个独占链接的，你在终端执行名“subscribe first” 后，屏幕将如同开启redis服务的终端一样，处于一直在线等一样。因此此处可以看出订阅者（客服端）的程序是以阻塞的方式等待，发布者的消息。
ini_set('default_socket_timeout', -1);
$redis->subscribe(array($key),'callback');



function callback($redis, $channel, $msg){
    var_dump($redis);
    echo $channel;
    echo $msg;
    return true;
}
