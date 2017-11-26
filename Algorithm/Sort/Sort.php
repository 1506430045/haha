<?php
/**
 * 排序
 *
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午11:13
 */

namespace Algorithm\Sort;


class Sort
{
    private $sortObj;   //排序算法对象
    private $arr;       //待排序数组
    private $count;     //数组元素个数

    public function __construct(BaseSort $sortObj, array $arr)
    {
        $this->sortObj = $sortObj;
        $this->arr = $arr;
        $this->count = count($this->arr);
    }

    /**
     * 排序
     *
     * @return array
     */
    public function sort()
    {
        if ($this->count <= 1) {
            return [];
        }
        return $this->sortObj->run($this->arr, $this->count);
    }
}