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

//求斐波那契 fn=fn-1 +fn-2/*
//2. 一只青蛙一次可以跳上 1 级台阶，也可以跳上 2 级。求该青蛙跳上一个n级的台阶总共有多少种跳法？
//
//3. 一只青蛙一次可以跳上 1 级台阶，也可以跳上 2 级，...... ，也可以跳上n级，此时该青蛙跳上一个 n 级的台阶共有多少种跳法？
//
//4. 用 2x1 （图 2.13 的左边）的小矩形横着或者竖着去覆盖更大的矩形。请问用 8 个 2x1 小矩形无重叠地覆盖一个 2x8 的大矩形（图 2.13 的右边），总共有多少种方法？*/
//算法设计思想
//1. 递归方法（Recursive Method）。循环调用自身。缺点：有大量的重复计算，不实用。优点：实现非常简单，代码短小。对于斐波那契数列的实现，其时间复杂度为 O(2n)。
//
//2. 迭代方法 （Iterative Method）。通过循环，替代递归方法，从理论上说，任何递归算法都可用迭代算法实现。优点：节省栈空间，有可能降低时间复杂度。缺点是相对于递归方法，实现较难，代码往往会复杂一些。对斐波那契数列，其时间复杂度为 O(n)，是比较实用的算法。
//
//3. 公式法。通过不常用的计算斐波那契数列的第 n 项的数学公式，如果采用合适的实现方式，可将时间复杂度降为 O(logn)，具体数学公式和相关说明如下（摘自参考资料）：
//递归
function bo($n){

    if($n==1){
        return 1;
    }
    if($n==0){
        return 0;
    }
    return bo($n-1)+bo($n-2);

}
//求和
function sum_bo($n){

    if($n==1){
        return 1;
    }
    if($n==0){
        return 0;
    }
    $sum=sum_bo($n-1)+bo($n);
    return $sum;
}
//迭代方法

function bo1($num){

    $n[0]=0;
    $n[1]=1;
    for ($i=2;$i<=$num;$i++){

        $n[$i]=$n[$i-1]+$n[$i-2];

    }
    var_dump($n);
    return  $n;



}
//求和
function bo1_sum($n){


    $sum=bo1($n);
    $res=0;
    foreach ($sum as $k=>$v){
        $res+=$v;
    }
    return $res;
}
echo 'bo:'.bo(10);
echo 'bo_sum:'.sum_bo(10);
//var_dump(bo1(10));
echo 'bo1_sum:'.bo1_sum(10);

//杨辉三角

// i 行 j 列
function yh($i,$j){

    if($j==1||$i==$j){

        return 1;
    }

    return yh($i-1,$j)+yh($i-1,$j-1);


}
echo 'YH三角:'.yh(5,3);

// i 行 j 列 迭代
function yh1($i,$j){

    $num=[];


    $h=$i;
    $l=$j;
    for($i=1;$i<=$h;$i++){

        for($j=1;$j<=$l&$i>=$j;$j++){

            if($j==1||$i==$j){

                $num[$i][$j]=1;
            }else{
                $num[$i][$j]=$num[$i-1][$j]+$num[$i-1][$j-1];
            }

        }

    }

//  生成杨辉 打印
    echo "\n";
    foreach ($num as $k=>$v){

        foreach ($v as $kk=>$vv){

            echo $vv.",";
        }
        echo "\n";
    }

    return $num;



}

echo 'YH三角:';
yh1(5,5);