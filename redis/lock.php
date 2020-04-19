<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2020/3/23
 * Time: 21:26
 */

$redis=new Redis();
$redis->connect('127.0.0.1',6379);
$all_time=time();
$time=2;
if($redis->set('demo',1,['NX','EX'=>$time])&&$all_time+=$time){

    echo '恭喜，抢到锁了'.PHP_EOL;
    sleep(3);
    if(time()<$all_time){

        $redis->del('demo');
        echo '释放锁成功'.PHP_EOL;
    }else{
        echo '锁失效了'.PHP_EOL;
    }

}else{
    echo '没有抢到锁，请稍后再试';
}