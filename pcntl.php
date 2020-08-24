<?php
global $pid;
$pid = pcntl_fork();

if ($pid == -1) {
    echo 'FATAL server fork error..'."\n";die;
} else if ($pid > 0) {
    $fatherPid = posix_getpid();
    echo 'this is farther.. pid:'.$fatherPid."\n";
    sleep(1);
}else{
    $childPid = posix_getpid();
    $fatherPid = posix_getppid();
    echo 'this is son.. pid:'.$childPid." father_pid:".$fatherPid."\n";
}