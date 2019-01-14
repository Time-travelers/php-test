<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/1/14
 * Time: 10:35
 */


$str="time_dimensionality:1
data_dimensionality:1
start_time:
end_time:
order_id:
brand_id:
customer_id:
department_id:";

$arr=explode("\r\n",$str);
$res=[];
foreach ($arr as $k=>$v){
    $tem=explode(':',$v);

    if(strpos($tem[0],"[0]")){
        $tem_new=explode('[0]',$tem[0]);
        $key_new=str_replace(['[',']'],'',$tem_new[1]);
        $res[$tem_new[0]][0][$key_new]=$tem[1];

    }else{
        $res[$tem[0]]=$tem[1];
    }

}
echo json_encode($res);
die;