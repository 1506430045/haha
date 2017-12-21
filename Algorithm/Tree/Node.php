<?php
/**
 * 二叉树节点
 *
 * User: xiangqian
 * Date: 2017/11/12
 * Time: 下午8:53
 */

namespace Algorithm\Tree;

class Node
{
    public $value;  //节点值
    public $left;   //左子节点
    public $right;  //右子节点

    public function __construct($value, $left = null, $right = null)
    {
        $this->value = $value;
        $this->left = $left;
        $this->right = $right;
    }
}