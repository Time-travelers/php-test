<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 文件抓取
 */
//$url="http://bbs.csdn.net/topics/350035770";
//$ch = curl_init(); 
//
//curl_setopt($ch, CURLOPT_URL, $url); 
//
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//以文件流的形式返回 
//
//$str = curl_exec($ch);//$str抓取的是所有你在上面填写的网址的内容 
//
//$str = iconv("gb2312", "utf-8",$str); 
//$str = htmlspecialchars($str); 
//
//file_put_contents("test.txt",$str,FILE_APPEND);        //把抓取的内容保存在test.txt里，你再查找字符串，切割字符串什么的就不用教了吧 
//
//curl_close($ch); 
//
//
//


//$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);  echo $new;  exit;

//初始化curl  <root>
//<weather c="北京" city="54511" qx="多云转阵雨" wd="18℃～26℃" fl="(小于3级)" qximg="01.gif,03.gif"/>
//</root>
//        $ch = curl_init() or die (curl_error()); 
//        //设置URL参数  
//        curl_setopt($ch,CURLOPT_URL,"http://www.163.com/weatherxml/54511.xml");  //要求CURL返回数据 
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
//        //执行请求 
//        $result = curl_exec($ch) or die (curl_error()); 
//        //取得返回的结果，并显示  
//        //echo $result; 
//        // echo curl_error($ch); 
//        $qx=explode("\"",strstr($result,"qx=")); 
//        $wd=explode("\"",strstr($result,"wd=")); 
//        $qximg=explode("\"",strstr($result,"qximg=")); 
//        $qximg_=explode(",",$qximg[1]);  
//        echo $qx[1]."<br>";  
//        echo $wd[1];  
//        //关闭CURL  
//        curl_close($ch); 
//        EXIT;
//        

//$s = '<div style="clear:both;height:15px;"></div><span style="text-align: left; widows: 2; text-transform: none; text-indent: 0px; display: inline !important; font: bold 12px/26px 微软雅黑; white-space: normal; orphans: 2; float: none; letter-spacing: normal; color: rgb(67,67,67); word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">돌다라도 두드려 보고 건너라小心驶得万年船。고래 싸음에 새우 등 터진다城门失火殃及池鱼。열 길 물 속은 알아도한 길 사람 속은 모른다知人知面不知心。물에 빠지면 지푸라기라도 잡는다孤注一掷 <span style="text-align: left; widows: 2; text-transform: none; text-indent: 0px; display: inline !important; font: bold 12px/26px 微软雅黑; white-space: normal; orphans: 2; float: none; letter-spacing: normal; color: rgb(67,67,67); word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">배보다 배꼽이 더 크다.本末倒置.입에 쓴 약이 몸에 좋다良药苦口利于病，忠言逆耳利于行.새 발의 피.微不足道。팔은 안으로 굽는다.胳膊向里弯。도토리 키 재기半斤对八两。웃는 낯에 침 못 뱉는다伸手不打笑脸人。</span></span><br>';
//echo strip_tags($s);
//exit;
//去除 全部的 html 和 php标签 1. strip_tags 2. 正则。
//  定向取值  1. 正则。 2. php函数  strstr 返回 部分匹配字符。 explode  定向分割字符串。 去 固定的是数组值。
// htmlspecialchars .  转换成html 对象。
$ch = curl_init();
header("Content-Type: text/html; charset=utf-8");

$timeout = 5;
for ($index = 1; $index < 10; $index++) {
    $url = "http://www.jb51.net/article/";
    $url.=$index . '.htm';
    // echo $url;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    //在需要用户检测的网页里需要增加下面两行 
    //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    //curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD); 
    $contents = curl_exec($ch);
    $getcontent = iconv("gb2312", "utf-8", $contents);
//    $getcontent=strip_tags($getcontent);

    $getcontent1 = stristr($getcontent, '<div id="art_content">');
    $getcontent2 = stristr($getcontent1, '<div id="art_xg">');
    $contents = str_replace($getcontent2, '', $getcontent1);
    // 补全成要的格式
    $contents.='</div>';
    //调试 查看 截取的 html 代码集合
    // echo htmlspecialchars($contents);exit;
    // 一下 为调调整代码
    // 调试1  去掉 html标签。
//     $contents=  strip_tags($contents);
//           function strip($str)
//            {
//                  $str=str_replace("&lt;br&gt;","",$str);
//                    //$str=htmlspecialchars($str);
//                   return strip_tags($str);
//            }
    // 调试2  利用正则 调整。
    // 去掉 js
    $preg = "/<\/?[^>]+>/i";

    $regexstr ="/<[^>]*>/i";    //去除所有的标签
    //去除所有脚本，中间部分也删除
    $regexstr1 = "/<script[^>]*?>.*? </script>/i";
    $regexstr2 = "/<img[^>]*>/i";
    //   //去除图片的正则
    $regexstr3 = "/<(?!br).*? >/i";
    ////去除所有标签，只剩br
    $regexstr4 = "/<table[^>]*? >.*?</table>/i";
    //去除table里面的所有内容
    $regexstr5 = "/<(?!img|br|p|/p).*? >/i";
    //去除所有标签，只剩img,br,p
    $contents=preg_replace($preg,'',$contents);
    //去掉空格
    $contents=  str_replace('&nbsp;','', $contents);
    $text = $index . '.doc';
    file_put_contents($text, $contents, FILE_APPEND);
}

curl_close($ch);
echo $contents;
?> 
