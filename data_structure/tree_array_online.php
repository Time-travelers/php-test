<?php
/*
*@author:xu.weishuai
*@Time:2019/10/30 18:20
*/

/**
 * 二叉树数组表示
 */
class BinaryTree
{
    private $size, $array = array();

    //创建树并初始化节点
    function __construct($size, $root)
    {
        $this->size = $size;
        for ($i = 0; $i < $size; $i++) {
            $this->array[$i] = 0;
        }
        $this->array[0] = $root;
    }

    //查询节点
    function searchNode($nodeCode)
    {
        if ($nodeCode >= $this->size || $nodeCode < 0) {
            return false;
        } else {
            if ($this->array[$nodeCode] == 0) {
                return null;
            } else {
                return $this->array[$nodeCode];
            }
        }
    }

    //增加树节点
    function addNode($nodeCode, $place, $nodeValue)
    {
        if ($nodeCode >= $this->size || $nodeCode < 0) {
            return false;
        } else {
            //判断插入节点是左孩子还是右孩子
            if ($place == 0) {
                //判断该位置是否为空，为空进行插入操作
                if ($this->array[$nodeCode * 2 + 1] == 0) {
                    //判断该节点是否是新的叶子节点，如果是，则对相应位置进行补0操作
                    if ($nodeCode * 2 + 1 >= $this->size) {
                        for ($i = $this->size; $i < $nodeCode * 2 + 1; $i++) {
                            $this->array[$i] = 0;
                        }
                        $this->size = $nodeCode * 2 + 2;
                        $this->array[$nodeCode * 2 + 1] = $nodeValue;
                    } else {
                        $this->array[$nodeCode * 2 + 1] = $nodeValue;
                    }
                } else {
                    return false;
                }
            } elseif ($place == 1) {
                if ($this->array[$nodeCode * 2 + 2] == 0) {
                    //判断该节点是否是新的叶子节点，如果是，则对相应位置进行补0操作
                    if ($nodeCode * 2 + 2 >= $this->size) {
                        for ($i = $this->size; $i < $nodeCode * 2 + 1; $i++) {
                            $this->array[$i] = 0;
                        }
                        $this->size = $nodeCode * 2 + 3;
                        $this->array[$nodeCode * 2 + 2] = $nodeValue;
                    } else {
                        $this->array[$nodeCode * 2 + 2] = $nodeValue;
                    }
                } else {
                    return false;
                }
            }
        }
    }

    //删除树节点
    function deleteNode($nodeCode)
    {
        if ($nodeCode >= $this->size || $nodeCode < 0) {
            return false;
        } else {
            $this->array[$nodeCode] = 0;
        }
    }

    //遍历树
    function showTree()
    {
        var_dump($this->array);
    }

    //销毁树
    function __destruct()
    {
        unset($this->array);
    }
}