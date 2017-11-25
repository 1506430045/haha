<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午9:40
 */

namespace Algorihtm\Sort;

class Demo
{
    public function test()
    {
        $arr = [
            2, 1, 6, 11, 7, 76
        ];

        (new Sort(new BubbleSort($arr)))->sort();
    }
}