<?php
    include './vendor/autoload.php';
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;
	// 创建日志频道
	$log = new Logger('name');
	$log->pushHandler(new StreamHandler('D:\WWW\time-travelers\your.log', Logger::WARNING));
	// 添加日志记录
	$log->addWarning('Foo');
	$log->addError('Bar');
//    $log->addInfo('My logger is now ready');
