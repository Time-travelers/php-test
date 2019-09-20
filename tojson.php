<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/1/14
 * Time: 10:35
 */


$msg='
json 转postman用的 k：v
?json={}

postman用的 k：v 转json
?str=
<br>';

echo $msg;
$_GET['str']='
order_id:61011
code:
customer_name:
salespersonDeparts:
brand:
dealer_id:
start_time:
end_time:
';
$_GET['json']='{"token":"2e5e9cdaa074cf865d4d80006bf124f9","sign":"963593b841787fde2bcec4d74db0dbf1","_t":1562297345,"point_id":9,"apply_id":116915,"status":1,"reset_point_id":0,"group_id":"","uid":"1005046"}';

function jsonToStr($json){

    $arr=json_decode($json,true);
//    $num=count($arr);
//    $i=0;
//    while ($i<$num){
//
//    }
    $str=[];
    foreach ($arr as $k=>$v){

        $str[]=$k.':'.$v;
    }

    return implode('<br>',$str);

}
function strToJson($str){

//    $str="series_ids[]:level_1%7C172
//            level_ids[]:1
//            level_ids[]:2
//            price_tag_ids[]:1
//            price_tag_ids[]:2
//            channel_ids[]:100007
//            channel_ids[]:100008
//            publication_adv_id:110
//            area_ids[]:475
//            area_ids[]:507
//            order_id:57444";

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
                return  json_encode($res);
}

if(isset($_GET['json'])){

  echo   jsonToStr($_GET['json']).'<br>';

}
if(isset($_GET['str'])){

    echo   strToJson($_GET['str']).'<br>';

}

die;