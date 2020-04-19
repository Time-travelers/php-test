<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2020/3/17
 * Time: 16:56
 */


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
?>
