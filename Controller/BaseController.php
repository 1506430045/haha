<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/3
 * Time: 下午3:30
 */
class BaseController
{
    public function __construct()
    {
    }

    /**
     * json返回
     *
     * @param array $data
     */
    public function renderJson(array $data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }

    /**
     * jsonp返回
     *
     * @param array $data
     * @param string $callback
     */
    public function renderJsonp(array $data, $callback = 'callback')
    {
        header('Content-type: application/json');
        echo $callback . "(" . json_encode($data) . ")";
        exit();
    }

    /**
     * 是否 ajax 请求
     *
     * @return bool
     */
    public function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }
}