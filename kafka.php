<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/23
 * Time: 18:46
 */

//��Ҫ��װ��php-rdkafka��
//git��ַ:https://github.com/arnaud-lb/php-rdkafka
//php-producerʾ��

date_default_timezone_set('PRC');
//�����ļ�·��
$inputfile="/export/guochao/testdata/filter_access_2016091810.log";
//�½�kafka producerʵ��
$rk = new RdKafka\Producer();
$rk->setLogLevel(LOG_DEBUG);
//����kafka broker�б�
$rk->addBrokers("10.15.201.191:9092,10.15.201.197:9092,10.15.201.198:9092,10.15.201.199:9092");
//����topic
$kafkatopic = 'test';
$topic = $rk->newTopic($kafkatopic);
$fh = fopen($inputfile, 'r');
if (!$fh)
    exit(1);
$count = 0;
echo  "start process file ".date('Y-m-d H:i:s',time())."\n";
while ($line = fgets($fh, 2048))
{
    //RD_KAFKA_PARTITION_UA ��librdkafka�Զ�ѡ�����������Ҫ�ֹ�ѡ��������޸Ĵ˲���
    //0Ϊ��Ϣ��־������Ҫ�޸�
    //$line ��Ϣ����
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $line);
    ++$count;
    if ($count >= 200){
        $count = 0;
        //��kafka ������Ϣ���������Ϊ�ȴ�����ʱ�䣬��λ����
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









//php-consumerʾ��
date_default_timezone_set('PRC');
$conf = new RdKafka\Conf();
//�����ļ�·��
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
//����consumer��groupid
$conf->set('group.id', 'group0110-01');
//����kafka��Ⱥ��broker�б�
$conf->set('metadata.broker.list', '10.15.201.197:9092,10.15.201.198:9092,10.15.201.199:9092');
$topicConf = new RdKafka\TopicConf();
//����consumer���ѵ���㣬smallets �Ǵ��������Ϣ��ʼ����
$topicConf->set('auto.offset.reset', 'smallest');
//����offset��ŷ�ʽ
$topicConf->set('offset.store.method','broker');
// Set the configuration to use for subscribed/assigned topics
$conf->setDefaultTopicConf($topicConf);

$consumer = new RdKafka\KafkaConsumer($conf);

//����consumer���ѵ�topic�������Ƕ�������topic�ö��ŷָ�
$consumer->subscribe(['test']);

echo "Waiting for partition assignment... (make take some time when\n";
echo "quickly re-joining the group after leaving it.)\n";

//�Զ�д��ʽ��дָ���ļ�������ļ������򴴽�
if( ($TxtRes=fopen ($filename,"w+")) === FALSE){
    echo("������д�ļ���".$filename."ʧ��\n");
    exit();
}
echo ("������д�ļ�".$filename."�ɹ���".date('Y-m-d H:i:s',time())."\n");
while (true) {
    //������������ʼ������Ϣ
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
