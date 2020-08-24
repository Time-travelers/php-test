<?php

function gen3(){
    echo "test\n";
    echo (yield 1)."I\n";
    echo (yield 2)."II\n";
    echo (yield 3 + 1)."III\n";
}
$gen = gen3();
foreach ($gen as $key => $value) {
    echo "{$key} - {$value}\n";

}

echo '-------------------------';
$gen = gen3();
$gen->rewind();

echo $gen->key().' - '.$gen->current()."\n";
echo $gen->send("send value  ");
echo $gen->send("send value ");
echo $gen->send("send value ");

$gen->next();
echo '-------------------------';

function gen4(){
    $id = 2;
    $id = yield $id;
    echo $id;
}

$gen = gen4();
$gen->send($gen->current() );