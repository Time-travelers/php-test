<?php

interface Middleware
{
    public static function handle(Closure $next);
}
 
class VerifyCsrfToken implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "验证csrf-token.......";
        $next();
    }
}
 
class ShareErrorsFromSession implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "如果session中有errors变量，共享他....";
        $next();
    }
}
 
class StartSession implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "开启session,获取数据....";
        $next();
        echo "保存数据，关闭session..";
 
    }
}
 
class AddQueuedCookiesToResponse implements Middleware
{
    public static function handle(Closure $next)
    {
        $next();
        echo "添加下一次请求需要的cookie...";
    }
}
 
class EncryptCookies implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "对输入请求的cookie进行解密...";
        $next();
        echo "对输出响应的cookie进行加密...";
    }
}
 
class CheckForMaintenanceMode implements Middleware
{
    public static function handle(Closure $next)
    {
        echo "确定当前程序是否处于维护状态...";
        $next();
    }
}
 
function getSlice()
{
    return function ($stack, $pipe) {
        return function () use ($stack, $pipe) {
            return $pipe::handle($stack);
        };
 
    };
}
 
function then()
{
    $pipes= [
        "CheckForMaintenanceMode",
        "EncryptCookies",
        "AddQueuedCookiesToResponse",
        "StartSession",
        "ShareErrorsFromSession",
        "VerifyCsrfToken"
    ];
    $firstSlice = function () {
        echo "请求向路由器传递，返回响应....";
    };
    $pipes = array_reverse($pipes);
	echo '<pre>';
	print_r(array_reduce($pipes, getSlice(), $firstSlice));die;
    call_user_func(
        //这里如果写成'getSlice'，需要将上面的getSlice()函数更改为跟pipeline_simplify.php中的那种套路
        array_reduce($pipes, getSlice(), $firstSlice)
    );
}
 
then();
die;
$a1= intval(2000*300*400*500);
var_dump($a1);
$c=$a1;
var_dump($c);
// "pay_dsc": "投放后玖拾（90 ）天内向甲方履行支付义务，乙方在甲方结算前开具发票。"
$a['pay_dsc']="投放后玖拾（90 ）天内向甲方履行支付义务，乙方在甲方结算前开具发票。";
echo json_encode($a);

die;
/*
$sum=0;
$s= microtime(true);
for($i=0;$i<1000000000;$i++){
    $sum+=$i;
}
*/
$e= microtime(true);
echo $sum."<br>";
echo $e-$s;die;

interface IReader{
    public function getContent();
}

class Book implements IReader {
    public function getContent(){
        return "很久很久以前有一个阿拉伯的故事……\n";
    }
}

class Newspaper implements IReader {
    public function getContent(){
        return "林书豪17+9助尼克斯击败老鹰……\n";
    }
}

class Mother{
    public function narrate(IReader $book){
        echo "妈妈开始讲故事\n";
        echo $book->getContent();
    }
}

class Client{
    public static function main(){
        $mother = new Mother();
        $mother->narrate(new Book());
        $mother->narrate(new Newspaper());
    }
}

$client = new Client();
$client->main();


class test{
 public $public;
 private $private;
 protected $protected;
 static $instance;
 public  function __construct(){
	 $this->public    = 'public     <br>';
	 $this->private   = 'private    <br>';
	 $this->protected = 'protected  <br>';
 }
 static function tank(){
	 if (!isset(self::$instance[get_class()]))
	 {
		 $c = get_class();
		 self::$instance = new $c;
	 }

	 return self::$instance;
 }    

 public function pub_function() {
	 echo "you request public function<br>";
	 echo $this->public;
	 echo $this->private;        //private,内部可以调用
	 echo $this->protected;      //protected,内部可以调用
	 $this->pri_function();      //private方法，内部可以调用
	 $this->pro_function();      //protected方法，内部可以调用
 }
 protected  function pro_function(){
	echo "you request protected function<br>";
 }
 private function pri_function(){
	echo "you request private function<br>";
 }
}

