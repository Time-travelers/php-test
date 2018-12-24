<?php
    include './vendor/autoload.php';
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;
	use Monolog\Handler\FirePHPHandler;
	// 创建日志频道
	$log = new Logger('log');
	$log_name = new Logger('log_name');

    $json= new \Monolog\Formatter\JsonFormatter();
//    $es= new \Monolog\Formatter\ElasticaFormatter();
//    $logStash= new \Monolog\Formatter\LogstashFormatter(); //把日志记录格式化成logstash的事件JSON格式。



	$stream=new StreamHandler('D:\WWW\time-travelers\your.log', Logger::INFO);
	$stream_name=new StreamHandler('D:\WWW\time-travelers\your.log', Logger::INFO);

    $stream->setFormatter($json);

    $firePhp=new FirePHPHandler();
//    $socket=new \Monolog\Handler\SocketHandler();  //通过socket写日志。

	$log->pushHandler($stream);
    $log->pushHandler($firePhp);
    $log_name->pushHandler($stream_name);

//Processor可以为日志记录添加额外的信息
    $log->pushProcessor(function ($record) {
        $record['extra']['dummy'] = 'Hello world!';
        return $record;
    });
	// 添加日志记录
	$log->addWarning('Foo',['name'=>'xwsh']);
	$log->addError('Bar',['name'=>'xwsh']);
    $log->addInfo('My logger is now ready',['name'=>'xwsh']);
    $log_name->addInfo('My logger is now ready',['name'=>'xwsh']);

//    $log->addRecord();

