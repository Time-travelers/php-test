<?php
static $count=0;
echo $count++;
static $count=2;
echo $count;

die;



function test(){
static $count=0;
echo $count;

$count++;
}
test();
test();
test();
test();
test();


die;
class A {
    function b(B $c, array $d, $e) {
    }
}
class B {
}

$refl = new ReflectionClass('A');
$par = $refl->getMethod('b')->getParameters();

echo '00';
echo $par[0]->getClass()->getName();
var_dump($par[0]->getClass()->getName());  // outputs B
var_dump($par[1]->getClass());  // note that array type outputs NULL
var_dump($par[2]->getClass());  // outputs NULL


die;

/**
 * Class Foo55555555
 */
//function xwshx(){
//  echo 'xwshx';
//}
//$a=new ReflectionFunction('xwshx');
//ReflectionFunction::export('xwshx');
//echo $a->invoke();die;


interface xwsh{

}
class f{

}
class Foo extends f implements xwsh{
     const FOO  = 1;
     const BAR  = 2;
     const BAZ  = 3;
     private $a;
     public static $c;

    /**
     * Class Foo
     */
     public  function getFoo($a=0){
      echo 'hello word';
     }
     public function __construct(f $a)
     {
            echo '__construct';
     }
}
$f=new f();
$foo = new Foo($f);
//
$reflect = new ReflectionClass($foo);
//
//$contract=$reflect->getConstructor();
//$Parameters=$contract->getParameters();
//foreach ($Parameters as $parameter) {
//    $cdc= $parameter->getClass()->getName();
//    var_dump($cdc);
//}
//
//var_dump($Parameters);die;

//$t=$reflect->getReflectionConstants();
//echo '<pre>';
//var_dump($t);die;

$consts  = $reflect->getMethod('getFoo');
//$a=$consts->getDeclaringClass();
////echo $a.'|';
//echo ReflectionMethod::IS_PUBLIC;
//foreach ($consts as $const) {
//    print $const->getName() . "\n";
//}

//$cc=ReflectionClass::export($foo,true);
echo $consts->invoke($foo,'');
echo $consts->invokeArgs($foo,[]);

//var_dump($cc);
die;
function Car ($name){
  return function($statu) use ($name) {

      return sprintf("Car %s is %s", $name, $statu);

  };
}
// 将车名封装在闭包中
$car = Car("bmw");
// 调用车的动作
// 输出--> "bmw is running"
echo $car("running");

die;

/* 示例三修改：匿名函数作为参数传入，并且携带参数 */
//function test(){
//    $content = '这里是闭包函数的输出内容';
//    function ()use($content) {
//        echo $content;
//    }
//
//}
//
//
//test();die;
/* 示例三修改：匿名函数作为参数传入，并且携带参数 */

//    $content = '这里是闭包函数的输出内容';
//    $a=function ()use($content) {
//        echo $content;
//    };

/* 示例三修改：匿名函数作为参数传入，并且携带参数 */
//$content = '这里是闭包函数的输出内容';
//$a=function ($callback) use ($content){
//    $callback($content);
//};
//
//$b=function ($content){
//    // 闭包函数
//    echo $content;
//};

class demo{
    //error_reporting(E_ERROR);
    public  function foo($a=1,$b=2){
        echo $a.'----'.$b."\n";

    }


}
class container{

    private $list=array();
    public function set($name,$class){
        $this->list[$name]=$class;
    }
    public function get($name){
        if(isset($this->list[$name])){
            return $this->list[$name]();
        }

    }

}
$container=new container();
$container->set('demo',function (){
    return new demo();
});
$container->get('demo')->foo();



$name='xwsh';
$c=function ($hh)use($name){
    // 闭包函数
    echo $hh.'->'.$name;
    return new demo();
};
//var_dump($c);
$c('hello')->foo();



die;



call_user_func_array("demo::foo",[3,5,6]);
call_user_func("demo::foo",1);
//echo foo();
die;

