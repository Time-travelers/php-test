<?php
    include './vendor/autoload.php';
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;
	use Monolog\Handler\FirePHPHandler;


//monolog - PHP 日志神器
//StreamHandler：记录日志到任何 PHP stream，用它来记录到文件。
//
//RotatingFileHandler: 每天一个文件，会自动删除比$maxFiles老的文件，这只是一个很随意的方案，You should use logrotate for high profile setups though。
//
//SyslogHandler: 记录到系统日志
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
//    $log_name->addInfo('My logger is now ready',['name'=>'xwsh']);

//    $log->addRecord();

