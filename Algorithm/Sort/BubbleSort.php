<?php
/**
 * 冒泡排序
 *
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午11:11
 */

namespace Algorithm\Sort;


class BubbleSort implements BaseSort
{

    public function run($arr, $count): array
    {
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($arr[$i] > $arr[$j]) {
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        return $arr;
    }

}