<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/8/19
 * Time: 14:29
 */
    $str="order_id:61011
code:
customer_name:
salespersonDeparts:
brand:
dealer_id:
start_time:
end_time:";

$arr=explode("\r\n",$str);
$res=[];
foreach ($arr as $k=>$v){
    if(!$v){
        continue;
    }
    $tem=explode(':',$v);

    if(strpos($tem[0],"[0]")){
        $tem_new=explode('[0]',$tem[0]);
        $key_new=str_replace(['[',']'],'',$tem_new[1]);
        $res[$tem_new[0]][0][$key_new]=$tem[1];

    }else{
        $res[$tem[0]]=$tem[1];
    }

}
echo  json_encode($res);