$test = test::tank();
echo $test->public;
//echo $test->private;    //Fatal error: Cannot access private property test::$private
//echo $test->protected;  //Fatal error: Cannot access protected property test::$protected
$test->pub_function();
//$test->pro_function();  //Fatal error: Call to protected method test::pro_function() from context
//$test->pri_function();  //Fatal error: Call to private method test::pri_function() from context
die;
?>

<?php
echo '<pre>';
function dump($A){
	echo '<pre>';
	var_dump($A);
	
}

//class Person {
//
//  public $name;
//
//  public function __construct($name)
//  {
//    $this->name = $name;
//  }
//
//  public function getName()
//  {
//    return $this->name;
//  }
//
//  public function setName($vm,$c)
//  {
//    $this->name = $vm;
//  }
//  protected function name(){
//	 echo $this->name;
//  }
//}
//$t=new Person('xwsh');
// die;

  
$p = new ReflectionParameter(array('Person', 'setName'),1);
  
print_r($p->getPosition()); //0
print_r($p->getName()); //v
die;
$rf = new ReflectionFunction('dump');
  
foreach($rf->getParameters() as $item) {
  echo $item . PHP_EOL;
}

die;
$re = new ReflectionExtension('Reflection');
print_r($re->getClasses()); //扩展的所有类
print_r($re->getClassNames()); //扩展所有类名

$dom = new ReflectionExtension('mysql');
print_r($dom->getConstants());//扩展常量
print_r($dom->getDependencies());//该扩展依赖
print_r($dom->getFunctions());//扩展方法
print_r($dom->getINIEntries());//扩展ini信息
print_r($dom->getName());//扩展名称
print_r($dom->getVersion());//扩展版本
print_r($dom->info());//扩展信息
print_r($dom->isPersistent());//是否是持久扩展
print_r($dom->isTemporary()); //是否是临时扩展
die;
class Person {
    public $name;
    private $age;
    private $sex;
    public static $information = "I come from the earth";
    public function __construct($name="zhangsan", $age=23, $sex="male") {
        $this->sex = $sex;
        $this->age = $age;
        $this->name = $name;
    }
    public function __sleep() {
        // TODO: Implement __sleep() method
        return array("name","age");    //该方法指定仅序列化对象的name和age属性
    }
    public function __wakeup() {
        // TODO: Implement __wakeup() method.
        var_dump($this->name);         //打印输出对象的name属性的值
        var_dump($this->sex);          //打印输出对象的sex属性的值，由于sex没有被序列化，因此输出null
    }
    public function __destruct() {
        // TODO: Implement __destruct() method.
        echo "The object will be destructed";
    }
    public function __get($field) {
        // TODO: Implement __get() method.
        echo "the get method is executed<br>";
        return $this->$field;
    }
    public function __set($key, $value) {
        // TODO: Implement __set() method.
        echo "The set method is executed<br>";
        $this->$key = $value;
    }
    public function __call($name, $arguments) {
        // TODO: Implement __call() method.
        echo "被调用方法的名称为：$name<br>";
        echo "传入该方法的参数为：", var_dump($arguments),"<br>";
    }
    public static function __callStatic($name, $arguments) {
        // TODO: Implement __callStatic() method.
        echo "被调用方法的名称为：$name<br>";
        echo "传入该方法的参数为：", var_dump($arguments),"<br>";
    }
    public function __toString() {
        // TODO: Implement __toString() method.
        return "My name is $this->name.<br> I am $this->age years old and I am a $this->sex.";
    }
    public function sayHello($other){
        echo "My name is $this->name, nice to meet you $other";
    }
}

$person = new Person();
echo '<pre>';
ReflectionClass::export('Person');


$reflect = new ReflectionObject($person);
var_dump($reflect);

