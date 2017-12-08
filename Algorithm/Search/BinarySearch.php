<?php
/**
 * 二分查找
 *
 * User: xiangqian
 * Date: 2017/11/26
 * Time: 下午12:51
 */

class BinarySearch
{
    public function search($arr, $count, $val): int
    {
        pow(2, 2);
        $lower = 0;
        $high = $count - 1;

        while ($lower <= $high) {
            $middle = floor(($high - $lower) / 2);
            if ($arr[$middle] == $val) {
                return $middle;
            }
            if ($val > $arr[$middle]) {
                $lower = $middle + 1;
            } else {
                $high = $middle - 1;
            }
        }
        return -1;
    }

    public function searchFirstLarger($arr, $count, $val): int
    {
        $lower = 0;
        $high = $count - 1;
        while ($lower <= $high) {
            $middle = floor(($high - $lower) / 2);
            if ($arr[$middle] > $val) {
                $high = $high - 1;
            } else {
                $lower = $lower + 1;
            }
        }
        return $lower;
    }
}