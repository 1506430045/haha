<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/7/31
 * Time: 下午3:13
 */
namespace Script;

class ScriptBase
{
    private $_start;
    private $_end;

    public function __construct()
    {
        $this->_start = $this->_getMicroTime();
    }

    public function __destruct()
    {
        $this->_end = $this->_getMicroTime();
        $costTime = $this->_end - $this->_start;
        echo "脚本总耗时: {$costTime}秒";
    }

    /**
     * 获取精确时间
     *
     * @return float
     */
    private function _getMicroTime()
    {
        $timeArr = explode(' ', microtime());
        return $timeArr['1'] + $timeArr['0'];
    }
}