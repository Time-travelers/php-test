<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2020/3/18
 * Time: 7:37
 */

$redis=new Redis();
$redis->connect('127.0.0.1',6379);

//$redis->set('score',1);
$redis->incrBy('score',10);
session_start();


$arc=json_encode($_REQUEST);
$lock=session_id().md5($arc);

echo $redis->ttl($lock).PHP_EOL;
if($redis->get($lock)){
    echo '请求过快请稍后';
}else{
    echo '请求成功';
}

$redis->set($lock,true,5);
echo $redis->get("score").PHP_EOL;
echo $redis->ttl($lock).PHP_EOL;


    echo $lock;