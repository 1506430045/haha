<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午9:43
 */

namespace Algorihtm\Sort;

class Sort
{
    private $sortObj;

    public function __construct(BaseSort $sortObj)
    {
        $this->sortObj = $sortObj;
    }

    /**
     * 排序
     *
     * @return array
     */
    public function sort()
    {
        return $this->sortObj->run();
    }
}