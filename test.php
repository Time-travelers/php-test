<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/1/2
 * Time: 15:08
 */

echo "<pre>";
echo "\n";



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
