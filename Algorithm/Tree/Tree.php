<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/11/12
 * Time: 下午8:51
 */

namespace Algorithm\Tree;

class Tree
{
    public function __construct()
    {
    }

    public function build()
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $d = new Node('D');
        $e = new Node('E');
        $f = new Node('F');

        $a->left = $b;
        $a->right = $c;
        $b->left = $d;
        $c->left = $e;
        $c->right = $f;
    }

    public function preOrder()
    {

    }

    public function inOrder()
    {

    }

    public function tailOrder()
    {

    }
}