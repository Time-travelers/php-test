<?php


// $conf = new  RdKafka\Conf();
// $conf->set('log_level', (string)LOG_DEBUG);
// $conf->set('debug', 'all');
// $rk = new RdKafka\Consumer($conf);
// $rk->addBrokers("localhost");
//
// $topic = $rk->newTopic("test");
//
// // The first argument is the partition to consume from.
// // The second argument is the offset at which to start consumption. Valid values
// // are: RD_KAFKA_OFFSET_BEGINNING, RD_KAFKA_OFFSET_END, RD_KAFKA_OFFSET_STORED.
// $topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);
//
// while (true) {
//     // The first argument is the partition (again).
//     // The second argument is the timeout.
//     $msg = $topic->consume(0, 1000);
//     if (null === $msg || $msg->err === RD_KAFKA_RESP_ERR__PARTITION_EOF) {
//         // Constant check required by librdkafka 0.11.6. Newer librdkafka versions will return NULL instead.
//         continue;
//     } elseif ($msg->err) {
//         echo $msg->errstr(), "\n";
//         break;
//     } else {
//         echo $msg->payload, "\n";
//     }
// }

$conf = new RdKafka\Conf();

// Set the group id. This is required when storing offsets on the broker
$conf->set('group.id', 'myConsumerGroup');

$rk = new RdKafka\Consumer($conf);
$rk->addBrokers("127.0.0.1");

$topicConf = new RdKafka\TopicConf();
$topicConf->set('auto.commit.interval.ms', 100);

// Set the offset store method to 'file'
$topicConf->set('offset.store.method', 'broker');

// Alternatively, set the offset store method to 'none'
// $topicConf->set('offset.store.method', 'none');

// Set where to start consuming messages when there is no initial offset in
// offset store or the desired offset is out of range.
// 'smallest': start from the beginning
$topicConf->set('auto.offset.reset', 'smallest');

$topic = $rk->newTopic("test", $topicConf);

// Start consuming partition 0
$topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);

while (true) {
    $message = $topic->consume(0, 120*10000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            var_dump($message);
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "No more messages; will wait for more\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timed out\n";
            break;
        default:
            throw new \Exception($message->errstr(), $message->err);
            break;
    }
}

?>