$reflect = new ReflectionClass('Person');
var_dump($reflect);
$reflect = new ReflectionClass($person);
var_dump($reflect);
//$reflect->export('name');
die;
$props = $reflect->getProperties();   //获取对象的属性列表（所有属性）
echo '<pre>';
foreach ($props as $prop){    //打印类中属性列表
    echo $prop->getName(),"\r";
}
echo "<br>";
$methods = $reflect->getMethods();   //获取类的方法列表
foreach ($methods as $method){
    echo $method->getName(),"\r";
}
echo "<br>";
//返回对象属性的关联数组
var_dump(get_object_vars($person)); echo "<br>";
//返回类的公有属性的关联数组
var_dump(get_class_vars(get_class($person))); echo "<br>";
//获取类的方法名组成的数组
var_dump(get_class_methods(get_class($person)));

/*输出结果如下：
name age sex information
__construct __sleep __wakeup __destruct __get __set __call __callStatic __toString sayHello
array(1) { ["name"]=> string(8) "zhangsan" }
array(2) { ["name"]=> NULL ["information"]=> string(21) "I come from the earth" }
array(10) { [0]=> string(11) "__construct" [1]=> string(7) "__sleep" [2]=> string(8) "__wakeup" [3]=> string(10) "__destruct" [4]=> string(5) "__get" [5]=> string(5) "__set" [6]=> string(6) "__call" [7]=> string(12) "__callStatic" [8]=> string(10) "__toString" [9]=> string(8) "sayHello" }
*/

//PHP中的反射应用
die;
function print_method($obj) {
	$refObj = new ReflectionObject($obj);
        echo '<pre>';
        $refObj::export();
	foreach($refObj->getMethods() as $refFun) {
               
		echo "Define class name : ", $refFun->getDeclaringClass()->getName(), "\n";
		echo "Modifiers for method ", $refFun->name,":\n";
		echo $refFun->getModifiers() . "\n";
		echo implode(' ', Reflection::getModifierNames($refFun->getModifiers())) . "\n";
	}
} 

class pa{
    private function m(){
        echo 'Parent\'s function';
    }
    public function run(){
        print_method($this);
		// 从上面的输出可以看到，$this = $obj，
		// 这里隐含一个输出，为什么会隐藏，这就是继承的关系，我们知道public和protected会被子类同名给覆盖
		// 但是private又会被保护，不能覆盖，那么其实就是有2份m，一个private m，另外一个就是子类 public m
		$this->m();
		// 而这里的m调用时，会找那个m调用呢？
		// 很简单，就是优先找当前method所定义class处的private，因为有了private就不用考虑继承覆盖的问题
		
    }
	
}
class child extends pa{
    public function m(){
        echo 'child\'s function';
    }
}
$obj=new child();

print_method($obj);
die;
echo '______________________________';

$obj->run();

die;


//
//class pa{
//    private function m(){
//        echo 'Parent\'s function';
//    }
//}
//class child extends pa{
//    public function run(){
//        if(is_callable($this, 'm')) {
//			echo 'private function can callable';
//		} else {
//			echo 'private function can not callable';
//		}
//    }
//}
//$obj=new child();
//
//if(method_exists($obj, 'm')) {
//	echo 'private function can extends';
//} else {
//	echo 'private function can not extends';
//}
//
//$obj->run();die;
//
//class pa{
//    private function m(){
//        echo 'Parent\'s function';
//    }
//    public function run(){
//        $this->m();
//    }
//}
//class child extends pa{
//    public function m(){
//        echo 'child\'s function';
//    }
//}
//$obj=new child();
//$obj->run();
//$obj->m();
//die;
class Fu{  
    public $num=1;
    public  function show(){ 
       echo $this->num;
    }
    public function tell(){
	echo 'dd';
   }
}  
  
class Zi extends Fu {  
    public $num=3;  
}  
$tem=new Zi();
$tem->show();

die;
class A2 {

    public $base = 100;

}

class BV {

    private $base = 1000;
}

$f = function () {
    return $this->base + 3;
};


$a = Closure::bind($f, new A);
print_r($a());

echo PHP_EOL;

$b = Closure::bind($f, new BV , 'BV');
print_r($b());

echo PHP_EOL;

echo PHP_VERSION;
die;


abstract class DomainObject{
public static function create(){
return new static();//延迟静态绑定
}
}
class User extends DomainObject{}
class Document extends DomainObject{}
var_dump(Document::create());

