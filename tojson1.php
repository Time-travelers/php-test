<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/8/19
 * Time: 14:29
 */
    $str="start_time:2019-01-01
end_time:2019-12-30
type:1
service_line:1000066
remark:测试
file_info[0][file_id]:28022
file_info[0][file_name]:【商保】阳光人寿-理赔材料清单.pdf
file_info[1][file_id]:28021
file_info[1][file_name]:塞纳德财务报表商务平台11.25.xls
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