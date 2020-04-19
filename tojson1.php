<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/8/19
 * Time: 14:29
 */
    $str="video[0][id]:47
video[0][name]:4147
video[0][url]:3
video[0][video_type]:1
video[0][duration]:100
video[0][size]:1000
publish[0][id]:57
//publish[0][file_id]:1
publish[0][account_id]:1
publish[0][cover]:1
publish[0][title]:title111111
publish[0][timing_flag]:1
publish[0][timing_publish]:2019
publish[0][draft]:1
";

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