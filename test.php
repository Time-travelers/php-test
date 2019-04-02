<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/1/2
 * Time: 15:08
 */

echo "<pre>";
echo "\n";



print_r( get_declared_classes());
die;

//Tick（时钟周期）是一个在 declare 代码段中解释器每执行 N 条可计时的低级语句就会发生的事件。
//在每个 tick 中出现的事件是由 register_tick_function() 来指定的。
declare(ticks=1);

// A function called on each tick event
function tick_handler()
{
    echo "tick_handler() called\n";
}

register_tick_function('tick_handler');

$a = 1;

if ($a > 0) {
    $a += 2;
    print($a);
}
die;
echo  PHP_SAPI;

// 创建一个有异常处理的函数 try 找不到catche 会报错
//function checkNum($number)
//{
//    if($number>1)
//    {
//        throw new Exception("Value must be 1 or below");
//    }
//    return true;
//}
//
//// 触发异常
//checkNum(2);die;

//PHP 7 改变了大多数错误的报告方式。不同于 PHP 5 的传统错误报告机制，现在大多数错误被作为 Error 异常抛出。
//
//这种 Error 异常可以像普通异常一样被 try / catch 块所捕获。如果没有匹配的 try / catch 块， 则调用异常处理函数
//（由 set_exception_handler() 注册）进行处理。 如果尚未注册异常处理函数，则按照传统方式处理：被报告为一个致命错误（Fatal Error）。
//
//Error 类并不是从 Exception 类 扩展出来的，所以用 catch (Exception $e) { ... } 这样的代码是捕获不 到 Error 的
//你可以用 catch (Error $e) { ... } 这样的代码，或者通过注册异常处理函数（ set_exception_handler()）来捕获 Error

set_exception_handler('appException');
function appException(){
  echo '没有匹配的 try / catch 块， 则调用异常处理函数（由 set_exception_handler() 注册）进行处理';
}
class MathOperations
{
   protected $n = 10;

   // 求余数运算，除数为 0，抛出异常
   public function doOperation()
   {
      try {
          throw new Exception('this is a exception');
         $value = $this->n % 0;
         return $value;
      }catch (Exception $e) {

          return $e->getMessage();
      } catch (Error $e) {

         return $e->getMessage();
      }
   }

}

$mathOperationsObj = new MathOperations();
print($mathOperationsObj->doOperation());
die;


$data =array_rand(range(1,3000),300);
//range创建一个包含从 "0" 到 "5" 之间的元素范围的数组 步长为1   array_rand 取随机的300个
//$data = [11,11, 67, 3, 121, 71, 6, 100, 45, 2, 19, 17, 99, 40, 3, 22];
// 冒泡排序  它重复地走访过要排序的数列，一次比较两个元素，如果他们的顺序错误就把他们交换过来。
function sort1($data){

    $len=count($data);
    for($i=0;$i<$len;$i++){

        for ($j=$i;$j<$len;$j++){
            if($data[$j]>$data[$i]){
                $temp=$data[$j];
                $data[$j]=$data[$i];
                $data[$i]=$temp;
            }
        }

    }
    return $data;
}
//function sort1($data){
//
//    $len=count($data);
//    for($i=0;$i<$len;$i++){
//
//        for ($j=0;$j<$len-1;$j++){
//            if($data[$j]>$data[$j+1]){
//                $temp=$data[$j];
//                $data[$j]=$data[$j+1];
//                $data[$j+1]=$temp;
//            }
//        }
//
//    }
//    return $data;
//}

// 选择排序 每一次从待排序的数据元素中选出最小（或最大）的一个元素，存放在序列的起始位置，直到全部待排序的数据元素排完。
function select($data){
    $temp=0;
    $len=count($data);
    for($i=0;$i<$len;$i++){
        $miniVal=$data[$i];//假设$i就是最小值
        $minValIndex=$i;
        //找最小值
        for($j=$i+1;$j<$len;$j++){
            if($miniVal>$data[$j]){
                $miniVal=$data[$j];
                $minValIndex = $j;
            }

        }
//       存放在序列的起始位置
        $temp=$data[$i];
        $data[$i]=$miniVal;
        $data[$minValIndex]=$temp;

    }
    return $data;

}
//快速排序 通过一趟排序将要排序的数据分割成独立的两部分，其中一部分的所有数据都比另外一部分的所有数据都要小，
//* 然后再按此方法对这两部分数据分别进行快速排序，整个排序过程可以递归进行，以此达到整个数据变成有序序列。
function quickSort($data){
    if(!isset($data[1])){
        return $data;
    }
    $temp=$data[0];
    $leftArray=[];
    $reghtArray=[];
    $in=[];
    foreach ($data as $k=>$v){
        if($v<$temp){
            $leftArray[]=$v;
        }
        if($v>$temp){
            $reghtArray[]=$v;
        }
        if($v==$temp){
            $in[]=$v;
        }
    }
    $leftArray=quickSort($leftArray);
//    $leftArray[]=$temp;
    foreach ($in as $v){
        $leftArray[]=$v;
    }

    $reghtArray=quickSort($reghtArray);
    return array_merge($leftArray,$reghtArray);

}
//print_r(select($data));
print_r(quickSort($data));
die;
$t1=microtime(true);
$data1=sort1($data);
$t2=microtime(true);
sort($data);
$t3=microtime(true);
print_r($data1);
print_r($data);
echo $t1.'<br>';
echo $t2.'<br>';
echo $t3.'<br>';
echo $t2-$t1.'<br>';
echo $t3-$t2.'<br>';
die;

