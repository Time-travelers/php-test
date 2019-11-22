<?php
/*
*@author:xu.weishuai
*@Time:2019/10/30 15:51
*/
/*
 *              8(0)
 *       7(1)         9(2)
 *     5(3) 6(4)   1(5)  2(6)
 *
 * */
/*
 * 类 node
 * 属性 pre  leftNode rightNode index data
 * 类 tree
 * 属性  size  r_root
 *
 * */

class node{
//    public $pre;
    public $leftNode;
    public $rightNode;
    public $index;
    public $data;
    public function __construct($data,$index=0,$pre=null,$leftNode=null,$rightNode=null)
    {

        $this->data=$data;
        $this->index=$index;

    }
    public function search($index){

        if($this->index==$index){
            return $this;
        }


        if($this->leftNode!=null){
            if($this->leftNode->index==$index){
                return $this->leftNode;
            }
            $this->leftNode->search($index);

        }
        if($this->rightNode!=null){
            if($this->rightNode->index==$index){
                return $this->rightNode;
            }
            $this->rightNode->search($index);

        }

    }



}
class Tree{
    public $r_root;
    public function __construct($node)
    {
        $this->r_root=$node;
    }
//  添加 筛选节点

    public function search($index,$obj=''){
        if(empty($obj)){
            $obj=$this->r_root;
        }
        if($obj->index==$index){
            return $obj;
        }


        if($obj->leftNode!=null){
            if($obj->leftNode->index==$index){
                return $obj->leftNode;
            }
            $obj->leftNode->search($index,$obj);

        }
        if($obj->rightNode!=null){
            if($obj->rightNode->index==$index){
                return $obj->rightNode;
            }
            $obj->rightNode->search($index,$obj);

        }
//        return $obj->r_root->search($index);
    }
    public function add($index,$type,$data){
        $indexNode=$this->r_root->search($index);

        if(!$indexNode){
            return false;
        }
        if($type==0){
            $index=2*$indexNode->index+1;

            $node=new node($data,$index);
            $indexNode->leftNode=$node;
            return true;
        }
        if($type==1){
            $index=2*$indexNode->index+2;
            $node=new node($data,$index);
            $indexNode->rightNode=$node;
            return true;
        }

        return false;


    }

}

$root_node=new node(8);
$tree=new Tree($root_node);

//var_dump($tree->search(0)->data);
/*
 *              8(0)
 *       7(1)         9(2)
 *     5(3) 6(4)   1(5)  2(6)
 *
 * */
$tree->add(0,0,7);
$tree->add(0,1,9);
$tree->add(1,0,5);
$tree->add(1,1,6);
$tree->add(2,1,2);
$tree->add(2,0,1);

//var_dump($tree->search(1)->leftNode);
var_dump($tree->search(1)->data);
var_dump($tree->search(3));
//var_dump($tree->search(2)->leftNode);
var_dump($tree->search(5));
//var_dump($tree);
//$tree->search(5) 有问题。多层会返回null