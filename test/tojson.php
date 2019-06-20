<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/1/14
 * Time: 10:35
 */


$str="series_ids[]:level_1%7C172
series_ids[]:level_1%7C258
level_ids[]:1
level_ids[]:2
price_tag_ids[]:1
price_tag_ids[]:2
channel_ids[]:100007
channel_ids[]:100008
publication_adv_id:110
area_ids[]:475
area_ids[]:507
order_id:57444";

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