die;


$a=1;
$b=$a;
$a=2;
echo $b;die;
header("content-type:text/html;charset=utf-8");
class Human{
 static public $name = "小妹";
 public $height;
 public function tell(){
	echo 'dd';
 }
 static public function tell_name(){
    echo 'cc';
 }

}
echo Human::$name;
//不依赖于对象，就能直接访问。因为静态属性的内存位置是在类里，而不是对象。
$p1 = new Human();
$p2 = new Human();
echo '<pre>';
var_dump($p1);
 $p1::$name = "夫人";
$p1::$name = "小姐";
//在$p1对象上改变静态属性的值，那$p2对象也会相应的改变。
echo $p2::$name;
echo $p2->tell();
echo Human::$name;
echo Human::tell_name();
die;
?>

<?php

$a=[1,3,4,['dd','cc']];
echo '<pre>';
print_r($a);
echo '<pre>';
var_export($a);
var_export($a,true);
echo '<pre>';
var_dump($a);
var_dump($a,true);
die;
class Mytest{
    function ccc($str){
        echo $str;
    }
}
//Mytest::ccc("123456");
$object = new Mytest();
$object->ccc("123456");

die;
$str='xwshxwsh';
echo $str[0];
echo $str[1];



die;

class A1{
	public $a=1;
	function e(){
	   echo $this->a;
	}
}
$a=new A1();
$c=new A1();

$b=$a;
var_dump($b);
var_dump($c);
$a->a=2;
var_dump($b);die;


$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$a2=array("e"=>"red","f"=>"green","g"=>"blue");

$result=array_diff($a2,$a1);
print_r($result);
die;
?>
<?php

class A {
  public static function get_self() {
    return new self();
  }

  public static function get_static() {
    return new static();
  }
}

class B extends A {

}

echo get_class(B::get_self()); // A
echo get_class(B::get_static()); // B
echo get_class(A::get_static()); // A

die;
function getfirstchar($s0){
$firstchar_ord=ord(strtoupper($s0{0}));
if (($firstchar_ord>=65 and $firstchar_ord<=91)or($firstchar_ord>=48 and $firstchar_ord<=57)) return $s0{0};
$s=iconv("UTF-8","gb2312", $s0);

$asc=ord($s{0})*256+ord($s{1})-65536;
if($asc>=-20319 and $asc<=-20284)return "A";
if($asc>=-20283 and $asc<=-19776)return "B";
if($asc>=-19775 and $asc<=-19219)return "C";
if($asc>=-19218 and $asc<=-18711)return "D";
if($asc>=-18710 and $asc<=-18527)return "E";
if($asc>=-18526 and $asc<=-18240)return "F";
if($asc>=-18239 and $asc<=-17923)return "G";
if($asc>=-17922 and $asc<=-17418)return "H";
if($asc>=-17417 and $asc<=-16475)return "J";
if($asc>=-16474 and $asc<=-16213)return "K";
if($asc>=-16212 and $asc<=-15641)return "L";
if($asc>=-15640 and $asc<=-15166)return "M";
if($asc>=-15165 and $asc<=-14923)return "N";
if($asc>=-14922 and $asc<=-14915)return "O";
if($asc>=-14914 and $asc<=-14631)return "P";
if($asc>=-14630 and $asc<=-14150)return "Q";
if($asc>=-14149 and $asc<=-14091)return "R";
if($asc>=-14090 and $asc<=-13319)return "S";
if($asc>=-13318 and $asc<=-12839)return "T";
if($asc>=-12838 and $asc<=-12557)return "W";
if($asc>=-12556 and $asc<=-11848)return "X";
if($asc>=-11847 and $asc<=-11056)return "Y";
if($asc>=-11055 and $asc<=-10247)return "Z";
return null;
}
echo getfirstchar("哈哈"); die;

$test=array( 2834=>"149223",
  2218 =>"136721",
  3295 =>"37675",
  3265 => "30569");
print_r(array_keys($test,"30569",true));//严格匹配模式 

