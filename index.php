<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/12/21
 * Time: 13:24
 */

echo 'hello welcome to xwsh page';

echo gettype(date('H',(9)*3600));

//for($i=0;$i<24;$i++){
//    $key=date('H',$i*3600);
//    $t[$key]=4;
//}
//echo json_encode($t);
//die;

$arr=[1,6,3,4,8];
$arr = array("00"=>"2","03"=>"50","10"=>"30","11"=>"30");
ksort($arr);
print_r($arr);


die;
$str="id:14
m_id:2794
order_id:60061
url_state:
url_type:
channel_ids:
publication_adv_id:
series_ids:
level_ids:
price_tag_ids:
area_ids:";

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