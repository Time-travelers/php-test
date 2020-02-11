<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/9/22
 * Time: 16:08
 */

$redis=new Redis();
$redis->connect('127.0.0.1',6379);
$redis_name='myList';
//$uId=$_GET['uId'];

for($i=0;$i<100;$i++){
    $uId=rand(10000,99999);
    $arr['uId']=$uId;
    $arr['time']=time();
    if($redis->lLen($redis_name)<10){
        $redis->lPush($redis_name,json_encode($arr));
        echo $uId.'秒杀成功'.'<br>';
    }else{
        echo '秒杀结束'.'<br>';
    }
}

