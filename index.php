<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/12/21
 * Time: 13:24
 */

echo 'hello welcome to xwsh page';


$str="brand_type:1
relation_brand_name:xxxxxx
bids:1,2
bnames:奥迪,宝马
remark:bbb";

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