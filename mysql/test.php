<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/9/30
 * Time: 15:29
 */


function dummy_business() {
    $conn = mysqli_connect('127.0.0.1', 'root', 'root') or die(mysqli_error());
    mysqli_select_db($conn, 'test');
    for ($i = 0; $i < 10000; $i++) {
        mysqli_query($conn, 'UPDATE counter SET num = num + 1 WHERE id = 1');
    }
    mysqli_close($conn);
}

for ($i = 0; $i < 10; $i++) {
    $pid = pcntl_fork();

    if($pid == -1) {
        die('can not fork.');
    } elseif (!$pid) {
        dummy_business();
        echo 'quit'.$i.PHP_EOL;
        break;
    }
}
