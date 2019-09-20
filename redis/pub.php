<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/9/17
 * Time: 17:16
 */

#public客服端 pub.php
#无需独占链接，不是堵塞的
$redis = new \Redis();
$res = $redis->connect('127.0.0.1', 6379, 1 );
$key = 'first';//Channel 订阅这频道的订阅者，都能收收到消息
$value = 'hello world！';
$res = $redis->publish($key,$value);