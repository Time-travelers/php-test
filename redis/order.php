<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/9/22
 * Time: 14:59
 */
 include __DIR__.'/../Db/db.php';
$redis=new Redis();
$redis->connect('127.0.0.1',6379);
$redis_name='myList';


$db=Db::getIntance();
while (1){
    $user=$redis->lPop($redis_name);
    if(!empty($user)){
        $user=json_decode($user,true);

        $db->insert('redis',['order_id'=>$user['uId'],'create_time'=>$user['time']]);
    }else{
        sleep(2);
        continue;
    }

}
