<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/1/2
 * Time: 15:08
 */

// 填充一個數組
$temp=array_pad([1,2,3],20,20);

//var_dump($temp);

function add($a,$b){
    return $a+$b;

}
$arr=[1,2,3];
//$arr=[];
$tt=array_reduce($arr,'add','is null');
var_dump($tt);

$arr=array_reverse($arr);
$arr_flip=array_flip($arr);
var_dump($arr);
var_dump($arr_flip);
