<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/11/7
 * Time: 14:22
 */


//error_log("PHP Notice:Oracle数据库不可用!", 1,'xu.weishuai@xcar.com.cn');
//error_log("搞砸了!",   2,   "localhost:5000");
//error_log("搞砸了!",   3,   "D:/WWW/z_test/a.txt");
//error_reporting(E_ERROR);
//error_reporting(E_ERROR);

//自定义的错误处理方法
function _error_handler($errno, $errstr ,$errfile, $errline)
{
    echo "错误编号errno: $errno<br>";
    echo "错误信息errstr: $errstr<br>";
    echo "出错文件errfile: $errfile<br>";
    echo "出错行号errline: $errline<br>";
}

set_error_handler('_error_handler', E_ALL | E_STRICT);  // 注册错误处理方法来处理所有错误

function _exception_handler(Throwable $e)
{
    if ($e instanceof Error)
    {
        echo "catch Error: " . $e->getCode() . '   ' . $e->getMessage() . '<br>';
    }
    else
    {
        echo "catch Exception: " . $e->getCode() . '   ' . $e->getMessage() . '<br>';
    }
}

set_exception_handler('_exception_handler');    // 注册异常处理方法来捕获异常


try
{
    echo $foo['bar'];  // 由于数组未定义，会产生一个notice级别的错误

    trigger_error('人为触发一个错误', E_USER_ERROR); //人为触发错误

    if (mt_rand(1, 10) > 5)
    {
        throw new Exception('This is a exception', 400);  //抛出一个Exception,看是否可以被catch
    }
    else
    {
        foobar(3, 5);   //调用未定义的方法将会产生一个Error级别的错误
    }
}
catch (Throwable $e)
{
    echo "Error code: " . $e->getCode() . '<br>';
    echo "Error message: " . $e->getMessage() . '<br>';
    echo "Error file: " . $e->getFile() . '<br>';
    echo "Error fileline: " . $e->getLine() . '<br>';
}
die;




echo $foo['bar'];  // 由于数组未定义，会产生一个notice级别的错误

trigger_error('人为触发一个错误', E_USER_ERROR); //人为触发错误

if (mt_rand(1, 10) > 5)
{
    throw new Exception('This is a exception', 400);  //抛出一个Exception,看是否可以被catch
}
else
{
    foobar(3, 5);   //调用未定义的方法将会产生一个Error级别的错误
}


die;


try
{
    echo $foo['bar'];  // 由于数组未定义，会产生一个notice级别的错误

    trigger_error('人为产生触发一个错误', E_USER_ERROR); //人为触发错误

    foobar(3, 5);   //调用未定义的方法将会产生一个Error级别的错误
}
catch (Error $e)
{
    echo "Error code: " . $e->getCode() . '<br>';
    echo "Error message: " . $e->getMessage() . '<br>';
    echo "Error file: " . $e->getFile() . '<br>';
    echo "Error fileline: " . $e->getLine() . '<br>';
}

die;



echo $foo[1];  // 由于数组未定义，会产生一个notice级别的错误

trigger_error("xxx", E_USER_ERROR);

trigger_error('人为触发一个错误', E_USER_ERROR); //人为触发错误

foobar(3, 5);   //调用未定义的方法将会产生一个Error级别的错误
die;

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }

    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
            break;

        case E_USER_NOTICE:
            echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
            break;

        default:
            echo "Unknown error type: [$errno] $errstr<br />\n";
            break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

// function to test the error handling
function scale_by_log($vect, $scale)
{
    if (!is_numeric($scale) || $scale <= 0) {
        trigger_error("log(x) for x <= 0 is undefined, you used: scale = $scale", E_USER_ERROR);
    }

    if (!is_array($vect)) {
        trigger_error("Incorrect input vector, array of values expected", E_USER_WARNING);
        return null;
    }

    $temp = array();
    foreach($vect as $pos => $value) {
        if (!is_numeric($value)) {
            trigger_error("Value at position $pos is not a number, using 0 (zero)", E_USER_NOTICE);
            $value = 0;
        }
        $temp[$pos] = log($scale) * $value;
    }

    return $temp;
}

// set to the user defined error handler
$old_error_handler = set_error_handler("myErrorHandler");

// trigger some errors, first define a mixed array with a non-numeric item
echo "vector a\n";
$a = array(2, 3, "foo", 5.5, 43.3, 21.11);
print_r($a);

// now generate second array
echo "----\nvector b - a notice (b = log(PI) * a)\n";
/* Value at position $pos is not a number, using 0 (zero) */
$b = scale_by_log($a, M_PI);
print_r($b);

// this is trouble, we pass a string instead of an array
echo "----\nvector c - a warning\n";
/* Incorrect input vector, array of values expected */
$c = scale_by_log("not array", 2.3);
var_dump($c); // NULL

// this is a critical error, log of zero or negative number is undefined
echo "----\nvector d - fatal error\n";
/* log(x) for x <= 0 is undefined, you used: scale = $scale" */
$d = scale_by_log($a, -2.5);
var_dump($d); // Never reached
?>