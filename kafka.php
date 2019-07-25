<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/23
 * Time: 18:46
 */

//需要安装【php-rdkafka】
//git地址:https://github.com/arnaud-lb/php-rdkafka
//php-producer示例

date_default_timezone_set('PRC');
//输入文件路径
$inputfile="/export/guochao/testdata/filter_access_2016091810.log";
//新建kafka producer实例
$rk = new RdKafka\Producer();
$rk->setLogLevel(LOG_DEBUG);
//设置kafka broker列表
$rk->addBrokers("10.15.201.191:9092,10.15.201.197:9092,10.15.201.198:9092,10.15.201.199:9092");
//设置topic
$kafkatopic = 'test';
$topic = $rk->newTopic($kafkatopic);
$fh = fopen($inputfile, 'r');
if (!$fh)
    exit(1);
$count = 0;
echo  "start process file ".date('Y-m-d H:i:s',time())."\n";
while ($line = fgets($fh, 2048))
{
    //RD_KAFKA_PARTITION_UA 让librdkafka自动选择分区，如需要手工选择分区则修改此参数
    //0为消息标志，不需要修改
    //$line 消息内容
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $line);
    ++$count;
    if ($count >= 200){
        $count = 0;
        //向kafka 发送消息，传入参数为等待返回时间，单位毫秒
        $rk->poll(50);
    }
}
if ($count)
{
    $rk->poll(50);
}
while ($rk->getOutQLen() > 0) {
    $rk->poll(50);
}
fclose($fh);
echo  "finish process file:".date('Y-m-d H:i:s',time())."\n";









//php-consumer示例
date_default_timezone_set('PRC');
$conf = new RdKafka\Conf();
//设置文件路径
$filename = "/export/guochao/testdata/consumer.log";
// Set a rebalance callback to log partition assignments (optional)
$conf->setRebalanceCb(function (RdKafka\KafkaConsumer $kafka, $err, array $partitions = null) {
    switch ($err) {
        case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:
            echo "Assign: ";
            var_dump($partitions);
            $kafka->assign($partitions);
            break;

        case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
            echo "Revoke: ";
            var_dump($partitions);
            $kafka->assign(NULL);
            break;

        default:
            throw new \Exception($err);
    }
});
//设置consumer的groupid
$conf->set('group.id', 'group0110-01');
//设置kafka集群的broker列表
$conf->set('metadata.broker.list', '10.15.201.197:9092,10.15.201.198:9092,10.15.201.199:9092');
$topicConf = new RdKafka\TopicConf();
//设置consumer消费的起点，smallets 是从最早的消息开始消费
$topicConf->set('auto.offset.reset', 'smallest');
//设置offset存放方式
$topicConf->set('offset.store.method','broker');
// Set the configuration to use for subscribed/assigned topics
$conf->setDefaultTopicConf($topicConf);

$consumer = new RdKafka\KafkaConsumer($conf);

//设置consumer消费的topic，可以是多个，多个topic用逗号分隔
$consumer->subscribe(['test']);

echo "Waiting for partition assignment... (make take some time when\n";
echo "quickly re-joining the group after leaving it.)\n";

//以读写方式打写指定文件，如果文件不存则创建
if( ($TxtRes=fopen ($filename,"w+")) === FALSE){
    echo("创建可写文件：".$filename."失败\n");
    exit();
}
echo ("创建可写文件".$filename."成功！".date('Y-m-d H:i:s',time())."\n");
while (true) {
    //消费启动，开始消费消息
    $message = $consumer->consume(120*1000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            fwrite ($TxtRes,$message->payload);
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "No more messages; will wait for more\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timed out\n";
            fclose($TxtRes);
            exit();
        default:
            throw new \Exception($message->errstr(), $message->err);
            echo  "finish process file:".date('Y-m-d H:i:s',time())."\n";
            fclose($TxtRes);
            exit();
    }
}
echo  "finish process file:".date('Y-m-d H:i:s',time())."\n";
