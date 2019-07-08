<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/8
 * Time: 10:04
 */

function hannuo($n,$a,$b,$c){

    if($n==1){

        echo '移动圆盘：'.$n.'从'.$a.'-》'.$c."\n";
    }else{

        hannuo($n-1,$a,$c,$b);
        echo '移动圆盘：'.$n.'从'.$a.'-》'.$c."\n";
        hannuo($n-1,$b,$a,$c);
    }


}
hannuo(3,'A','B','C');