<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2020/3/6
 * Time: 22:35
 */
namespace channel;

class channels
{
    public function lotteryService()
    {
        $client = new \Lotteryservice\lotteryServiceClient('127.0.0.1:50051', [
            'credentials' => \Grpc\ChannelCredentials::createInsecure()
        ]);

        return $client;
    }

}