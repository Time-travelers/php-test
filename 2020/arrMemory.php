<?php

echo memory_get_usage(), '<br>';
$start = memory_get_usage();
$a = Array();
for ($i = 1000; $i < 2000; $i++) {
    $temp=[];
    $temp['name']='name'.$i;
    $temp['name2']='name'.$i;
    $temp['name3']='name'.$i;
    $temp['age']=$i;
    $a[$i] =$temp;
}
$mid = memory_get_usage();
echo memory_get_usage(), '<br>';
for ($i = 1000; $i < 2000; $i++) {
    $b[$i] = $i + $i;
}
$end = memory_get_usage();
echo memory_get_usage(), '<br>';
echo 'argv:', ($mid - $start) / 1000, 'bytes', '<br>';
echo 'argv:', ($end - $mid) / 1000, 'bytes', '<br>';

//php7.2  392032<br>844984<br>881904<br>argv:452.92bytes<br>argv:36.92bytes<br>
//php5.6  229120<br>814080<br>950672<br>argv:584.784bytes<br>argv:136.592bytes<br>

// php 一维数组 1000个 占 36k
//     二维数组1000个占452k  1w个占4.5M  1000w个占4.6G