<?php


     $client = new Redis();
     $client->pconnect('127.0.0.1',6379);

     $client->setex("name",300 , 0);
     for ($i = 0; $i < 2000; $i++) {
            $num = intval($client->get("name"));
            $num = $num + 1;
            $client->setex("name",1000 , $num);
            ECHO $num."<br>";
//            usleep(10000);
     }