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
 *  ����redis�ķֲ�ʽ��
 * @example
 *  1���û�����齱����ֹ�û�ͬʱ����������
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
 *   2���û��µ�֧���߼���ʹ���ϸ�����
 *   $uid = 100;
 *   $order_id = 1;
 *   $lock = new \XCar\Ms\Lock($redis);
 *   $lock_key = "order:{$order_id}:pay";
 *   if($lock->check($lock_key)) {
 *      //�Ѿ��������˳��߼�
 *     throw new \Exception("�ö���֧���У����Ժ����", 1000);
 *   }
 *
 *   //your code��ĳЩǰ��У�飬����״̬�Ƿ���ȷ������Ƿ���࣬����Ƿ���ڵȵȹ���
 *   OrderValidate();
 *
 *   //��ʽ����������֧���߼�
 *   if (false == $lock->lock($lock_key)) {
 *      throw new \Exception("�ö���֧���У����Ժ����", 1000);
 *   }
 *   Pay();
 *
 *   //������ʹ�ð�ȫ�����ķ�ʽ
 *    $lock->safeUnlock($lock_key);
 *   //�����쳣����������ʹ��register_shutdown �����н���
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
     *  ����
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
     * ��ͨ������û������ȫУ��
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
     * ��ȫ������ֻ���ǵ�ǰ���̼�����ǰ���̲ſ��Խ��н���
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
     * ����Ƿ���, [true=�Ѿ�������, false=û����]
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
 *  ����redis�ķֲ�ʽ��
 * @example
 *  1���û�����齱����ֹ�û�ͬʱ����������
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
 *   2���û��µ�֧���߼���ʹ���ϸ�����
 *   $uid = 100;
 *   $order_id = 1;
 *   $lock = new \XCar\Ms\Lock($redis);
 *   $lock_key = "order:{$order_id}:pay";
 *   if($lock->check($lock_key)) {
 *      //�Ѿ��������˳��߼�
 *     throw new \Exception("�ö���֧���У����Ժ����", 1000);
 *   }
 *
 *   //your code��ĳЩǰ��У�飬����״̬�Ƿ���ȷ������Ƿ���࣬����Ƿ���ڵȵȹ���
 *   OrderValidate();
 *
 *   //��ʽ����������֧���߼�
 *   if (false == $lock->lock($lock_key)) {
 *      throw new \Exception("�ö���֧���У����Ժ����", 1000);
 *   }
 *   Pay();
 *
 *   //������ʹ�ð�ȫ�����ķ�ʽ
 *    $lock->safeUnlock($lock_key);
 *   //�����쳣����������ʹ��register_shutdown �����н���
 */
//1���û�����齱����ֹ�û�ͬʱ����������
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

// 2���û��µ�֧���߼���ʹ���ϸ�����
$uid = 100;
$order_id = 1;
$lock = new \XCar\Ms\Lock($redis);
$lock_key = "order:{$order_id}:pay";
$lock->unlock($lock_key);
if ($lock->check($lock_key)) {
    //�Ѿ��������˳��߼�
    throw new \Exception("�ö���֧���У����Ժ����11", 1000);
}

//your code��ĳЩǰ��У�飬����״̬�Ƿ���ȷ������Ƿ���࣬����Ƿ���ڵȵȹ���
luck_code($lock_key);

//��ʽ����������֧���߼�
if (false == $lock->lock($lock_key)) {
    throw new \Exception("�ö���֧���У����Ժ����", 1000);
}
//Pay();
echo '����֧����';
//������ʹ�ð�ȫ�����ķ�ʽ
$lock->unlock($lock_key);
$lock->safeUnlock($lock_key);
//�����쳣����������ʹ��register_shutdown �����н���
