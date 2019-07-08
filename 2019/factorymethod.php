<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/3
 * Time: 15:38
 */




interface pro{

    function add($a,$b);
    function jian($a,$b);

}
interface factorymethod{
    function getPro($a,$b);
}
class product1 implements pro {



    public function add($a, $b)
    {

        return 1;
    }
    public function jian($a, $b)
    {

        return 2;
    }
}
class product2 implements pro {



    public function add($a, $b)
    {

        return 1;
    }
    public function jian($a, $b)
    {

        return 2;
    }
}
class factorymethod1 implements factorymethod{

    public $pro;

    public function __construct($product1)
    {
        $this->pro=new $product1();
    }
    public function getPro($a,$b)
    {
       return $this->pro->add($a,$b);
        // TODO: Implement getPro() method.
    }
}


$fac=new factorymethod1('product1');
echo $fac->getPro(2,4);

//class factorymethod1 implements factorymethod{
//
//    public $pro;
//
//    public function __construct(pro $pro)
//    {
//        $this->pro=$pro;
//    }
//    public function getPro($a,$b)
//    {
//        return $this->pro->add($a,$b);
//        // TODO: Implement getPro() method.
//    }
//}
//
//$product=new product1();
//$fac=new factorymethod1($product);
//echo $fac->getPro(2,4);


?>