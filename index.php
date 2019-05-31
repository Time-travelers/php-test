<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/12/21
 * Time: 13:24
 */

echo 'hello welcome to xwsh page'.'
';

//pcntl_fork();
//posix_getpid();

$title = "My Amazing PHP Script";
$pid = getmypid(); // you can use this to see your process title in ps
echo cli_get_process_title();
if (!cli_set_process_title($title)) {
    echo "Unable to set process title for PID $pid...\n";
    exit(1);
} else {
    echo "The process title '$title' for PID $pid has been set for your process!\n";
    sleep(50);
}


//首先第一次调用test(),static对 $count 进行初始化，其后每一次执行完都会保留 $count 的值,不再进行初始化，相当于直接忽略了 static $count=0; 这一句。
function test1(){
    static $count=0;
    echo $count;

    $count++;
}
test1();
test1();
test1();
test1();
test1();
//本例比较有意思的是echo a的值。相信很多人认为是12345678910吧，
//其实不然，是1098765432。为什么呢？因为函数还没执行echoa的值。相信很多人认为是12345678910吧，其实不然，
//是1098765432。为什么呢？因为函数还没执行echoa前就进行了下一次的函数递归。真正执行echo a是当a是当a<10条件不满足的时候，echo a,返回a,
//返回result,对于上一层而言，执行完递归函数，开始执行本层的echo $a,依次类推
function test($a=0,&$result=array()){
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a,$result);
    }
    echo $a;
    return $result;

}
test();
//var_dump(test());
die;

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