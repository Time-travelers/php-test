<?php


function get(){

    yield 1;
    echo 'hello world';
    yield 2;

    for($i=20;$i<30;$i++){
        yield $i;
    }
}
foreach (get() as $k=>$v){
  

    var_dump($v);
    break;
}
var_dump(get());
foreach (get() as $k=>$v){


    var_dump($v);
}