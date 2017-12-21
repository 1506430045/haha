<?php
/**
 * 归并排序
 *
 * User: xiangqian
 * Date: 2017/11/26
 * Time: 下午12:45
 */

namespace Algorithm\Sort;


class MergeSort implements BaseSort
{
    /**
     * merge函数将指定的两个有序数组(arr1,arr2)合并并且排序
     * 我们可以找到第三个数组,然后依次从两个数组的开始取数据哪个数据小就先取哪个的,然后删除掉刚刚取过的数据
     *
     * @param $arrA
     * @param $arrB
     * @return array
     */
    private function merge($arrA, $arrB): array
    {
        $arrC = [];
        while (count($arrA) && count($arrB)) {
            //这里不断的判断哪个值小,就将小的值给到arrC,但是到最后肯定要剩下几个值,
            //不是剩下arrA里面的就是剩下arrB里面的而且这几个有序的值,肯定比arrC里面所有的值都大所以使用
            $arrC[] = $arrA['0'] < $arrB['0'] ? array_shift($arrA) : array_shift($arrB);
        }
        return array_merge($arrC, $arrA, $arrB);
    }

    /**
     * 归并排序主程序
     *
     * @param $arr
     * @return array
     */
    public function run($arr, $count): array
    {
        if ($count <= 1) {
            return $arr;
        }
        $mid = floor($count / 2);
        $left = array_slice($arr, 0, $mid);     //拆分数组0-mid这部分给左边left
        $right = array_slice($arr, $mid);              //拆分数组mid-末尾这部分给右边right
        $left = $this->run($left, count($left));       //左边拆分完后开始递归合并往上走
        $right = $this->run($right, count($right));    //右边拆分完毕开始递归往上走
        return $this->merge($left, $right);            //合并两个数组,继续递归
    }
}