<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2020/3/6
 * Time: 22:33
 */
namespace Lotteryservice;

class lotteryServiceClient extends \Grpc\BaseStub{

    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    public function lottery(\Lotteryservice\lotteryReq $argument, $metadata=[], $options=[]){
        // (/Greeter/lottery) 是请求服务端那个服务和方法，基本和 proto 文件定义一样
        // (\Lotteryservice\lotteryRes) 是响应信息（那个类），基本和 proto 文件定义一样
        return $this->_simpleRequest('/Greeter/lottery',
            $argument,
            ['\Lotteryservice\lotteryRes', 'decode'],
            $metadata, $options);
    }

}