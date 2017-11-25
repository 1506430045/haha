<?php
/**
 * 冒泡排序
 *
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午9:42
 */
namespace Algorihtm\Sort;

class BubbleSort implements BaseSort
{
    private $arr;
    private $count;

    public function __construct(array $arr)
    {
        $this->arr = $arr;
        $this->count = count($this->arr);
    }

    public function run(): array
    {
        if (empty($this->arr) || !is_array($this->arr)) {
            return [];
        }
        return $this->sort($this->arr, $this->count);
    }

    /**
     * 排序
     *
     * @param $arr
     * @param $count
     * @return array
     */
    private function sort($arr, $count): array
    {
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = 1; $j < $count; $j++) {
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