die;
echo strstr('1,2','1'
)?'checked="checked"':'';die;
$msg=token_get_all('<?php ehco "hello world"; $a=1+1; echo $a;?>');
print_r($msg);die;




$a=1;
$b=$a;
echo $b;
echo (++$a)+(++$b);
die;
$temp=array(12027,12028,12032,12033,12035,12039,12041,12043,12053,12054,18210,18195,15467,15784,15793,15798,16839,16899,17068,17701,18203,18328,18329,18443,18446,18449,18477,19280,19281,19258,19259,19266,19267,19244,20030,20031,20258,20359,20820,20976,20980,20984,21012,21068,21074,21092,21097,21472,21518,21520,21522,21524,21874,22152,22159,22177,22180,22185,26098,22269,22345,22770,22797,22837,22842,22855,22890,22895,23036,23038,23043,23045,23739,23182,23183,23185,23186,23188,23189,23191,23192,23194,23195,23197,23198,23200,23201,23203,23204,23206,23207,23209,23210,23212,23213,23215,23216,23218,23219,23221,23222,23224,23225,23227,23228,23230,23231,23233,23234,23236,23237,23239,23240,23242,23243,23245,23246,23248,23249,23251,23252,23254,23255,23260,23261,23263,23264,23266,23267,23269,23270,23272,23273,23275,23276,23278,23279,23281,23282,23284,23285,23287,23288,23290,23291,23293,23294,23296,23297,23299,23300,23304,23305,23307,23308,23310,23311,23313,23314,23316,23317,23319,23320,23322,23323,23325,23326,23328,23329,23331,23332,23336,23337,23339,23340,23342,23343,23345,23346,23348,23349,23351,23352,23354,23355,23357,23358,23360,23361,23363,23364,23366,23367,23369,23370,23372,23373,23377,23378,23380,23381,23383,23384,23386,23387,23389,23390,23392,23393,23395,23396,23398,23399,23401,23402,23404,23405,23407,23408,23410,23411,23413,23414,23416,23417,23421,23422,23424,23425,23431,23432,23434,23435,23437,23438,23440,23441,23443,23444,23446,23447,23449,23450,23452,23453,23458,23459,23461,23462,23464,23465,23467,23468,23470,23471,23473,23474,23476,23477,23479,23480,23482,23483,23485,23486,23488,23489,23491,23492,23494,23495,23497,23498,23500,23501,23503,23504,23508,23509,23511,23512,23514,23515,23517,23518,23520,23521,23523,23524,23526,23527,23529,23530,23532,23533,23535,23536,23538,23539,23541,23542,23544,23545,23547,23548,23550,23551,23553,23554,23556,23557,23559,23560,23562,23563,23565,23566,23568,23569,23571,23572,23574,23575,23577,23578,23580,23581,23583,23584,23586,23587,23589,23590,23592,23593,23595,23596,23600,23601,23603,23604,23606,23607,23609,23610,23612,23613,23615,23616,23618,23619,23621,23622,23624,23625,23627,23628,23630,23631,23633,23634,23636,23637,23639,23640,23642,23643,23645,23646,23648,23649,23651,23652,23654,23655,23657,23658,23660,23661,23663,23664,23666,23667,23669,23670,23672,23673,23675,23676,23678,23679,23681,23682,23684,23685,23687,23688,23690,23691,23693,23694,23696,23697,23699,23700,23702,23703,23705,23706,23708,23709,23711,23712,23714,23715,23717,23718,23728,23729,23736,23737,23740,23742,23743,23745,23746,24511,24515,24523,24562,24587,24864,25144,25147,25150,25153,25158,25203,25204,25271,25363,25431,25474,26385,25566,25572,25650,25578,25579,25583,25584,25609,25658,25663,25665,25667,25669,25671,25673,25679,25681,25683,25729,25732,25742,25745,25862,25894,25897,25903,25905,25909,25911,25915,25917,25919,25925,25931,25963,25965,25967,25969,25971,25973,25975,25981,25985,26056,26130);

