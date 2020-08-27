<?php
/**
 * Class Tree
 */

class treearray
{
    private $size;
    private $p_array;

    public function __construct($size,$n_root)
    {
        $this->size=$size;
//       初始化根节点
        $this->p_array[0]=$n_root;
//       其他节点初始化为0
        for ($i=1;$i<$size;$i++){
            $this->p_array[$i]=0;
        }
    }

//   添加节点
//   搜索节点
//   变了节点
//   删除节点
    /**
     * add
     */

    /**
     * check 检查节点是否合法
     * @param $index
     * @return bool
     */
    private function check($index){

        if($index<0||$index>$this->size){
            return false;
        }
//        if($this->p_array[$index]==0){
//            return false;
//        }
        return  true;
    }

    /**
     * add
     * @param $index
     * @param $type 0 左节点 1 右节点
     * @param $data
     * @return bool
     */
    public function add($index,$type,$data){
        $flag=$this->check($index);
//        var_dump($index);
//        var_dump($flag);
        if(!$flag){
            return $flag;
        }
        if($type==0){
            $index=$index*2+1;
            $flag=$this->check($index);
            if(!$flag){
                return $flag;
            }
            $this->p_array[$index]=$data;

        }
        if($type==1){
            $index=$index*2+2;
            $flag=$this->check($index);
            if(!$flag){
                return $flag;
            }
            $this->p_array[$index]=$data;

        }
        return true;

    }


    /**
     * search
     * @param $index
     * @return bool
     */
    public function search($index){
        $flag=$this->check($index);
        if(!$flag){
            return $flag;
        }
        return $this->p_array[$index];
    }

    /**
     * del
     * @param $index
     * @return bool
     * @author:xu.weishuai
     * @Time:2019/10/29 11:19
     */
    public function del($index){
        $flag=$this->check($index);
        if(!$flag){
            return $flag;
        }
        $this->p_array[$index]=0;
        return true;

    }
    public function all(){
        return $this->p_array;
    }


}
/*
 *              8(0)
 *       7(1)         9(2)
 *     5(3) 6(4)   1(5)  2(6)
 *
 * */

$tree=new treearray(10,8);

$flag=$tree->add(0,0,7);
$tree->add(0,1,9);
$tree->add(1,0,5);
$tree->add(1,1,6);
$tree->add(2,0,1);
$tree->add(2,1,2);

$all=$tree->all();
print_r($all);
$node5=$tree->search(5);
print_r($node5);
