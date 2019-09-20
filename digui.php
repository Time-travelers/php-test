<?php

 class math{
 
  //ceshi 
    public function test() {
        //$.post("/js/logind_index.php?mark=logininto&time="+times,{username:username,pwd:pwd,state:jzmm},function(data,result){
        header("Content-Type: text/html; charset=utf8");
        $date = array(
            'truename' => 'Truename',
            'mobile' => 15933574256,
            'email' => 'Truename@123.com',
        );
        echo 'aa';
        $url = 'http://www.linewow.com/contact_mail.php';
        $_SERVER['HTTP_REFERER'] = 'http://www.linewow.com/reg.php';


        $tmparray = explode('linewow', $_SERVER['HTTP_REFERER']);
        if (count($tmparray) == 1) {
            echo '非法注册。';
            return false;
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch); //返回状态0为添加失败1为添加成功2为手机已存在3为邮箱已存在
        curl_close($ch);
        p($result);
        exit;
    }

    public function suNum() {
        //穷举发。 明确 问题 中的 条件转换为数学条件和等式 不等式
        header("Content-Type: text/html; charset=utf8");
        for ($i = 1; $i <= 100; $i++) {
            $flag = 0;
            for ($j = 2; $j < $i; $j++) {
                if ($i % $j == 0) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                echo $i . '是素数<br>';
            } elseif ($flag == 1) {
                echo $i . '不是素数<br>';
            }
        }
    }
//  公鸡5快，母鸡3快，小鸡1/3快， 百快百鸡， 求解 各多少只。
    public function hunderd() {

        header("Content-Type: text/html; charset=utf8");
    /*    $x;
        $y;
        $z;
        $z = 100 - $x - $y;
        15 * $x + 9 * $y + $z = 300;
        14 * $x + 8 * $y = 200;*/

        for ($x = 0; $x < 20; $x++) {

            for ($y = 0; $y < 34; $y++) {
                if (14 * $x + 8 * $y == 200) {
                    echo '公鸡的数量为：' . $x . '只';
                    echo '母鸡的数量为：' . $y . '只';
                    echo '小鸡的数量为：' . (100 - $x - $y) . '只<br>';
                }
            }
        }
    }
//
//    例3汉诺塔问题
//如图:已知有三根针分别用1,2,3表示,在一号针中从小放n个盘子,现要求把所有的盘子
//从1针全部移到3针,移动规则是:使用2针作为过度针,每次只移动一块盘子,且每根针上
//不能出现大盘压小盘.找出移动次数最小的方案.
    public function main() {
        global $time;
        $time = 0;

        $this->hannuo(16, 'a', 'b', 'c');
    }

    public function hannuo($n, $from, $denpend_on, $to) {
        header("Content-Type: text/html; charset=utf8");

        if ($n == 1) {
            $this->move(1, $from, $to);
            //只有一个盘子是直接将初塔上的盘子移动到目的地  
        } else {
            $this->hannuo($n - 1, $from, $to, $denpend_on);
            //先将初始塔的前n-1个盘子借助目的塔移动到借用塔上  
            $this->move($n, $from, $to); //将剩下的一个盘子移动到目的塔上  
            $this->hannuo($n - 1, $denpend_on, $from, $to); //最后将借用塔上的n-1个盘子移动到目的塔上  
        }
    }

    public function move($n, $from, $to) {
        global $time;
        $time+=1;
        echo "第$n 个盘子移动路径：$from-->$to; 第 " . $time . "次<br>";
    }
//例：一列数的规则如下: 1、1、2、3、5、8、13、21、34...... 求第30位数是多少。
    public function digui() {

        echo $this->nums(30);
    }

    public function nums($n) {

        if ($n <= 0)
            return 0;
        else if ($n > 0 && $n <= 2)
            return 1;
        else
            return $this->nums($n - 1) + $this->nums($n - 2);
    }
//例1：把一个整数按n(2<=n<=20)进制表示出来，并保存在给定字符串中。比如121用二进制表示得到结果为：“1111001”。
//参数说明：s: 保存转换后得到的结果。
    public function zhuanhuan() {
        global $s;
        $s = '';

        echo $this->jinzhi(143, 16);
    }

    public function jinzhi($num, $j) {
//         $s.=$num%$j;
        $str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        global $s;
        if ($num >= $j) {
            $z = substr($str, $num % $j, 1);
            echo $z . '<br>';
            $s = $z . $s;
            $this->jinzhi(floor($num / $j), $j);
        } else {
            $z = substr($str, $num, 1);
            $s = $z . $s;
        }
        return $s;
    }
//例2 楼梯有n阶台阶,上楼可以一步上1阶,也可以一步上2阶,编一程序计算共有多少种不同的走法.
//设n阶台阶的走法数为f(n)
    public function shang() {
        global $time;
        $time = 0;
        echo $this->zhou(15);
    }

    public function zhou($m) {

        if ($m == 1) {
            return 1;
        } elseif ($m == 2) {
            return 2;
        } else {
            return $this->zhou($m - 1) + $this->zhou($m - 2);
        }
    }
 
 }



















?>
