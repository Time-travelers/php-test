<?php
/**
 * Date: 2019/8/1
 */
// $conf = new RdKafka\Conf();
// $conf->set('log_level', (string) LOG_DEBUG);
// $conf->set('debug', 'all');
// $rk = new RdKafka\Producer($conf);
// $rk->addBrokers("localhost");
//
// $topic = $rk->newTopic("test");
//
// $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message payload");
// // $rk->purge(RD_KAFKA_PURGE_F_QUEUE);
// //
// // $rk->flush(5000);


$conf = new RdKafka\Conf();
$conf->set('metadata.broker.list', 'localhost:9092');

//If you need to produce exactly once and want to keep the original produce order, uncomment the line below
//$conf->set('enable.idempotence', 'true');

$producer = new RdKafka\Producer($conf);

$topic = $producer->newTopic("test");

for ($i = 0; $i < 10; $i++) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
    $producer->poll(0);
}

for ($flushRetries = 0; $flushRetries < 10; $flushRetries++) {
    $result = $producer->flush(10000);
    if (RD_KAFKA_RESP_ERR_NO_ERROR === $result) {
        break;
    }
}

if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
    throw new \RuntimeException('Was unable to flush, messages might be lost!');
}

