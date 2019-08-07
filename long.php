<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/25
 * Time: 18:27
 */
//关于job基类分析和注解
//所有的job类都要继承与job抽象基类，实现抽象方法run
namespace Base\Job;


abstract class Abstraction
{
    /**
     *  当前进程sleep N毫秒，给CPU空闲的时间
     * @var int
     * */
    //这个需要根据实际业务场景来决定休眠的时间，通常不建议超过10s，大多应该是在ms级别。
    //休眠的作用是为了让出对cpu的利用，同时也是应该根据消费的业务繁忙程度来决定。之后的异步任务中有更详细的说明
    const SLEEP_INTERVAL_MS = 5;

    /**
     * 最大执行任务数，执行完之后主动退出，使用新的进程,释放内存
     * @var int
     **/
    //最大的处理任务数量，超过该值之后重启job进程，用于释放内存等。如果设置为0表示不主动退出
    const MAX_TASK_NUM = 100000;

    protected $worker; //对应的子进程实例
    protected $job_id; //当前进程的id，比如test_job任务一共十个进程，那么他的进程id为 [0,1,2...9]，$this->id为当前进程在
    protected $worker_count = 0; //总的进程数量

    final public function process() {
        $interval_ms = max(static::SLEEP_INTERVAL_MS, 5);
        $i = 0;
        while (static::MAX_TASK_NUM == 0 || $i < static::MAX_TASK_NUM) {
            $i++;
            $this->run();
            usleep($interval_ms * 1000);
        }
    }

    abstract public function run(); //需要自行实现的方法

}


class OrderJob extends \Base\Job\Abstraction
{
    const SLEEP_INTERVAL_MS = 5000;
    const MAX_TASK_NUM = 1000000;

    public function run()
    {
        //从数据库中获取到已经到期的未支付的订单
        //假如当前工作的进程跟分表的数量相同，每个进程处理一个表的数据
        //进程id从0开始,[0,1,2...N-1]
        $table = 'order_'.str_pad($this->job_id, 2, '0', STR_PAD_LEFT);
        $list = Order::findUnPay($table);
        if (!$list) {
            return false;
        }

        //得到支付id
        $pay_ids = [];
        foreach($list as $key => $value) {
            $pay_ids[] = $value['pay_id'];
        }
        //主动去第三方支付获取
        $ret = Pay::getStatus($pay_ids);
        //根据最新状态进行修改,修改为已支付或者已取消
        Lock();
        Order::updateStatusByPayId($ret);
        Unlock();
    }
}
//在上面的例子里，我们实现了一个不停检查用户提交订单是否支付成功的逻辑，如果超时未支付，则取消订单，释放库存。
//该例子更推荐使用mq的方式进行交互解耦

//关于job基类分析和注解
//所有的job类都要继承与job抽象基类，实现抽象方法run
//namespace Base\Job;