foreach($temp  as $k=>$v){

	echo 'f_'.$v.' f_'.$v.'_p ';
}
die;
     $prevData = array(1,2);    
                        echo array_sum(array_values($prevData));
echo  mt_rand() /  mt_getrandmax()/mt_rand(10,60);echo '<br>';
echo mt_rand(1,6);echo '<br>';
echo  mt_rand() /  mt_getrandmax();die;
 ?>



<?php
$im = imagegrabscreen();
 header('Content-Type: image/png');
imagepng($im,“myscreenshot.png”);
die;
?>
<?php
echo  strlen('你好');die;

        $mLock          = 'mfk';		    //锁key
	$mPVAll         = 'mfv';			//PV量
	$mEcho          = 'mfe';			//最大输出量
	
	$mQuantity      = 'mfq';	        //昨天当前时段平均秒量
	$mTime          = 'mft';    	    //flowData刷新memcache时间
	$mId            = 'mfid';       	//ID集
	
	$mPrefix        = 'f_';				//memcache前缀
	$mPv            = '_p';				//memcache_pv
	$mTwo           = '_t';				//二跳

        $memcacheConfig   = array();
//	$memcacheConfig[] = array('host'=>'127.0.0.1', 'port'=>'11211');
	$memcacheConfig[] = array('host'=>'10.15.201.139', 'port'=>'10001');
	$memcacheConfig[] = array('host'=>'10.15.201.148', 'port'=>'10001');
	
	$memcache = new Memcache();
	foreach($memcacheConfig as $mConfig){
		$memcache->addServer($mConfig['host'], $mConfig['port']);
	}
	
	$pv='f_10913_p';
	$pv='f_10913';
	$pv='mfid';
	$time = $memcache->get($pv);	
        echo '<pre>';
        var_dump($time);
        die;
$memcache = new Memcache;
$memcache->connect('127.0.0.1',11211) or die('shit');
 
$memcache->set('key','hello memcache!');
 
$out = $memcache->get('key');
 
echo $out;

?>
<?php
echo '<pre>';
var_dump(unserialize('a:79:{i:0;s:5:"10001";i:1;s:5:"10002";i:2;s:5:"10003";i:3;s:5:"10004";i:4;s:5:"10006";i:5;s:5:"10007";i:6;s:5:"10008";i:7;s:5:"10009";i:8;s:5:"10010";i:9;s:5:"10011";i:10;s:5:"10012";i:11;s:5:"10013";i:12;s:5:"10014";i:13;s:5:"10015";i:14;s:5:"10016";i:15;s:5:"10017";i:16;s:5:"10018";i:17;s:5:"10019";i:18;s:5:"10020";i:19;s:5:"10021";i:20;s:5:"10023";i:21;s:5:"10024";i:22;s:5:"10025";i:23;s:5:"10026";i:24;s:5:"10080";i:25;s:4:"5000";i:26;s:4:"5001";i:27;s:4:"5002";i:28;s:4:"5003";i:29;s:4:"5004";i:30;s:4:"5005";i:31;s:4:"5006";i:32;s:4:"5007";i:33;s:4:"5008";i:34;s:4:"5009";i:35;s:4:"5010";i:36;s:4:"5011";i:37;s:4:"5012";i:38;s:4:"5013";i:39;s:4:"5014";i:40;s:4:"5015";i:41;s:4:"5016";i:42;s:4:"5017";i:43;s:4:"5018";i:44;s:4:"5019";i:45;s:4:"5020";i:46;s:4:"5021";i:47;s:4:"5022";i:48;s:4:"5023";i:49;s:4:"5024";i:50;s:4:"5025";i:51;s:4:"5026";i:52;s:4:"5027";i:53;s:4:"5028";i:54;s:4:"5029";i:55;s:4:"5030";i:56;s:4:"5031";i:57;s:4:"5032";i:58;s:4:"5033";i:59;s:4:"5034";i:60;s:4:"5035";i:61;s:3:"186";i:62;s:3:"189";i:63;s:3:"190";i:64;s:3:"193";i:65;s:3:"194";i:66;s:3:"199";i:67;s:3:"404";i:68;s:4:"1100";i:69;s:4:"1340";i:70;s:4:"1608";i:71;s:4:"2983";i:72;s:4:"3030";i:73;s:4:"1309";i:74;s:4:"1613";i:75;s:4:"2289";i:76;s:4:"2408";i:77;s:4:"2596";i:78;s:4:"2745";}'));die;
$arr=array(
    0=>'moon',
    1=>'sun',
    2=>'earth',
    );
