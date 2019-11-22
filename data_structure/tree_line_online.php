<?php
/*
*@author:xu.weishuai
*@Time:2019/10/30 18:20
*/


error_reporting(E_ALL ^ E_NOTICE);

/**
 * 二叉树的节点类
 */
class Node
{
    //索引 值 左孩子 右孩子 父节点
    public $index, $data, $lChild, $rChild, $parentNode;

    function __construct($index, $data, Node $parentNode = null, Node $lChild = null, Node $rChild = null)
    {
        //构造函数 用来初始化节点
        $this->index = $index;
        $this->data = $data;
        $this->lChild = $lChild;
        $this->rChild = $rChild;
        $this->parentNode = $parentNode;
    }

    function SearchNode($nodeIndex)
    {
        //节点的搜索方法
        if ($this->index == $nodeIndex) {
            return $this;
        }
        if ($this->lChild != null) {
            if ($this->lChild->index == $nodeIndex) {
                return $this->lChild;
            } else {
                $tempNode = $this->lChild->SearchNode($nodeIndex);
                if ($tempNode != null) {
                    return $tempNode;
                }
            }
        }
        if ($this->rChild != null) {
            if ($this->rChild->index == $nodeIndex) {
                return $this->rChild;
            } else {
                $tempNode = $this->rChild->SearchNode($nodeIndex);
                if ($tempNode != null) {
                    return $tempNode;
                }
            }
        }
        return null;
    }

    function DeleatNode()
    {
        //节点的删除
        if ($this->lChild != null) {
            $this->lChild->DeleatNode();
        }
        if ($this->rChild != null) {
            $this->rChild->DeleatNode();
        }
        if ($this->parentNode != null) {
            if ($this->parentNode->lChild == $this) {
                $this->parentNode->lChild = null;
            } elseif ($this->parentNode->rChild == $this) {
                $this->partentNode->rChild = null;
            }
        }
        unset($this);
    }

    function PreOrderTraversal()
    {
        //节点的前序遍历
        echo $this->data;
        if ($this->lChild != null) {
            $this->lChild->PreOrderTraversal();
        }
        if ($this->rChild != null) {
            $this->rChild->PreOrderTraversal();
        }
    }

    function InOrderTraversal()
    {
        //节点的中序遍历
        if ($this->lChild != null) {
            $this->lChild->InOrderTraversal();
        }
        echo $this->data;
        if ($this->rChild != null) {
            $this->rChild->InOrderTraversal();
        }
    }

    function PostOrderTraversal()
    {
        //节点的后序遍历
        if ($this->lChild != null) {
            $this->lChild->PostOrderTraversal();
        }
        if ($this->rChild != null) {
            $this->rChild->PostOrderTraversal();
        }
        echo $this->data;
    }
}

class Tree
{
    private $root;

    //构造树并初始化根节点
    function __construct($index, $data)
    {
        $this->root = new Node($index, $data);
    }

    //搜索节点
    function SearchNode($nodeIndex)
    {
        return $this->root->SearchNode($nodeIndex);
    }

    //增加节点
    function AddNode($nodeIndex, $direction, Node $node)
    {
        $searchResult = $this->root->SearchNode($nodeIndex);
        if ($searchResult != null) {
            if ($direction == 0) {
                $searchResult->lChild = $node;
                $searchResult->lChild->parentNode = $searchResult;

            } elseif ($direction == 1) {
                $searchResult->rChild = $node;
                $searchResult->rChild->parentNode = $searchResult;

            }
        } else {
            return false;
        }
    }

    //删除节点
    function DeleatNode($nodeIndex)
    {
        if ($this->SearchNode($nodeIndex) != null) {
            $this->SearchNode($nodeIndex)->DeleatNode();
        }
    }

    //前序遍历
    function PreOrderTraversal()
    {
        $this->root->PreOrderTraversal();
    }

    //中序遍历
    function InOrderTraversal()
    {
        $this->root->InOrderTraversal();
    }

    //后序遍历
    function PostOrderTraversal()
    {
        $this->root->PostOrderTraversal();
    }

    //析构函数
    function __destruct()
    {
        unset($this);
    }
}

