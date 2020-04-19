<?php

$conf = new RdKafka\Conf();
$conf->set('log_level', (string) LOG_DEBUG);
$conf->set('debug', 'all');
$rk = new RdKafka\Producer($conf);
$rk->addBrokers("39.105.128.48:9092");
$topic = $rk->newTopic("test");
$topic->produce(0, 0, "Message payload");
$rk->flush(5000);