// 定义数组。
echo '<pre>';
//打印数组方法一 函数。;
var_dump($arr);
//打印数组方法二 遍历输出。
foreach ($arr as $key => $value) {
    echo '键为：'.$key.';值为：'.$value,';<br>';
}
die;


   
function video_info($file,$ffmpeg) {
    ob_start();
    passthru(sprintf($ffmpeg.' -i "%s" 2>&1', $file));
    $info = ob_get_contents();
    ob_end_clean();
  // 通过使用输出缓冲，获取到ffmpeg所有输出的内容。
   $ret = array();
    // Duration: 01:24:12.73, start: 0.000000, bitrate: 456 kb/s
    if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
        $ret['duration'] = $match[1]; // 提取出播放时间
        $da = explode(':', $match[1]); 
        $ret['seconds'] = $da[0] * 3600 + $da[1] * 60 + $da[2]; // 转换为秒
        $ret['start'] = $match[2]; // 开始时间
        $ret['bitrate'] = $match[3]; // bitrate 码率 单位 kb
    }

    // Stream #0.1: Video: rv40, yuv420p, 512x384, 355 kb/s, 12.05 fps, 12 tbr, 1k tbn, 12 tbc
    if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $info, $match)) {
        $ret['vcodec'] = $match[1]; // 编码格式
        $ret['vformat'] = $match[2]; // 视频格式 
        $ret['resolution'] = $match[3]; // 分辨率
        $a = explode('x', $match[3]);
        $ret['width'] = $a[0];
        $ret['height'] = $a[1];
    }

    // Stream #0.0: Audio: cook, 44100 Hz, stereo, s16, 96 kb/s
    if (preg_match("/Audio: (\w*), (\d*) Hz/", $info, $match)) {
        $ret['acodec'] = $match[1];       // 音频编码
        $ret['asamplerate'] = $match[2];  // 音频采样频率
    }

    if (isset($ret['seconds']) && isset($ret['start'])) {
        $ret['play_time'] = $ret['seconds'] + $ret['start']; // 实际播放时间
    }

    $ret['size'] = filesize($file); // 文件大小
    return $ret;
}

// 调用方法：
 print_r( video_info('output.mp4','ffmpeg.exe'));
  ?>




            <?php

            echo filesize('D:\WWW\ssp\uploads\2016-08-18\a.png');
            die;
            $name = '测试';
//        我是注释。不解析。给变量name 赋值。
            echo '这是一个' . $name . '<br>';
//       echo 输出语法。“ . ” 连接两个字符串。<br> 换行符。
            var_dump($name);
//        var_dump (); 打印变量name 的值和类型
            die;
//        die;语法。 程序结束。

            $filename = "./test.zip"; //最终生成的文件名（含路径）   
            $attachfile = "./phpinfo.php";
            if (!file_exists($filename)) {
//重新生成文件   
                $zip = new ZipArchive(); //使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释   
                if ($zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE) {
                    exit('无法打开文件，或者文件创建失败');
                }
                $zip->addFile($attachfile, basename($attachfile));
                $zip->close(); //关闭   
            }
            if (!file_exists($filename)) {
                exit("无法找到文件"); //即使创建，仍有可能失败。。。。   
            }

            die;

            $file = $_SERVER['DOCUMENT_ROOT'] . '/a.html';
            header("Content-type:text/html"); //""text/html" 
            header("Content-Disposition: attachment; filename=a.html");
//                $fp=  fopen($file,'r+');
//               while(!feof($fp)){
//                $data=fread($fp,1024);
//                echo $data;
//                }
//               fclose($fp);
            ob_clean();
            readfile($file);
            die;
            ?>