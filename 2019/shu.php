<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/8
 * Time: 11:13
 */

// fn =fn-1 +1

// 递归 fn=fn-1 的关系  sum
//  sum = （a1+qn）*n/2
function getNum($n){
    if($n==1){
        return 1;
    }

    $res=getNum($n-1)+2;

    return $res;
}

function sum($n){

    $an= getNum($n);

    return (1+$an)*$n/2;

}
echo  'an='. getNum(100);
echo  'sum(n)='.sum(100);