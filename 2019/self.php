<?php

sizeof();


class A{

    public function get_self(){
        return new self();
    }
    public function get_static(){
        return new static();
    }
}

class B extends A{

}
echo get_class((new A())->get_self());
echo get_class((new A())->get_static());

echo get_class((new B())->get_self());

echo get_class((new B())->get_static());


/*这里我们发现了 getNewFather 返回的是Father的实列，
 而getNewCaller 返回的是调用者的实列

 现在明白了 new self() 和 new static 的区别了

 他们的区别只有在继承中才能体现出来、如果没有任何继承、那么二者没有任何区别

 然后 new self() 返回的实列是不会变的，无论谁去调用，都返回的一个类的实列，
 而 new static则是由调用者决定的*/

/*
self 指的是self所在的类

new static 实例化的是当前使用的类，有点像$this ，从堆内存中提取出来。*/



?>