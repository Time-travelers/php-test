<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/10/9
 * Time: 14:32
 */



    $hosts = [
        '192.168.1.1:9200',         // IP + Port
        '192.168.1.2',              // Just IP
        'mydomain.server.com:9201', // Domain + Port
        'mydomain2.server.com',     // Just Domain
        'https://localhost',        // SSL to localhost
        'https://192.168.1.3:9200'  // SSL to IP + Port
    ];
    //对于有密码的情况下
    $hosts = [
        // This is effectively equal to: "https://username:password!#$?*abc@foo.com:9200/"
        [
            'host' => 'foo.com',
            'port' => '9200',
            'scheme' => 'https',
            'user' => 'username',
            'pass' => 'password!#$?*abc'
        ],
        // This is equal to "http://localhost:9200/"
        [
            'host' => 'localhost',    // Only host is required
        ]
    ];
    try{
        $client= \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
    }catch (Elasticsearch\Common\Exceptions\Curl\CouldNotConnectToHost $e) {
        $previous = $e->getPrevious();
//        if ($previous instanceof 'Elasticsearch\Common\Exceptions\MaxRetriesException') {
//            echo "Max retries!";
//        }
    }

$params = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_shards' => 3,
            'number_of_replicas' => 2
        ],
        'mappings' => [
            'my_type' => [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => [
                    "title" => [
                        "type" => "text",
                        "fields" => [
                            "keyword" => [
                                "type" => "keyword",    //如此可以根据title.keyword进行精确查询
                                "ignore_above" => 256
                            ]
                        ]
                    ],
                    'first_name' => [
                        'type' => 'string',
                        'analyzer' => 'standard'
                    ],
                    'age' => [
                        'type' => 'integer'
                    ]
                ]
            ]
        ]
    ]
];
// Create the index with mappings and settings now
$response = $client->indices()->create($params);
