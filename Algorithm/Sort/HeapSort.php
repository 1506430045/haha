<?php
/**
 * 堆排序
 *
 * User: xiangqian
 * Date: 2017/11/26
 * Time: 下午12:44
 */

namespace Algorithm\Sort;


class HeapSort implements BaseSort
{
    public function run($arr, $count): array
    {
        return [];
    }

    /**
     * 使用异或交换2个值，原理：一个值经过同一个值的2次异或后，原值不变
     *
     * @param $a
     * @param $b
     */
    public static function swap(&$a, &$b)
    {
        $a = $a ^ $b;
        $b = $a ^ $b;
        $a = $a ^ $b;
    }

    /**
     * 整理当前树节点（$n），临界点$last之后为已排序好的元素
     *
     * @param int $n
     * @param int $last
     * @param array $arr
     *
     */
    function adjustNode($n, $last, &$arr)
    {
        $l = $n << 1;   // 左孩子
        if (!isset($arr[$l]) || $l > $last) {
            return;
        }
        $r = $l + 1;  // 右孩子
        // 如果右孩子比左孩子大，则让父节点与右孩子比
        if ($r <= $last && $arr[$r] > $arr[$l]) {
            $l = $r;
        }
        // 如果其中子节点$l比父节点$n大，则与父节点$n交换
        if ($arr[$l] > $arr[$n]) {
            self::swap($arr[$l], $arr[$n]);
            // 交换之后，父节点($n)的值可能还小于原子节点($l)的子节点的值，所以还需对原子节点($l)的子节点进行调整，用递归实现
            $this->adjustNode($l, $last, $arr);
        }
    }

    /**
     * 堆排序（最大堆）
     *
     * @param array $arr
     */
    function heapSort(&$arr)
    {
        // 最后一个蒜素位
        $last = count($arr);
        // 堆排序中常忽略$arr[0]
        array_unshift($arr, 0);
        // 最后一个非叶子节点
        $i = $last >> 1;
        // 整理成最大堆，最大的数放到最顶，并将最大数和堆尾交换，并在之后的计算中，忽略数组最后端的最大数(last)，直到堆顶（last=堆顶）
        while (true) {
            $this->adjustNode($i, $last, $arr);
            if ($i > 1) {
                // 移动节点指针，遍历所有节点
                $i--;
            } else {
                // 临界点$last=1，即所有排序完成
                if ($last == 1) {
                    break;
                }
                self::swap($arr[$last], $arr[1]);
                $last--;
            }
        }
        // 弹出第一个元素
        array_shift($arr);
    }
}