//parse_url 解析url到数组
var_dump(parse_url('http://www.aa.com/hello/test.php.html?a=3&b=4'));

echo 'aa','bb';
die;
//require_once  include_once 检查并只导入一次
include 'index1.php'; //报错 继续执行

require 'index1.php';// 报错 程序终止
echo strtotime('-1 day');die;
echo strtotime('-1 year');die; //转时间戳

die;



echo date('Y-m'); //默认当时时间



echo 'xxx';
print 'xxx';// 输出字符串
print_r([]); //递归打印数组对象
var_dump([]);// 打印信息

// 汉字反转
function str_rev_gb($str){
    //判断输入的是不是utf8类型的字符，否则退出
    if(!is_string($str)||!mb_check_encoding($str,'UTF-8')){
        exit("输入类型不是UTF8类型的字符串");
    }
    $array=array();
    //将字符串存入数组
    $l=mb_strlen($str,'UTF-8');//在mb_strlen计算时，选定内码为UTF8，则会将一个中文字符当作长度1来计算
    for($i=0;$i<$l;$i++){
        $array[]=mb_substr($str,$i,1,'UTF-8');
    }
    //反转字符串
    krsort($array);
    //拼接字符串
    $string=implode($array);
    return $string;
}
echo str_rev_gb('大家好');
// 英文字符串反转 同php函数strrev
function strrevnew($str)
{
    $len=strlen($str);
    $newstr = '';
    for($i=$len-1;$i>=0;$i--)
    {
        $newstr .= $str{$i};
    }
    return $newstr;
}
echo strrevnew('xwsh');
//self static 关键字区别
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
//        self::who();//输出A
        static::who();//输出B
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test();//输出A
die;

// 抽象类静态方法调用
abstract class abb{

    public  static $name='xwsh';
    public  static function getName(){
        echo self::$name;
    }
}
abb::getName();
echo abb::$name;
die;

//匿名函数
$name=11;
$name=function ($a,$b) use($name){
    echo $name;
};
var_dump($name);
die;

// compact 建立一个数组包含变量名和他们的值  和extract 相反 可递归调用

$a=111;
$b=222;
$c=333;
var_dump(compact('ba==','b','a',['c','e']));

//和extract 相反 将数组拆成变量名为key值为value 写入当前的符号表。 可递归调用
extract(['cc'=>2,3,4]);
echo $cc;
die;
$bet_sp = 2.05;
// 浮点数精度问题。 机器的小数精度有限，存放不了这么多位数，必须进行四舍五入
echo floor($bet_sp*100)/100;
die;


// 两个字符串比较 依次比较字符
$a = 'b';

$b = 'a';

echo ord($a);
echo ord($b);
var_dump(strcmp($b,$a));

var_dump($a<$b);


die;

//字符串强制转换浮点型或者整型，会从左边逐一检查字符串，遇到不合格的字符出现就停止。
$str ='haodaquan';
//隐式转换
// 算术运算符的两个操作数都会被转换为数值类型。
//字符串连接符的两个操作数都会被转换为字符串类型。
//0=='aa',  比较时 aa 转化成数值型0   字符串转成数值取第一个数值型
//2、“==” 做比较，如果比较一方是布尔型，则另一方转为布尔型再比较值。
echo ($str == 0) ? 1 : 0;

die;

//获取php变量内存地址 函数

$c=12.35;
//这种方式并没有改变变量的数据类型，而只是改变了表达式的数据类型。
$a=intval($c);
var_dump($c);
//可见，变量的类型和值都被修改了
$b=settype($c,'string');


var_dump($a);
var_dump($b);
var_dump($c);
echo gettype($a);
echo $a;

die;

echo abs(floor((0.1+0.7)*10));

die;
echo 1e-1;
echo 22E1; //E 科学计数法 表示10的n次方
die;

echo floor((0.1+0.7)*10);

die;
$name='abc';//{} 取出第n个字节
echo $name{1};
die;
//echo $s=ord('许');
//echo chr($s);
//die;
//使用chr()函数和ord()函数进行字符串与ASCII码之间的转换，程序代码如下：
//该函数用于将ASCII码值转化为字符串。其函数声明如下：
$str1=chr(88);
echo $str1;               //返回值为X
echo "\n";
//该函数用于将字符串转化为ASCII码值。其函数声明如下：
$str2=ord('S');
echo $str2;               //返回值为83
echo "\n";


//php gettype 获取变量类型
$a=new Redis();
echo gettype($a);

// 字符和数字值相等

var_dump(1=='1');

// 浮点数的精度，有限小数位
echo 1/3;
die;

// 填充一個數組
$temp=array_pad([1,2,3],20,20);

//var_dump($temp);

function add($a,$b){
    return $a+$b;

}
$arr=[1,2,3];
//$arr=[];
$tt=array_reduce($arr,'add','is null');
var_dump($tt);

$arr=array_reverse($arr);
$arr_flip=array_flip($arr);
var_dump($arr);
var_dump($arr_flip);
