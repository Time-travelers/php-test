<?php
/**
 * Created by PhpStorm.
 * User: xu.weishuai
 * Date: 2019/5/31
 * Time: 9:40
 */

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{

    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}