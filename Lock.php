<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/25
 * Time: 17:53
 */

namespace XCar\Ms;

use function foo\func;

/**
 *  基于redis的分布式锁
 * @example
 *  1、用户参与抽奖，防止用户同时发起多次请求
 *   $uid = 100;
 *
 *   $lock = new \XCar\Ms\Lock($redis);
 *   $lock_key = "topic_luck_draw_{$uid}";
 *   if (false == $lock->lock($lock_key, 600)) {
 *      return false;
 *   }
 *   luck_code($uid);
 *   $lock->unlock($lock_key);
 *
 *   2、用户下单支付逻辑，使用严格检查锁
 *   $uid = 100;
 *   $order_id = 1;
 *   $lock = new \XCar\Ms\Lock($redis);
 *   $lock_key = "order:{$order_id}:pay";
 *   if($lock->check($lock_key)) {
 *      //已经有锁，退出逻辑
 *     throw new \Exception("该订单支付中，请稍后操作", 1000);
 *   }
 *
 *   //your code，某些前置校验，比如状态是否正确，库存是否空余，红包是否过期等等规则
 *   OrderValidate();
 *
 *   //正式加锁，生成支付逻辑
 *   if (false == $lock->lock($lock_key)) {
 *      throw new \Exception("该订单支付中，请稍后操作", 1000);
 *   }
 *   Pay();
 *
 *   //在这里使用安全解锁的方式
 *    $lock->safeUnlock($lock_key);
 *   //考虑异常场景，可以使用register_shutdown 来进行解锁
 **/
define('MS_SERVER_ID','xcar');
class Lock
{
    const KEY_PREFIX = 'MS_LOCK_';


    /* @var \Redis */
    private $redis = null;
    /* @var string */
    private $salt = null;

    private static $lock_keys = [];

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
//        $this->salt = MS_SERVER_ID . '_' . gethostname() . '_' . posix_getpid();
    }

    /**
     *  加锁
     * @param string $key
     * @param int $ttl
     * @return bool
     */
    public function lock($key, $ttl = 300)
    {
        static::$lock_keys[$key] = time() + $ttl;
        return $this->redis->set($this->key($key), 1, ['nx', 'ex' => $ttl]);
    }

    /**
     * 普通解锁，没有做安全校验
     * @param string $key
     * @return mixed
     **/
    public function unlock($key)
    {
        unset(static::$lock_keys[$key]);
        static::$lock_keys[$key] = null;
        return $this->redis->del($this->key($key));
    }

    /**
     * 安全解锁，只有是当前进程加锁当前进程才可以进行解锁
     * @param string $key
     * @return bool|int
     **/
    public function safeUnlock($key)
    {
        if (isset(static::$lock_keys[$key]) && static::$lock_keys[$key] >= time()) {
            return $this->unlock($key);
        }
        return false;
    }

    /**
     * 检查是否锁, [true=已经存在锁, false=没有锁]
     * @param string $key
     * @return bool
     **/
    public function check($key)
    {
        return $this->redis->exists($this->key($key));
    }

    protected function key($key)
    {
        return static::KEY_PREFIX . $key;
    }
}

/*
 *  基于redis的分布式锁
 * @example
 *  1、用户参与抽奖，防止用户同时发起多次请求
 *   $uid = 100;
 *
 *   $lock = new \XCar\Ms\Lock($redis);
 *   $lock_key = "topic_luck_draw_{$uid}";
 *   if (false == $lock->lock($lock_key, 600)) {
 *      return false;
 *   }
 *   luck_code($uid);
 *   $lock->unlock($lock_key);
 *
 *   2、用户下单支付逻辑，使用严格检查锁
 *   $uid = 100;
 *   $order_id = 1;
 *   $lock = new \XCar\Ms\Lock($redis);
 *   $lock_key = "order:{$order_id}:pay";
 *   if($lock->check($lock_key)) {
 *      //已经有锁，退出逻辑
 *     throw new \Exception("该订单支付中，请稍后操作", 1000);
 *   }
 *
 *   //your code，某些前置校验，比如状态是否正确，库存是否空余，红包是否过期等等规则
 *   OrderValidate();
 *
 *   //正式加锁，生成支付逻辑
 *   if (false == $lock->lock($lock_key)) {
 *      throw new \Exception("该订单支付中，请稍后操作", 1000);
 *   }
 *   Pay();
 *
 *   //在这里使用安全解锁的方式
 *    $lock->safeUnlock($lock_key);
 *   //考虑异常场景，可以使用register_shutdown 来进行解锁
 */
//1、用户参与抽奖，防止用户同时发起多次请求
function luck_code($uid){

    echo $uid;
}


$uid = 100;
$redis = new \Redis();
$redis->connect('10.20.54.48', 6051);
$redis->auth('redistest6051');


//$lock = new \XCar\Ms\Lock($redis);
//$lock_key = "topic_luck_draw_{$uid}";
//
//if (false == $lock->lock($lock_key, 600)) {
//    echo '000';
//    return false;
//}
//luck_code($uid);
//$lock->unlock($lock_key);
//
//
//die;

// 2、用户下单支付逻辑，使用严格检查锁
$uid = 100;
$order_id = 1;
$lock = new \XCar\Ms\Lock($redis);
$lock_key = "order:{$order_id}:pay";
$lock->unlock($lock_key);
if ($lock->check($lock_key)) {
    //已经有锁，退出逻辑
    throw new \Exception("该订单支付中，请稍后操作11", 1000);
}

//your code，某些前置校验，比如状态是否正确，库存是否空余，红包是否过期等等规则
luck_code($lock_key);

//正式加锁，生成支付逻辑
if (false == $lock->lock($lock_key)) {
    throw new \Exception("该订单支付中，请稍后操作", 1000);
}
//Pay();
echo '加锁支付中';
//在这里使用安全解锁的方式
$lock->unlock($lock_key);
$lock->safeUnlock($lock_key);
//考虑异常场景，可以使用register_shutdown 来进行解锁