$str="contract_status:1
order_id:1
order_name:
contract_code:
customer_name:
order_type:
order_submitter:
contract_submitter:
area:
city:
finacial:
is_modification:
refund:
order_start_time:
order_end_time:
start_time:
end_time:
price_start:
price_end:";

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
function a(){

    sleep(2);
    echo 'a';
}
function b(){
    sleep(3);
    echo 'b';
}
a();
b();
echo 'success';die;


//error_log("PHP Notice:Oracle数据库不可用!", 1,'xu.weishuai@xcar.com.cn');
//error_log("搞砸了!",   2,   "localhost:5000");
error_log("搞砸了!",   3,   "D:/WWW/z_test/a.txt");
error_reporting(E_ERROR);
//ini_set();
echo @$foo['bar'];
$a=$foo['bar'];
echo  'cc';
echo $a;

die;




//// We'll be outputting a PDF
//header('Content-type: application/pdf');
//
//// It will be called downloaded.pdf
//header('Content-Disposition: attachment; filename="downloaded.pdf"');
//
//// The PDF source is in original.pdf
//readfile('original.pdf');
//die;
session_start();
echo session_id();
$_SESSION['views']=1;
var_dump($_SESSION);
setcookie('xwsh','new');
setcookie('xwsh2','new3');
//header('content-type:text/html;charset=utf-9');
//header('HTTP/1.1 404 xwsh');
//header('HTTP/1.1 200 200');


//header('Location:http://www.baidu.com/');  //Location和":"之间无空格。
//
//
//header('Refresh: 10; url=http://www.baidu.com/');



echo  md5(base64_encode('65930a380b114a3da964a8f119503adb' . 1));die;
function fibonacci($param) {
      if ($param == 0)
          return 0;
    if ($param<= 2)
          return 1;
    return fibonacci($param - 1) + fibonacci($param - 2);
}

echo  fibonacci(1);
echo  fibonacci(2);
echo  fibonacci(3);
echo  fibonacci(4);
echo  fibonacci(5);die;
// 约瑟夫问题
function king($n,$m){
$monkey=range(1,$n);//模拟建立一个连续数组
$i=0;
while(count($monkey)>15){
$i+=1;//开始查数
$head=array_shift($monkey);//直接一个一个出列最前面的猴子
if($i%$m!=0){
array_push($monkey,$head);//如果没数到m或m的倍数,则把该猴放回尾部去.
}//否则就抛弃掉了
}
return$monkey;
}
//echo'剩余',king(41,3),'号猴子';
var_dump(king(30,9));

die;
//先引用后增加
function _call($call){
    //通过传参获取call_user_func传过来的参数
    echo $call++,'<br/>';
    echo $call++,"<br/>";
	return 22;
}
//上面回调函数没有返回值，所以，这里就没有返回值，_call为上面的函数的名称
$re = call_user_func('_call',1);
//实验结果为 null，符合上面的结论
var_dump($re);
die;
function sum($carry, $item,$c=22)
{
	echo '-------'.'<br>';
	    var_dump($carry);
		var_dump($item);
			echo '-------'.'<br>';
    $carry += $item;
    return $carry;
}

function product($carry, $item)
{
    $carry *= $item;
    return $carry;
}

$a = array(1, 2, 3, 4, 5);
$x = array(1,2);

//var_dump(array_reduce($a, "sum",'xx')); // int(15)
//var_dump(array_reduce($a, "product", 10)); // int(1200), because: 10*1*2*3*4*5
var_dump(array_reduce($x, "sum",'xxxxxxxx')); // string(17) "No data to reduce"

die;
function outer( $msg ) { 
    function inner( $msg ) { 
        echo 'inner: '.$msg.' '; 
    } 
    echo 'outer: '.$msg.' '; 
    inner( $msg ); 
} 
outer('xwsh');
inner('cc');
die;

//function Car($name){
//  return function($statu)use($name){
//    return sprintf("Car %s is %s", $name, $statu);
//  };
//}
//// 将车名封装在闭包中
//$car = Car("bmw");
//// 调用车的动作
//// 输出--> "bmw is running"
//echo '<pre>';
//var_dump($car);
//echo $car("running");

?>

