<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/12/10
 * Time: 上午11:45
 */
define('SCRIPT_BASE_DIR', __DIR__ . '/../..');

require_once SCRIPT_BASE_DIR . '/vendor/autoload.php';

class EsDemo
{
    public function run()
    {

        $model = new \Model\Es\EmployeeModel('megacorp', 'employee');
//        $data = [
//            'first_name' => 'John',
//            'last_name' => 'Smith',
//            'age' => 24,
//            'about' => 'I love to go rock climbing',
//            'interests' => ["sports", "music"]
//        ];
//        $re = $model->indexEmployee($data);
//        var_dump($re);

        $data = [
            'first_name' => 'John'
        ];
        $list = $model->deleteEmployeeIndex();
        var_dump($list);
    }
}

$o = new EsDemo();
$o->run();
