<?php
/**
 * 快速排序
 *
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午11:12
 */

namespace Algorithm\Sort;


class QuickSort implements BaseSort
{
    public function run($arr, $count): array
    {
        if ($count <= 1) {
            return $arr;
        }
        $flag = $arr['0'];
        $left = $right = [];
        for ($i = 1; $i < $count; $i++) {
            if ($arr[$i] < $flag) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }
        $left = $this->run($left, count($left));
        $right = $this->run($right, count($right));
        return array_merge($left, [$flag], $right);
    }
}