<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2018/12/5
 * Time: 13:07
 */

/* 声明一个简单的容器类 */
class Container{
    private $_diList = array();
   /* 核心方法之一，用于绑定服务
    * @param string $className 类名称
    * @param mixed $concrete 依赖在容器中的存储方式，可以是类名字符串，数组，一个实例化对象，或者是一个匿名函数
    */
    public function set($className,$concrete){
        $this->_diList[$className]=$concrete;
    }


    /*
    * 核心方法之二，用于获取服务对象
    * @param string $className 将要获取的依赖的名称
    * @return object 返回一个依赖的实例化对象
    */
    public function get($className){

        if(isset($this->_diList[$className])){
            return $this->_diList[$className]();
        }
        return null;
    }
}
/* 数据库连接类 */
class Connection{
        public function __construct($dbParams){
            // connect the database...
        }
        public function someDbTask(){
            echo 'someDbTask';
        }
}
/* 会话控制类 */
class Session{
    public function openSession(){
//        session_start();
        echo 'session_start';
    }
    // code...
}

$container = new Container();
// 使用容器注册数据库连接服务
$container->set('db', function(){
    return new Connection(array(
        "host" => "localhost",
        "username" => "root",
        "password" => "root",
        "dbname" => "dbname"
    ));
});
// 使用容器注册会话控制服务
$container->set('session', function(){
    return new Session();
});
// 获取之前注册到容器中的服务，并进行业务的处理


$container->get('db')->someDbTask();
$container->get('session')->openSession();