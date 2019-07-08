<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/7/4
 * Time: 10:11
 */

$arr=[10,9,8,7,6,5,4,3,2,1];
$arr=[1,6,5,8,33,44,77,83,43,12];
//从小到大排序
//参考资料 https://mp.weixin.qq.com/s/vn3KiV-ez79FmbZ36SX9lg
function maopao(&$arr){

//    需循环结构 每次取出最小的值，
    $count=count($arr);
    for($i=0;$i<$count;$i++){

//        从第一个开始 依次和后面元素做比较
        for($j=$i+1;$j<$count;$j++){
            if($arr[$i]>$arr[$j]){
                swap($arr[$i],$arr[$j]);
            }

        }


    }
    return $arr;


}
function swap(&$a, &$b) {
    $temp = $a;
    $a= $b;
    $b = $temp;
}
//选择排序
function xuanze($arr){
//    每次取出最大小值插入当前位置
    $count=count($arr);
    for($i=0;$i<$count;$i++){

//       计算出min 交换位置 保存下标
        $min=$i;

        for($j=$i+1;$j<$count;$j++){

            if($arr[$min]>$arr[$j]){

                $min=$j;
            }

        }
        swap($arr[$i],$arr[$min]);

    }
    return $arr;


}
//插入排序
function charu($arr){

//    假设第一个元素为有序序列 遍历后边的依次插入前边的有序序列
    $count=count($arr);
    for($i=1;$i<$count;$i++){

//       从第一个待排序列表依次 判断插入位置
//        待排序值
        $j=$i;
        $temp=$arr[$j];
//        依次和有序序列前一位做比较 若小于则值后移一位 否则停止 记录插入位置
        while ($j>0&&$temp<$arr[$j-1]){

            $arr[$j]=$arr[$j-1];
            $j--;
        }
//      如果后移过 则插入
        if($j!=$i){

            $arr[$j]=$temp;
        }




    }
    return $arr;



}
//归并排序
function guibing(&$arr,$l,$r){


//   先分成 左右两部分 元素个数为1

    if($l>=$r){
        return true;
    }

    $mid=intval(($r+$l)/2);

    echo $mid;
    guibing($arr,$l,$mid);
    guibing($arr,$mid+1,$r);


    mergeArray($arr,$l,$mid,$r);

//    合并 左右两部分


}
function mergeArray(&$arr,$start,$mid,$end){
    $i = $start;
    $j=$mid + 1;
    $k = $start;
    $temparr = array();

    while($i!=$mid+1 && $j!=$end+1)
    {
        if($arr[$i] >= $arr[$j]){
            $temparr[$k++] = $arr[$j++];
        }
        else{
            $temparr[$k++] = $arr[$i++];
        }
    }

    //将第一个子序列的剩余部分添加到已经排好序的 $temparr 数组中
    while($i != $mid+1){
        $temparr[$k++] = $arr[$i++];
    }
    //将第二个子序列的剩余部分添加到已经排好序的 $temparr 数组中
    while($j != $end+1){
        $temparr[$k++] = $arr[$j++];
    }
    for($i=$start; $i<=$end; $i++){
        $arr[$i] = $temparr[$i];
    }
}
//快速排序
function kuaipai(&$arr,$left,$ritht){


    if($left+1>$ritht){
        return true;
    }

//     首先设定一个基准 最左边的

     $temp =$arr[$left];
     $i=$left;
     $j=$ritht;


//     循环比较 左右同时进行 左边小于 右边大于。 若左右都找到了位置 则交换。
    while ($i<$j){
//        优先右边比较 保证 right值为 小于的
        while ($arr[$j]>$temp&&$i<$j){
            $j--;
        }
        while ($arr[$i]<$temp&&$i<$j){
            $i++;
        }
//     左右同时向中间移动，同时满足 则交换两个位置。   交换 左右的值
        if($i<$j){
            swap($arr[$i],$arr[$j]);
        }


    }
//  左右 递归快排
    kuaipai($arr,$left,$i-1);
    kuaipai($arr,$i+1,$ritht);



}

/*private static int getIndex(int[] arr, int low, int high) {
    // 基准数据
    int tmp = arr[low];
        while (low < high) {
            // 当队尾的元素大于等于基准数据时,向前挪动high指针
            while (low < high && arr[high] >= tmp) {
                high--;
            }
            // 如果队尾元素小于tmp了,需要将其赋值给low
            arr[low] = arr[high];
            // 当队首元素小于等于tmp时,向前挪动low指针
            while (low < high && arr[low] <= tmp) {
                low++;
            }
            // 当队首元素大于tmp时,需要将其赋值给high
            arr[high] = arr[low];

        }
        // 跳出循环时low和high相等,此时的low或high就是tmp的正确索引位置
        // 由原理部分可以很清楚的知道low位置的值并不是tmp,所以需要将tmp赋值给arr[low]
        arr[low] = tmp;
        return low; // 返回tmp的正确位置
    }
---------------------
作者：nrsc
来源：CSDN
原文：https://blog.csdn.net/nrsc272420199/article/details/82587933
版权声明：本文为博主原创文章，转载请附上博文链接！*/
//kuaipai($arr,0,count($arr)-1);
//kuaipai($arr,0,count($arr)-1);
//maopao($arr);
// print_r($arr);
guibing($arr,0,count($arr)-1);
print_r($arr);

