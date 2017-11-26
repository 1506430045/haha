<?php
/**
 * 插入排序
 *
 * User: xiangqian
 * Date: 2017/11/26
 * Time: 下午12:41
 */

namespace Algorithm\Sort;


class InsertSort implements BaseSort
{
    public function run($arr, $count): array
    {
        for ($i = 1; $i < $count; $i++) {
            $tmp = $arr[$i];
            for ($j = $i - 1; $j >= 0; $j--) {
                if ($arr[$j] > $tmp) {
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $tmp;
                } else {
                    break;
                }
            }
        }
        return $arr;
    }
}