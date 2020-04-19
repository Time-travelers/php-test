<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2020/3/21
 * Time: 20:45
 */

//连接单个的Redis 服务
#$redis = new Redis();
#$redis->connect('10.1.1.35',6379);
#echo $redis->get("data_80300_0_");

#连接Redis集群
$redis_list = ['127.0.0.1:7001','127.0.0.1:7002','127.0.0.1:7003'];
$redisCluster = new RedisCluster(NUll,$redis_list);
echo $redisCluster->get("xwsh");
echo "\n";
echo $redisCluster->get("xwsh");
echo "\n";
echo $redisCluster->get("xwsh");

#  echo "Server is running: " . $redis->ping();

echo "\n";
